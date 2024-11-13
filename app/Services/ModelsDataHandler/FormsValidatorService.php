<?php

namespace App\Services\ModelsDataHandler;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class FormsValidatorService
{

    private array $validateMapper = [
        "text" => "validateText",
        "textarea" => "validateText",
        "email" => "validateEmail",
        "password" => "validatePassword",
        "name" => "validateName",
        "number" => "validateNumber",
        "image" => "validateImage",
        "time" => "validateText",
        "date" => "validateDate"
    ];

    public static function start(): FormsValidatorService
    {
        return new self;
    }

    public function inputValidate($type, $required = true, $id = 0, $options = []): array
    {
        $rule = null;
        if(is_array($type)){
            $required = $type['required'] ?? $required;
            $rule = $type['rule'] ?? $rule;
            $type = $type['type'] ?? "text";
        }

        if($type == "checkbox") return [];

        if($type == "select")
            return $rule ?
                array_merge($this->validateSelect($required, $options), $rule) :
                $this->validateSelect($required, $options);

        return isset($this->validateMapper[$type]) ?
            (
                $rule ? array_merge($this->{$this->validateMapper[$type]}($required, $id), $rule) :
                $this->{$this->validateMapper[$type]}($required, $id)
            ) : [];
    }

    public function validateText($required = true, $id = 0): array
    {
        return $required ? ['required'] : ['sometimes', 'nullable'];
    }

    public function validateSelect($required = true, $options = []): array
    {
        $validateBuilder = $required ? ['required'] : ['sometimes', 'nullable'];
        if(count($options)) $validateBuilder[] = 'in:' . implode(',', $options);
        return $validateBuilder;
    }

    public function validatePassword($required = true, $id = 0): array
    {
        if($id) $validateBuilder = ['sometimes', 'nullable'];
        else $validateBuilder = $required ? ['required'] : ['sometimes', 'nullable'];
        return $validateBuilder;
    }

    public function validateEmail($required = true, $id = 0): array
    {
        $validateBuilder = $required ? ['required'] : ['sometimes', 'nullable'];
        $validateBuilder[] = 'email';
        if($id) $validateBuilder[] = Rule::unique('users', 'email')->ignore($id);
        else $validateBuilder[] = 'unique:users,email';
        return $validateBuilder;
    }

    public function validateDate($required = true, $id = 0): array
    {
        return $required ? ['required', 'date'] : ['sometimes', 'nullable', 'date'];
    }

    public function validateName($required = true, $id = 0): array
    {
        $validateBuilder = $required ? ['required'] : ['sometimes', 'nullable'];
        $validateBuilder[] = 'regex:/^[\p{Arabic}\sA-Za-z]+$/u';
        return $validateBuilder;
    }

    public function validateNumber($required = true, $id = 0): array
    {
        $validateBuilder = $required ? ['required'] : ['sometimes', 'nullable'];
        $validateBuilder[] = 'numeric';
        return $validateBuilder;
    }

    public function validateImage($required = true, $id = 0): array
    {
        $validateBuilder = $required ? ['required'] : ['sometimes', 'nullable'];
        $validateBuilder[] = 'image';
        $validateBuilder[] = 'mimes:jpeg,png,jpg,gif';
        $validateBuilder[] = 'max:5120';
        return $validateBuilder;
    }

    public function roleUnique($table, $column, $ignore = false): Unique
    {
        return $ignore ? Rule::unique($table, $column)->ignore($ignore) : Rule::unique($table, $column);
    }

}
