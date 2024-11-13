<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToWishListRequest;
use App\Http\Resources\WishList\WishListCollection;
use App\Http\Resources\WishList\WishListResource;
use App\Models\CartItem;
use App\Models\WishList;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function store(AddToWishListRequest $request): JsonResponse
    {
        $item = WishList::where('user_id', Auth::id())->where('product_id', $request->product_id)->count();
        if($item){
            return ResponseService::jsonError("already exists");
        }
        $item = WishList::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);
        if(!$item) return ResponseService::jsonError("failed to add");
        return ResponseService::jsonData(new WishListResource($item));
    }

    public function index(Request $request): JsonResponse
    {
        return ResponseService::jsonData(
            new WishListCollection(Auth::user()->wishlist()->with('product')->get())
        );
    }

    public function destroy($id): JsonResponse
    {
        WishList::where('user_id', Auth::id())->where('product_id', $id)->firstOrFail()->delete();
        return ResponseService::jsonSuccess("deleted successfully");
    }

}
