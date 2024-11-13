<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductsRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\WishList;
use App\Services\ModelsDataHandler\FormsHandlerService;
use App\Services\ModelsDataHandler\HTMLElementsUtils;
use App\Services\PricesService;
use App\Services\Response\DataListingService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    private string $model = Product::class;

    public function store(Request $request): JsonResponse
    {
        $handler = new FormsHandlerService($this->model);
        return $handler->validateAndCreate($request) ? ResponseService::jsonSuccess("added successfully") :
            ResponseService::jsonError($handler->error());
    }

    public function index(Request $request): JsonResponse
    {
        return DataListingService::init()->onReturn(function ($key, $item){
            if($key == 'visibility') $item = HTMLElementsUtils::tagDrawer('span', [
                    'class' => 'badge me-1 bg-' . ($item ? 'success' : 'danger')
                ]) . ($item ? 'Visible' : 'Invisible');
            return $item;
        })->list($this->model, $request,[
            'id',
            'name',
            'quantity',
            'visibility',
        ]);
    }

    public function apiList(Request $request): JsonResponse
    {
        $products = $this->model::with(['categories' , 'dailyValue' ,'rates'])->APISearch($request->toArray())
            ->orderBy('order', 'desc')->get();
        return ResponseService::jsonData(new ProductCollection($products));
    }

    public function apiListBestSeller(Request $request): JsonResponse
    {
        $products = $this->model::with(['categories' , 'dailyValue' ,'rates'])->APISearch($request->toArray())->orderBy('order', 'desc')->get();
        return ResponseService::jsonData(new ProductCollection($products));
    }

    public function apiGet(Request $request): JsonResponse
    {
        $product = $this->model::with(['categories', 'dailyValue' ,'rates'])->findOrFail($request?->id);
        //update view count
        $product->update(['views' => $product->views + 1]);
        $rates = $product->rates;
        // calculate count rate for 1,2,3,4,5 stars 
        $rates_count_1 = $rates->where('rate', 1)->count();
        $rates_count_2 = $rates->where('rate', 2)->count();
        $rates_count_3 = $rates->where('rate', 3)->count();
        $rates_count_4 = $rates->where('rate', 4)->count();
        $rates_count_5 = $rates->where('rate', 5)->count();
        $rates_average = $rates->count() ? round($rates->sum('rate') / $rates->count(), 1) : 0;

        return ResponseService::jsonData([
            'product' => new ProductResource($product),
            'in_wishlist' => Auth::guard('api')->id() && WishList::where('user_id', Auth::guard('api')->id())->where('product_id', $product->id)->count(),
            // get count of product in wishlist
            'likes_count' =>  WishList::where('product_id', $product->id)->count() ?? 0,
            'reviews' => [
                'rates_count_1' => $rates_count_1,
                'rates_count_2' => $rates_count_2,
                'rates_count_3' => $rates_count_3,
                'rates_count_4' => $rates_count_4,
                'rates_count_5' => $rates_count_5,
            ],
            'average_rate' => $rates_average,
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $handler = new FormsHandlerService($this->model);
        return $handler->validateAndUpdate($request, $id) ? ResponseService::jsonSuccess("updated successfully") :
            ResponseService::jsonError($handler->error());
    }

    public function destroy($id): JsonResponse
    {
        $model = $this->model::findOrFail($id);
        return $model->delete() ? ResponseService::jsonSuccess("deleted successfully") :
            ResponseService::jsonError("delete fail");
    }

    public function searchPrices(): JsonResponse
    {
        return ResponseService::jsonData([
            'prices' => PricesService::getSearchPrices()
        ]);
    }

    public function addRate(Request $request): JsonResponse
    {
        $product = $this->model::findOrFail($request->product_id);
        $rate = $product->rates()->where('user_id', Auth::guard('api')->id())->first();
        if($rate){
            $rate->update([
                'rate' => $request->rate,
                'comment' => $request->comment
            ]);
        }else{
            $product->rates()->create([
                'user_id' => Auth::guard('api')->id(),
                'rate' => $request->rate,
                'comment' => $request->comment,
                'product_id' => $request->product_id
            ]);
        }
        return ResponseService::jsonSuccess("rated Added successfully");
    }



}
