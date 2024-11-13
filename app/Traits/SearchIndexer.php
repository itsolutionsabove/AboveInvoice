<?php

namespace App\Traits;

use App\Services\ModelsDataHandler\SearchFilterService;
use Illuminate\Database\Eloquent\Builder;

trait SearchIndexer
{
    public function scopeFilter($query, $request): Builder
    {
        $cols = $this->fillable ?? false;
        if($this->formFields ?? false) $cols = $this->formFields;
        if(!$cols) return $query;
        $searches = [];
        foreach ($cols as $item => $type){
            if($request->{$item}) $searches[$item] = $request->{$item};
        }
        return SearchFilterService::prepare($query, $searches);
    }
}
