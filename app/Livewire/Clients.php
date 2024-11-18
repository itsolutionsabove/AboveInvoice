<?php

namespace App\Livewire;


use App\Models\Client;
use App\Services\OrderingService;

class Clients extends DataListingComponent
{
    public function __construct()
    {
        $this->title = "Clients";
        parent::__construct(Client::class, 'components.clients');
    }

}
