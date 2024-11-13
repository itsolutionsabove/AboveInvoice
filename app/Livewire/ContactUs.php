<?php

namespace App\Livewire;

use App\Models\ContactUsMessage;

class ContactUs extends DataListingComponent
{
    public function __construct()
    {
        $this->title = "ContactUs";
        parent::__construct(ContactUsMessage::class, 'components.contactus');
    }
}