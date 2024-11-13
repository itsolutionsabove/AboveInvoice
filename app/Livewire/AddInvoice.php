<?php

namespace App\Livewire;

use App\Models\Category;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddInvoice extends Component
{
    use WithFileUploads;

    public $client_name;
    public $client_address;
    public $client_tax_number;
    public $client_phone;
    public $invoice_number;
    public $invoice_date;
    public $total_amount;

    public array $savedItems = [], $formModel = [], $itemsForm = [
        'name' => [
            'name' => 'name',
            'type' => 'text',
        ],

        'price' => [
            'name' => 'price',
            'type' => 'number',
        ],
    ];

    public ?array $categories = [];
    public Collection $allCategories;

    public  $selectedCategory = null;

    public function render()
    {
        $this->formModel = [];
        foreach ($this->itemsForm as $key => $items)$this->formModel[$key] = '';
        $this->allCategories = Category::all();
        return view('components.addInvoice');
    }

    public function addItemes()
    {
        $this->savedItems[] = $this->formModel;
    }

    public function deleteItems($index)
    {
        unset($this->savedItems[$index]);
    }

    public function add()
    {


        // Generate PDF
//        $pdf = PDF::loadView('livewire.invoice-template', $data);
//        $pdfPath = 'invoices/' . $this->invoice_number . '.pdf';
//        Storage::disk('public')->put($pdfPath, $pdf->output());
//
//        // Save invoice data in the database
//        Invoice::create([
//            'client_name' => $this->client_name,
//            'client_address' => $this->client_address,
//            'client_tax_number' => $this->client_tax_number,
//            'client_phone' => $this->client_phone,
//            'invoice_number' => $this->invoice_number,
//            'invoice_date' => $this->invoice_date,
//            'total_amount' => $this->total_amount,
//            'pdf_path' => $pdfPath,
//        ]);

        session()->flash('message', 'Invoice generated and saved successfully.');
    }
}
