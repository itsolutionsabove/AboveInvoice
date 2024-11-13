<?php

namespace App\Services\ModelsDataHandler;

use Illuminate\Database\Eloquent\Model;

class FormsHandlerService
{

    private Model $model;
    private string $error;
    private array $fields;

    public function __construct($model, $fields = [])
    {
        $this->model = new $model;
        $this->fields = count($fields) ? array_combine($fields, $fields) : $this->model->formFields ?? [];
    }

    public static function init($model): FormsHandlerService
    {
        return new self($model);
    }

    public function validate($request, $id = 0): bool|array
    {
        if(!$this->fields){
            $this->error = "invalid model fields";
            return false;
        }

        $validate = [];

        $formValidator = FormsValidatorService::start();

        foreach ($this->fields as $field => $type) {
            if($id) $validate[HTMLElementsUtils::inputName($field)] = $formValidator->inputValidate($type, true, $id);
            else $validate[HTMLElementsUtils::inputName($field)] = $formValidator->inputValidate($type);
        }
        return $this->ignoreNullables($request->validate($validate));
    }

    public function create($data, $request): mixed
    {
        if($data === false) return false;
        foreach ($data as $key => $item){
            if(in_array(($this->fields[$key] ?? null), ["image", "file"])){
                $data[$key] = $request->file($key)->store('uploads', 'public');
            }
        }
        $create = $this->model->create($data);
        if(!$create){
            $this->error = "failed to insert";
            return false;
        }
        return $create;
    }

    public function update($data, $request, $id): bool
    {
        $model = $this->model->findOrFail($id);
        foreach ($data as $key => $item){
            if(in_array(($this->fields[$key] ?? null), ["image", "file"])){
                $data[$key] = $request->file($key)->store('uploads', 'public');
            }
        }
        if(!$model->update($data)){
            $this->error = "Unable to update";
            return false;
        }
        return true;
    }

    public function validateAndCreate($request): mixed
    {
        return $this->create($this->validate($request), $request);
    }

    public function validateAndUpdate($request, $id): bool
    {
        return $this->update($this->validate($request, $id), $request, $id);
    }

    public function error(): string
    {
        return $this->error;
    }

    public function ignoreNullables(array $validated): array
    {
        return array_filter($validated, fn ($validate) => $validate);
    }

    public function arrayOnly(array $validated, array $only): array
    {
        return array_filter($validated, fn ($value, $validate) => in_array($validate, $only), ARRAY_FILTER_USE_BOTH);
    }

}
