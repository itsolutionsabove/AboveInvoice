<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\GoogleAuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Mail\PasswordResetMail;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\FirebaseAuthService;
use App\Services\GoogleAuthService;
use App\Services\ModelsDataHandler\FormsHandlerService;
use App\Services\PhoneCodesService;
use App\Services\Response\DataListingService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private string $model = User::class;

    public function store(Request $request): JsonResponse
    {
        $handler = new FormsHandlerService($this->model);
        return $handler->validateAndCreate($request) ? ResponseService::jsonSuccess("added successfully") :
            ResponseService::jsonError($handler->error());
    }

    public function emailCheck(Request $request): JsonResponse
    {
        if(!$request->email) return ResponseService::jsonError("Invalid email");
        $handler = User::where('email', $request->email)->first();
        if(!$handler){
            return ResponseService::jsonError("email not fount");
        }
        $handler->email_reset_token = md5(uniqid());
        $handler->email_reset_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        if(!Mail::to($request->email)->send(new PasswordResetMail($handler->email_reset_code)))
            return ResponseService::jsonError("Cannot send email");
        return  $handler->save() ? ResponseService::jsonData([
            'email_reset_token' => $handler->email_reset_token,
            'email_reset_code' => $handler->email_reset_code
        ]) : ResponseService::jsonError("failed to send email");
    }

    public function codeCheck(Request $request): JsonResponse
    {
        if(!$request?->token) return ResponseService::jsonError("invalid token");
        if(!$request?->code) return ResponseService::jsonError("invalid reset code");
        $handler = User::where('email_reset_token', $request->token)->firstOrFail();
        if($handler->updated_at->addHour()->timestamp < now()->timestamp) return ResponseService::jsonError("token expired");
        if($handler->email_reset_code != $request?->code) return ResponseService::jsonError("invalid code");
        $handler->email_reset_code = "checked";
        return $handler->save() ? ResponseService::jsonSuccess("code accepted")
            : ResponseService::jsonError("failed to save");
    }

    public function resendCode(Request $request): JsonResponse
    {
        if(!$request?->token) return ResponseService::jsonError("invalid token");
        $handler = User::where('email_reset_token', $request->token)->first();
        if(!$handler) return ResponseService::jsonError("invalid token");
        if($handler->updated_at->addHour()->timestamp < now()->timestamp) return ResponseService::jsonError("token expired");
        // if($handler->email_reset_code != "checked") return ResponseService::jsonError("invalid check");
        $handler->email_reset_code = null;
        $handler->email_reset_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        if(!Mail::to($handler->email)->send(new PasswordResetMail($handler->email_reset_code)))
            return ResponseService::jsonError("Cannot send email");
        return  $handler->save() ? ResponseService::jsonData([
            'email_reset_token' => $handler->email_reset_token,
            'email_reset_code' => $handler->email_reset_code
        ]) : ResponseService::jsonError("failed to send email");
    }

    public function passwordReset(Request $request): JsonResponse
    {
        if(!$request?->token) return ResponseService::jsonError("invalid token");
        if(!$request?->password) return ResponseService::jsonError("invalid password");
        $handler = User::where('email_reset_token', $request->token)->firstOrFail();
        if($handler->updated_at->addHour()->timestamp < now()->timestamp) return ResponseService::jsonError("token expired");
        if($handler->email_reset_code != "checked") return ResponseService::jsonError("invalid check");
        $handler->email_reset_token = null;
        $handler->email_reset_code = null;
        $handler->password = bcrypt($request->password);
        return  $handler->save() ? ResponseService::jsonSuccess("new password successfully set")
            : ResponseService::jsonError("invalid code");
    }


    public function index(Request $request): JsonResponse
    {
        return DataListingService::init()->list($this->model, $request,[
            'id',
            'name',
            'email',
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $handler = new FormsHandlerService($this->model);
        return $handler->validateAndUpdate($request, $id) ? ResponseService::jsonSuccess("updated successfully") :
            ResponseService::jsonError($handler->error());
    }

    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);
        return $model->delete() ? ResponseService::jsonSuccess("deleted successfully") :
            ResponseService::jsonError("delete fail");
    }

    public function authTaken(AuthRequest $request): JsonResponse
    {
        if(!Auth::attempt($request->validated())) return ResponseService::jsonError("user not found");
        return ResponseService::jsonSuccess(Auth::user(), false, "admin");
    }

    public function apiAuthTaken(AuthRequest $request): JsonResponse
    {
        if(!Auth::attempt($request->validated())) return ResponseService::jsonError("user not found");
        return ResponseService::jsonData([
            "user" => new UserResource(Auth::user()),
            "token" => $request->user()->createToken('app_auth')?->plainTextToken
        ]);
    }

    public function authWithGoogle(GoogleAuthRequest $request): JsonResponse
    {

        $validated = $request->validated();
        $googleUser = FirebaseAuthService::init()->validateToken($validated['token'])->userData();

        $user = User::where('email', $googleUser['email'] ?? null)->first();

        if($user) Auth::loginUsingId($user->id);
        else{
            $user = User::create($googleUser);
            if(!$user) return ResponseService::jsonError("failed to authenticate user");
            Auth::loginUsingId($user->id);
        }

        return ResponseService::jsonData([
            "user" => new UserResource($user),
            "token" => $request->user()->createToken('app_auth')?->plainTextToken
        ]);
    }

    public function apiRegistration(RegisterRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['role'] = 'user';
        $create = User::create($validatedData);
        return $create ? ResponseService::jsonSuccess(new UserResource($create)) :
            ResponseService::jsonError("Failed to create user");
    }

    public function countriesCodes(Request $request): JsonResponse
    {
        return ResponseService::jsonData(PhoneCodesService::getCountriesCodes());
    }

    public function profile(Request $request): JsonResponse
    {
        if(!Auth::check()) return ResponseService::jsonError("not authorized");
        return ResponseService::jsonData(new UserResource(Auth::user()));
    }

    public function updateProfile(UserUpdateRequest $request): JsonResponse
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        if(!$user) return ResponseService::jsonError("user not found");
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = FileUploadService::upload($request->file('image'), 'users' , 'User_');
        }
        $user->update($validated);
        return ResponseService::jsonSuccess(new UserResource($user));
    }

}
