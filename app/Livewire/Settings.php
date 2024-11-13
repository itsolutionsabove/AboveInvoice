<?php

namespace App\Livewire;

use App\AppInfo;
use App\Models\Settings as SettingsModel;
use App\Services\FileUploadService;
use App\Services\Response\ResponseService;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Settings extends Component
{

    use WithFileUploads;

    public array $settings, $formSettings;

    public function render()
    {
        $settings = SettingsModel::all()->mapWithKeys(function ($value, $key){
            return [$value->key => $value->value];
        })->toArray();

        $this->settings = array_map(function($setting) use($settings){

            $setting['value'] = $settings[$setting['key']] ?? $setting['value'];
            if($setting['type'] != "file") $this->formSettings[$this->name($setting['key'])] = $setting['value'];
            return $setting;
        }, AppInfo::settings());

        return view('components.settings');
    }

    public function add()
    {
        foreach ($this->settings as $setting){
            if(!isset($this->formSettings[$this->name($setting['key'])])) continue;
            $find = SettingsModel::where('key', $setting['key']);
            $value = $this->formSettings[$this->name($setting['key'])];
            if($setting['type'] == "file"){
                $imageName = uniqid() . '.' . $value->getClientOriginalExtension();
                $value = $value->storeAs('settings/'.$imageName);
                // $value = FileUploadService::upload($value, 'settings' , 'image');
            }
            if($find->count()){
                $find->update(['value' => $value]);
                continue;
            }
            SettingsModel::create([
                'key' => $setting['key'],
                'type' => $setting['type'],
                'value' => $value
            ]);
        }
        ResponseService::flash("Saved successfully", "message");
    }

    public function name(string $text): string
    {
        return str_replace([" "], "", strtolower($text));
    }

}
