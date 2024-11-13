<?php

namespace App\Services\ModelsDataHandler;

use App\AppInfo;

class ViewElementsHelper
{

    private object $elements;

    public function __construct()
    {
        $this->elements = AppInfo::elements();
    }

    public function tableHtml(string $api_url, array $columns, array $searches = [], bool $allowLinks = true): string
    {

        $builder = $cols = "";
        $id = HTMLElementsUtils::inputName($api_url);

        if(count($searches)) $builder .= $this->tableSearchHtml($searches, $id);

        foreach ($columns as $key => $name){
            $cols .= HTMLElementsUtils::tagDrawer('th', [
                "class" =>  'text-uppercase text-secondary text-center font-weight-bolder opacity-7',
                "data-col" => $key,
            ], $name);
        }

        if($allowLinks) $cols .= HTMLElementsUtils::tagDrawer('th', [
            "class" =>  'text-uppercase text-secondary text-center font-weight-bolder opacity-7'
        ], 'Manage');

        return $builder . HTMLElementsUtils::tagDrawer('div', [
            "class" => $this->elements->table['parent_dev']['class'],
        ], HTMLElementsUtils::tagDrawer('table', [
            'class' => $this->elements->table['class'],
            'id' => $id,
            'data-api-url' => $api_url
        ], HTMLElementsUtils::tagDrawer('thead', [], HTMLElementsUtils::tagDrawer('tr', [], $cols))
               . HTMLElementsUtils::tagDrawer('tbody')
        ));

    }

    public function tableSearchHtml($searches, $id): string
    {
        $inputs = "";
        $formElements = new ViewElementsFormService();

        foreach ($searches as $fieldName => $field) {
            $attr = ['data-trigger' => $field['trigger']];
            if($field["trigger"] == "between:") $attr["data-related-date"] = $field["related_date"];
            $inputs .= $formElements->inputContainerSmall(
                $formElements->inputDrawer($fieldName, $field['type'], $attr, null, false)
            );
        }

        $inputs .= $formElements->inputContainerSmall(
            $formElements->formButton("Search <i class='fa fa-search'></i>", 'table-search-activator', false)
        );
        return HTMLElementsUtils::tagDrawer('div', [
            "class" => 'card',
        ], HTMLElementsUtils::tagDrawer('div', [
            "class" => 'container mid-width',
        ], $formElements->form("#", $formElements->formBody($inputs), "post", ["data-target-table" => "#" . $id], 'ignore-submit')));
    }

}
