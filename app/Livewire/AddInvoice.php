<?php

namespace App\Livewire;

use App\Models\Invoice;
use App\Models\Branch;
use App\Models\Settings;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\PDFReportsService;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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
    public $branches;
	public $settings;

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

    public Collection $allInvoices;

    public  $selectedBranch = null;

    public function render()
    {
        $this->formModel = [];
        foreach ($this->itemsForm as $key => $items)$this->formModel[$key] = '';
		$this->branches = Branch::all();
        $this->allInvoices = Invoice::all();
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

        // Get the latest invoice number, format it
        $lastInvoice = Invoice::latest('invoice_number')->first();
        $this->invoice_number = $lastInvoice ? $lastInvoice->invoice_number + 1 : 1;
        $formattedInvoiceNumber = sprintf('%05d', $this->invoice_number);

        // Calculate total price and tax
        $items = $this->savedItems;
        $total_price = array_sum(array_column($items, 'price'));
        $tax_percentage = 0.15 * $total_price;
        $total_price_after_tax = $total_price - $tax_percentage;

        // Prepare data for the invoice and PDF
        $invoiceData = [
            'client_name' => $this->client_name,
            'client_address' => $this->client_address,
            'client_tax_number' => $this->client_tax_number,
            'client_phone' => $this->client_phone,
            'invoice_number' => $formattedInvoiceNumber,
            'invoice_date' => now()->format('Y-m-d'),
            'total_amount' => $this->total_amount,
            'total_price_after_tax' => $total_price_after_tax,
            'items' => $items,
        ];

        // Generate and save the PDF
        $pdfFileName = 'invoices/' . time() . '.pdf';
        $pdf = PDFReportsService::init()
            ->prepare('livewire.invoice-template', $invoiceData, $pdfFileName,  'false', null, 'false', 'A4');

        // Save the invoice record in the database
        $invoice = Invoice::create([
            'client_name' => $this->client_name,
            'client_address' => $this->client_address,
            'client_tax_number' => $this->client_tax_number,
            'client_phone' => $this->client_phone,
            'invoice_number' => $formattedInvoiceNumber,
            'invoice_date' => now()->format('Y-m-d'),
            'total_amount' => $this->total_amount,
            'branch_id' => $this->selectedBranch,
            'pdf_path' => $pdfFileName,
        ]);

        // Reset form after saving
        $this->resetForm();
        ResponseService::flash("added successfully", "message");

    }

    public function resetForm()
    {
        $this->client_name = '';
        $this->client_address = '';
        $this->client_tax_number = '';
        $this->client_phone = '';
        $this->invoice_number = '';
        $this->invoice_date = '';
        $this->total_amount = '';
        $this->savedItems = [];
    }
}
