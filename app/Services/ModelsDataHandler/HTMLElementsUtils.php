<?php

namespace App\Services\ModelsDataHandler;

class HTMLElementsUtils
{

    public static function tagDrawer(string $tag, array $attributes = [], $content = "", bool $close = true): string
    {
        $attributesHTML = "";
        foreach ($attributes as $attribute => $value) $attributesHTML .= " " . $attribute . '="' . $value . '"';
        return "<$tag" . $attributesHTML . ($close ? ">$content</$tag>" : " />");
    }

    public static function inputName($name): string
    {
        return preg_replace('/[^A-Za-z0-9]+/', '_', strtolower($name));
    }

    public static function selectOptionsArray(array $data, string $value, string $option): array
    {
        $return = [];
        foreach ($data as $item) $return[$item[$value]] = $item[$option];
        return $return;
    }

}
