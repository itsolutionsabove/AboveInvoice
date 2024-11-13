<?php

namespace App\Services\Response;

use Illuminate\Http\JsonResponse;

class DataListingService
{

    private mixed $onReturn = null;
    private array $scopes;

    public static function init(): DataListingService
    {
        return new self();
    }

    public function list($model, $request, $only = [], $with = [], $scopes = [], $orderBy = "id", $order_dir = "asc"): JsonResponse
    {

        $records = $model::with($with);

        if($request) $records->filter($request);
        if($request->limit) $records->limit($request->limit);
        $records->orderBy($orderBy, $order_dir);

        foreach ($this->scopes ?? $scopes as $scope) $records->{$scope}($request);

        return ResponseService::json(["data" => self::formatReturn($records->get(), $only)]);
    }

    private function formatReturn($columns, $only)
    {

        $onReturn = $this->onReturn;

        if(count($only)) {
            $columns = $columns->map(function ($item) use($only, $onReturn){
                $return = [];
                foreach ($only as $column){
                    $explode = explode(".", $column);
                    if(count($explode)){
                        $dataObject = $item;
                        foreach ($explode as $relation)
                            $dataObject = $dataObject?->{$relation};

                        $return[$column] = is_callable($onReturn) ? $onReturn($column, $dataObject) : $dataObject;
                        continue;
                    }
                    $return[$column] = is_callable($onReturn) ?
                        $onReturn($column, $item?->{$column} ?? null) : $item?->{$column} ?? null;
                }
                return $return;
            });
        }

        return $columns;

    }

    public function onReturn($callback): DataListingService
    {
        $this->onReturn = $callback;
        return $this;
    }

    public function setScopes(array $scopes): DataListingService
    {
        $this->scopes = $scopes;
        return $this;
    }

}
