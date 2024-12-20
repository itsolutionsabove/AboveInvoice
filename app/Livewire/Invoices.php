<?php

namespace App\Livewire;

use App\Models\Invoice;


class Invoices extends DataListingComponent
{

    public function __construct()
    {
        $this->title = "Invoices";
        parent::__construct(Invoice::class, 'components.invoices');
    }

    // reset dates
    public function resetDates()
    {
        $this->start_date = null;
        $this->end_date = null;
    }
}
