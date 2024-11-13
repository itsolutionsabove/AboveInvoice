<?php

namespace App\Services\ModelsDataHandler;

use App\AppInfo;

class ViewElementsFormService
{

    private object $formElements;
    public function __construct(){
        $this->formElements = AppInfo::elements();
    }

    public function prepareFormInput(string|array $element, string $defaultValue,
                                     string $type, bool $multiple = false, mixed $options = [],
                                     string $model = "", array $where = []): string
    {
        if(!is_array($options) && $options == 'loader'){
            $options = $model::where($where)->get()->mapWithKeys(fn ($item, $key) => [$item['id'] => $item['name']])->toArray();
        }
        return $this->inputContainer(match ($type) {
            "text" => $this->inputText($element, $defaultValue),
            "textarea" => $this->inputTextarea($element, $defaultValue),
            "email" => $this->inputEmail($element, $defaultValue),
            "password" => $this->inputPassword($element),
            "date" => $this->inputDate($element, $defaultValue),
            "time" => $this->inputTime($element, $defaultValue),
            "image" => $this->inputImage($element, $multiple),
            "file" => $this->inputFile($element, $multiple),
            "number" => $this->inputNumber($element, $defaultValue),
            "select" => $this->inputSelect($element["name"] ?? $element, $options, $defaultValue, $element["label"] ?? $element),
            "checkbox" => $this->inputCheckbox($element, $defaultValue),
            "hidden" => $this->inputHidden($element, $defaultValue),
            default => "",
        });
    }

    public function form(string $action, string $content, string $method = "post", array $custom_attr = [], string $classes = null): string
    {
        $attr = [
            "action" => $action,
            "method" => $method,
            "class" => $this->formElements->form["class"] . " " . $classes
        ];
        if(count($custom_attr)) $attr = array_merge($attr, $custom_attr);
        return HTMLElementsUtils::tagDrawer("form", $attr, $content);
    }

    public function formBody(string $content): string
    {
        return HTMLElementsUtils::tagDrawer("div", [
            "class" => "card-body"
        ], HTMLElementsUtils::tagDrawer("div", [
            "class" => "row"
        ], $content));
    }

    public function inputContainer(string $input): string
    {
        return HTMLElementsUtils::tagDrawer("div", [
            "class" => "col-md-6 col-xl-12"
        ],  HTMLElementsUtils::tagDrawer('div', [
            "class" => 'mb-3'
        ], $input));
    }

    public function inputContainerSmall(string $input): string
    {
        return HTMLElementsUtils::tagDrawer("div", [
            "class" => "col-md-6"
        ],  HTMLElementsUtils::tagDrawer('div', [
            "class" => 'form-group'
        ], $input));
    }

    public function inputText(string|array $name, string $defaultValue = ""): string
    {
        return $this->inputDrawer($name, "text", $defaultValue ? ["value" => $defaultValue] : []);
    }

    public function inputCheckbox(string|array $name, string $defaultValue = ""): string
    {
        $tags = ["value" => 1];
        if($defaultValue) $tags["checked"] = "checked";
        return $this->inputDrawer($name, "checkbox", $tags, "form-checkbox");
    }

    public function inputEmail(string|array $name, string $defaultValue = ""): string
    {
        return $this->inputDrawer($name, "email", $defaultValue ? ["value" => $defaultValue] : []);
    }

    public function inputPassword(string|array $name): string
    {
        return $this->inputDrawer($name, "password");
    }

    public function inputDate(string|array $name, string $defaultValue = ""): string
    {
        return $this->inputDrawer($name, "date", $defaultValue ? ["value" => $defaultValue] : []);
    }

    public function inputTime(string|array $name, string $defaultValue = ""): string
    {
        return $this->inputDrawer($name, "time", $defaultValue ? ["value" => $defaultValue] : []);
    }

    public function inputSelect(string $name, array $options, string $defaultValue = "", $label = ""): string
    {
        $builder = HTMLElementsUtils::tagDrawer("label", [
            "class" => $this->formElements->form["label"]["class"],
        ], $label);

        $optionsHTML = HTMLElementsUtils::tagDrawer("option", [
            "value" => "",
        ], $label);

        foreach ($options as $value => $option)
            $optionsHTML .= HTMLElementsUtils::tagDrawer("option", $value == $defaultValue ? [
                "value" => $value,
                "selected" => "selected"
            ] : ["value" => $value], $option);

        $builder .= HTMLElementsUtils::tagDrawer("select", [
            "class" => $this->formElements->form["input"]["class"],
            "name"  => HTMLElementsUtils::inputName($name),
        ], $optionsHTML);

        return $builder;
    }

    public function inputTextarea(string|array $name, string $defaultValue = ""): string
    {

        if(is_array($name)){
            $label = $name["label"];
            $name = HTMLElementsUtils::inputName($name["name"]);
        }else{
            $label = $name;
            $name = HTMLElementsUtils::inputName($name);
        }

        $builder = HTMLElementsUtils::tagDrawer("label", [
            "class" => $this->formElements->form["label"]["class"],
        ], $label);

        $builder .= HTMLElementsUtils::tagDrawer("textarea", [
            "class" => $this->formElements->form["input"]["class"],
            "name"  => HTMLElementsUtils::inputName($name),
            "placeholder"  => $label
        ], $defaultValue);

        return $builder;
    }

    public function inputNumber(string|array $name, string $defaultValue = ""): string
    {
        return $this->inputDrawer($name, "number", $defaultValue ? ["value" => $defaultValue] : []);
    }

    public function inputImage(string|array $name, bool $multiple = false): string
    {
        $tags = ["accept" => 'image/*'];
        if($multiple) $tags["multiple"] = "multiple";
        return $this->inputDrawer($name, "file", $tags);
    }

    public function inputFile(string|array $name, bool $multiple = false): string
    {
        return $this->inputDrawer($name, "file", $multiple ? ["multiple" => "multiple"] : "");
    }

    public function token(): string
    {
        return $this->inputHidden('_token', csrf_token());
    }

    public function inputHidden($name, $value = null): string
    {
        return HTMLElementsUtils::tagDrawer("input", [
            "type" => "hidden",
            "value" => $value,
            "name" => HTMLElementsUtils::inputName($name)
        ], "", false);
    }

    public function formSubmit(): string
    {
        return $this->btnDrawer('submit', 'Save <i class="fa fa-disk"></i>');
    }

    public function formButton(string $text, ?string $classes = null, bool $useCardBody = true): string
    {
        return $this->btnDrawer('button', $text, $classes, $useCardBody);
    }

    public function btnDrawer(string $type, string $text, ?string $classes = null, bool $useCardBody = true): string
    {
        $button = HTMLElementsUtils::tagDrawer('button', [
            'type' => $type,
            'class' => 'btn btn-cyan ms-auto ' . $classes,
        ], $text);
        return $useCardBody ? HTMLElementsUtils::tagDrawer("div", [
            "class" => "card-footer text-end",
        ], HTMLElementsUtils::tagDrawer("div", [
            "class" => "d-flex"
        ], $button)) : $button;
    }

    public function inputDrawer(string|array $name, string $type, array $extraTags = [], ?string $classes = null, bool $useLabel = true, string $label = null): string
    {
        if(is_array($name)){
            $label = $name["label"];
            $name = HTMLElementsUtils::inputName($name["name"]);
        }else{
            $label = $name;
            $name = HTMLElementsUtils::inputName($name);
        }

        $builder = $useLabel ? HTMLElementsUtils::tagDrawer("label", [
            "class" => $this->formElements->form["label"]["class"],
        ], $label) : "";

        $tags = [
            "class" => $classes ?: $this->formElements->form["input"]["class"],
            "type"  => $type,
            "name"  => $name,
            "placeholder" => $label
        ];

        if(count($extraTags)) $tags = array_merge($tags, $extraTags);

        return $builder . HTMLElementsUtils::tagDrawer("input", $tags, "", false);
    }

}
