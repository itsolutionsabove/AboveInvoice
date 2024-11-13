<?php

namespace App\Http\Controllers;

use App\Http\Resources\Settings\SettingsCollection;
use App\Models\Settings;
use App\Services\ModelsDataHandler\FormsHandlerService;
use App\Services\Response\DataListingService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    private string $model = Settings::class;

    public function store(Request $request): JsonResponse
    {
        $handler = new FormsHandlerService($this->model);
        return $handler->validateAndCreate($request) ? ResponseService::jsonSuccess("added successfully") :
            ResponseService::jsonError($handler->error());
    }

    public function index(Request $request): JsonResponse
    {
        $settings = Settings::all();
        // check type if image or file return full url path
        $settings->map(function ($setting) {
            if ($setting->type == 'image' || $setting->type == 'file') {
                $setting->value =url($setting->value ? "uploads/" . $setting->value : "dist/img/no-thumb.jpg");
            }
        });
        $settings = new SettingsCollection($settings);
        return ResponseService::json($settings);
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

}
