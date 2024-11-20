<?php

namespace App\Livewire;

use App\Http\Resources\Settings\SettingsCollection;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Settings;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\PDFReportsService;
use App\Services\Response\ResponseService;
use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;
use id;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddInvoice extends Component
{
    use WithFileUploads;

    public $clients;
    public $isAddingClient = false; // Toggle between select and add client
    public $isSelectingClient = false;
    public $selected_client_id;
    public $client_name;
    public $client_address;
    public $client_tax_number;
    public $client_phone;
    public $invoice_number;
    public $invoice_date;
    public $total_amount;
    public $branches;
    public $settings;
    public $isEditing = false;
    public $show_qr = false;

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
    // Calculate total price and tax
    public $total_price;
    public $tax_percentage;
    public $total_price_after_tax;



    public Collection $allInvoices;

    public  $selectedBranch = null;

    public function render()
    {
        $this->formModel = [];
        foreach ($this->itemsForm as $key => $items) $this->formModel[$key] = '';
        $this->branches = Branch::all();
        $this->allInvoices = Invoice::all();
        $this->clients = Client::all();
        $this->total_price = array_sum(array_column($this->savedItems, 'price'));
        $this->tax_percentage = 0.15 * $this->total_price;
        $this->total_price_after_tax = $this->total_price + $this->tax_percentage;

        return view('components.addInvoice');
    }

    public function addItemes()
    {
        $this->validate([
            'formModel.name' => 'required',
            'formModel.price' => 'required',
        ]);
        $this->savedItems[] = $this->formModel;
    }

    public function deleteItems($index)
    {
        unset($this->savedItems[$index]);
    }

    protected function validateClientFields($isNew = true)
    {
        $rules = [
            'client_name' => 'required|string|max:255' . ($isNew ? '|unique:clients,name' : ''),
            'client_address' => 'required|string|max:255',
            'client_tax_number' => 'required|string|max:255' . ($isNew ? '|unique:clients,tax_number' : ''),
            'client_phone' => 'required|string|max:15' . ($isNew ? '|unique:clients,phone' : ''),
        ];

        $this->validate($rules);
    }
    public function add()
    {
        // Validate the form
        $this->validate([
            'total_amount' => 'required',
            'selectedBranch' => 'required',
            'savedItems' => 'required',
            'show_qr' => ['required', 'boolean'],
        ]);

        $settings = Settings::all();
        //use resource to get the settings
        $settings = new SettingsCollection($settings);
        if ($this->selectedBranch == 1) {
            $settingData = [
                'country' => $settings->where('key', 'country_Jordan')->first()->value,
                'address' => $settings->where('key', 'address_Jordan')->first()->value,
                'tax_number' => $settings->where('key', 'tax_number_Jordan')->first()->value,
                'phone' => $settings->where('key', 'phone_Jordan')->first()->value,
                'currency' => $settings->where('key', 'currency_Jordan')->first()->value,
            ];
        } else {
            $settingData = [
                'country' => $settings->where('key', 'country_saudi')->first()->value,
                'address' => $settings->where('key', 'address_saudi')->first()->value,
                'tax_number' => $settings->where('key', 'tax_number_saudi')->first()->value,
                'phone' => $settings->where('key', 'phone_saudi')->first()->value,
                'currency' => $settings->where('key', 'currency_saudi')->first()->value,
            ];
        }

        // Get the latest invoice number, format it
        $lastInvoice = Invoice::latest('invoice_number')->first();
        $this->invoice_number = $lastInvoice ? $lastInvoice->invoice_number + 1 : 1;
        $formattedInvoiceNumber = sprintf('%05d', $this->invoice_number);


        $branchName = Branch::find($this->selectedBranch)->name;

        // Prepare data for the invoice and PDF
        $invoiceData = [
            'client_name' => $this->client_name,
            'client_address' =>$this->client_address,
            'client_tax_number' => $this->client_tax_number,
            'client_phone' => $this->client_phone,
            'invoice_number' => $formattedInvoiceNumber,
            'invoice_date' => now()->format('Y-m-d'),
            'total_amount' => $this->total_amount,
            'total_price_after_tax' => $this->total_price_after_tax,
            'tax_percentage' => $this->tax_percentage,
            'total_price' => $this->total_price,
            'items' => $this->savedItems,
            'branch' => $branchName,
            'settingData' => $settingData,
            'show_qr' => $this->show_qr,
        ];



        if (!$this->isAddingClient) {
            $this->validate([
                'selected_client_id' => 'required',
            ]);

            if ($this->selected_client_id) {
                $this->validateClientFields(false); // Validate for existing client (no unique rule)

                $client = Client::findOrFail($this->selected_client_id);
                $client->update([
                    'name' => $this->client_name,
                    'address' => $this->client_address,
                    'tax_number' => $this->client_tax_number,
                    'phone' => $this->client_phone,
                ]);
            }
        } else {
            // Adding a new client
            $this->validateClientFields(); // Validate for new client (includes unique rule)

            Client::create([
                'name' => $this->client_name,
                'address' => $this->client_address,
                'tax_number' => $this->client_tax_number,
                'phone' => $this->client_phone,
            ]);
        }
        // Generate and save the PDF
        $pdfFileName = 'invoices/' . time() . '.pdf';
        $pdf = PDFReportsService::init()
            ->prepare('livewire.invoice-template', $invoiceData, $pdfFileName,  'false', null, 'false', 'A4');

        // Save the invoice record in the database
        $invoice = Invoice::create([
            'client_name' => $this->client_name,
            'client_address' =>$this->client_address,
            'client_tax_number' => $this->client_tax_number,
            'client_phone' => $this->client_phone,
            'invoice_number' => $formattedInvoiceNumber,
            'invoice_date' => now()->format('Y-m-d'),
            'total_amount' => $this->total_price,
            'branch_id' => $this->selectedBranch,
            'pdf_path' => $pdfFileName,
        ]);

        // Reset form after saving
        $this->resetForm();

        $pdfUrl = Storage::url($pdfFileName);

        $this->dispatch('pdf-generated', ['url' => $pdfUrl]);
        // Redirect to the PDF preview/download
        //        return redirect($pdfUrl);
        //        ResponseService::flash("added successfully", "message");

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
        $this->selected_client_id = null;
        $this->selectedBranch = null;
        $this->isAddingClient = false;
        $this->isEditing = false;
        $this->show_qr = false;
    }


    public function updatedSelectedClientId($clientId)
    {
        // Fetch and populate client data when the selection changes
        $client = Client::find($clientId);

        if ($client) {
            $this->client_name = $client->name;
            $this->client_address = $client->address;
            $this->client_tax_number = $client->tax_number;
            $this->client_phone = $client->phone;
        } else {
            $this->resetClientFields();
        }
    }

    public function resetClientFields()
    {
        // Reset the client fields
        $this->client_name = null;
        $this->client_address = null;
        $this->client_tax_number = null;
        $this->client_phone = null;
    }

}
