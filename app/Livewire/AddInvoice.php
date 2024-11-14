<?php

namespace App\Livewire;

use App\Models\Invoice;
use App\Models\Branch;
use App\Models\Settings;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use PDF;
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
		$this->invoice_number = invoice::latest('invoice_number')->first();
		//dd($this->invoice_number);
        $items = $this->savedItems;
		 $total_price= 0;
          foreach( $items as  $item){
			  $total_price += $item['price'];
		  }
		  $tax_percentage = 15/100 * $total_price;
		  $total_price_after_tax =$total_price -(15/100 * $total_price) ;
		  
        // Generate PDF
//        $pdf = PDF::loadView('livewire.invoice-template', $data);
//        $pdfPath = 'invoices/' . $this->invoice_number . '.pdf';
//        Storage::disk('public')->put($pdfPath, $pdf->output());
//
//        // Save invoice data in the database
       $invoice = Invoice::create([
            'client_name' => $this->client_name,
           'client_address' => $this->client_address,
            'client_tax_number' => $this->client_tax_number,
            'client_phone' => $this->client_phone,
            'invoice_number' => $this->invoice_number,
           'invoice_date' => $this->invoice_date,
           'total_amount' => $this->total_amount,
           'pdf_path' => $pdfPath,
        ]);
       
        return $pdf->download('document.pdf');
       
    }
}
