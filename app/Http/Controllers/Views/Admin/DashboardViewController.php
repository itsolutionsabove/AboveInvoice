<?php

namespace App\Http\Controllers\Views\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\Response\ViewService;
use Illuminate\Foundation\Application;
use Illuminate\View\Factory;
use Illuminate\View\View;

class DashboardViewController extends Controller
{

    public function __invoke($page = "home"){
        return ViewService::show("livewire.admin.home", [
            "targetName" => "Dashboard",
            "title" => "dashboard",
            "content" => $page
        ], "dashboard");
    }
    public function home(): View|Application|Factory
    {
        return ViewService::show("admin.home", [], "Dashboard");
    }

}