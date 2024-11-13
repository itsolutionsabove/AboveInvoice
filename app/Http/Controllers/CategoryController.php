<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\ModelsDataHandler\FormsHandlerService;
use App\Services\Response\DataListingService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private string $model = Category::class;

    // public function store(Request $request): JsonResponse
    // {
    //     $handler = new FormsHandlerService($this->model);
    //     return $handler->validateAndCreate($request) ? ResponseService::jsonSuccess("added successfully") :
    //         ResponseService::jsonError($handler->error());
    // }

    public function index(Request $request): JsonResponse
    {
        return DataListingService::init()->list($this->model, $request,[
            'id',
            'name',
        ]);
    }

    public function apiList(Request $request): JsonResponse
    {
        $products = $this->model::with(['products'])->APISearch($request)->orderBy('order', 'desc')->get();
        return ResponseService::jsonData(new CategoryCollection($products));
    }

    public function apiHomeList(Request $request): JsonResponse
    {
        $products = $this->model::where('show_in_home_page', true)->orderBy('order', 'desc')->get();
        return ResponseService::jsonData(new CategoryCollection($products));
    }

    public function apiGet(Request $request): JsonResponse
    {
        $product = $this->model::with(['products'])->findOrFail($request?->id);
        //update view count
        $product->update(['views' => $product->views + 1]);
        return ResponseService::jsonData(new CategoryResource($product));
    }

    // public function update(Request $request, $id): JsonResponse
    // {
    //     $handler = new FormsHandlerService($this->model);
    //     return $handler->validateAndUpdate($request, $id) ? ResponseService::jsonSuccess("updated successfully") :
    //         ResponseService::jsonError($handler->error());
    // }

    // public function destroy($id)
    // {
    //     $model = $this->model::findOrFail($id);
    //     return $model->delete() ? ResponseService::jsonSuccess("deleted successfully") :
    //         ResponseService::jsonError("delete fail");
    // }

}
