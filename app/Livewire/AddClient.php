<?php

namespace App\Livewire;

use App\Models\Client;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\Response\ResponseService;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;


class AddClient extends Component
{
    use WithFileUploads;

    public $name;
    public $address;
    public $tax_number;
    public $phone;

    public function render()
    {
        return view('components.addClient');
    }

    public function add()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_number' => 'required|string|max:255|unique:clients,tax_number',
            'phone' => 'required|string|max:15|unique:clients,phone',
        ]);

        $client = new Client();
        $client->name = $this->name;
        $client->address = $this->address;
        $client->tax_number = $this->tax_number;
        $client->phone = $this->phone;

        $client->save();

        $this->resetForm();
        ResponseService::flash("added successfully", "message");
    }

    public function resetForm()
    {
        $this->name = '';
        $this->address = '';
        $this->tax_number = '';
        $this->phone = '';
    }
}
