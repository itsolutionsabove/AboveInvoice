<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public mixed $data;
    public string $title = "Roles";
    public ?string $search_text = null;
    public int $limit = 20, $page = 1, $offset, $pagesCount, $total;
    public string $orderBy = "id", $orderDirection = "desc";

    public function render(): View|Application|Factory
    {
        $this->load();
        return view('components.roles');
    }

    public function load(): void
    {
        $this->total = Role::count();
        $this->data = $this->search_text ? Role::where('name', 'LIKE', "%$this->search_text%") : Role::with([]);
        $this->offset = ($this->page - 1) * $this->limit;
        if($this->limit) $this->data->skip($this->offset)->take($this->limit);
        $this->pagesCount = ceil($this->total / $this->limit);
        $this->data->orderBy($this->orderBy, $this->orderDirection);
        $this->data = $this->data->get();
    }

    public function sortBy($orderBy, $direction): void
    {
        $this->orderBy = $orderBy;
        $this->orderDirection = $direction;
        $this->load();
    }

    public function delete($id){
        Role::find($id)?->delete();
        $this->load();
        ResponseService::flash("item deleted", 'message');
    }

    public function setPage($page) :void
    {
        $this->page = $page;
    }

}
