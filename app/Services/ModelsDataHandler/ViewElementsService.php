<?php

namespace App\Services\ModelsDataHandler;

class ViewElementsService
{

    public function drawForm($model, $action, $defaults = [], $method = "post", $hidden = [], $additional = []): void
    {
        if(is_array($model)) $elements = $model;
        else{
            $model = new $model();
            $elements = $model->formFields ?? false;
        }

        if(!$elements) return;

        $v_elements = new ViewElementsFormService;

        $inputs = "";

        foreach ($elements as $element => $type){
            $default = $defaults[$element] ?? '';
            if(isset($type["label"])){
                $element = ["name" => $element, "label" => $type["label"]];
                unset($type["label"]);
            };
            if(is_array($type)){
                if(isset($type['required'])) unset($type['required']);
                if(isset($type['hash'])) unset($type['hash']);
                $inputs .= $v_elements->prepareFormInput($element, $default, ...$type);
                continue;
            }
            $inputs .= $v_elements->prepareFormInput($element, $default, $type);
        }

        foreach ($additional as $element => $type)
            $inputs .= $v_elements->prepareFormInput($element, ...$type);

        foreach ($hidden as $input => $value)
            $inputs .= $v_elements->inputHidden($input, $value);

        $inputs .= $v_elements->token();
        $inputs .= $v_elements->formSubmit();

        $form = $v_elements->form($action, $v_elements->formBody($inputs), $method);

        echo $form;

    }

    public function drawTable($api_url, $columns = [], $searches = []): void
    {
        $v_elements = new ViewElementsHelper;
        echo $v_elements->tableHtml($api_url, $columns, $searches);
    }

}
