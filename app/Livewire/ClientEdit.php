<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ClientEdit extends Component
{
    use WithFileUploads;

    public $id;

    public $name;
    public $address;
    public $tax_number;
    public $phone;

    public ?Client $client;

    public function render()
    {
        $this->id = $this->id ?? request()?->id;
        $this->client = Client::findOrFail($this->id );
        $this->name = $this->client->name;
        $this->address = $this->client->address;
        $this->tax_number = $this->client->tax_number;
        $this->phone = $this->client->phone;
        return view('components.addClient');
    }

    public function edit()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('clients', 'tax_number')->ignore($this->id),
            ],
            'phone' => [
                'required',
                'string',
                'max:15',
                Rule::unique('clients', 'phone')->ignore($this->id),
            ],
        ]);

        $this->client->name = $this->name;
        $this->client->address = $this->address;
        $this->client->tax_number = $this->tax_number;
        $this->client->phone = $this->phone;

        $this->client->save();

        ResponseService::flash("updated successfully", "message");
    }
}
