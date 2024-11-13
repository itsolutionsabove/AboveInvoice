<?php

namespace App\Livewire;

use App\Models\User;

class Users extends DataListingComponent
{
    public function __construct()
    {
        $this->title = "Users";
        parent::__construct(User::class, 'components.users');
    }
}
