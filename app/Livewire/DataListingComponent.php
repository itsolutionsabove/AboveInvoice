<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\LiveWireHandlers\DataListingService;
use App\Services\Response\ResponseService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Livewire\Component;
use Carbon\Carbon;

class DataListingComponent extends Component
{

    protected string $model;
    public mixed $data;
    public string $title = "Users";
    public ?string $search_text = null;
    public int $limit = 20, $page = 1, $offset, $pagesCount, $total;
    public string $orderBy = "id", $orderDirection = "desc";
    public string $component;

    public ?string $start_date = null;
    public ?string $end_date = null;


    private array $where = [], $with = [] , $whereBetween = [];

    /**
     * @param string $model
     */
    public function __construct(string $model, string $component)
    {
        $this->model = $model;
        $this->component = $component;
    }

    public function render(): View|Application|Factory
    {
        $this->load();
        return view($this->component);
    }

    public function load(): void
    {
        if ($this->start_date && $this->end_date) {
            $this->whereBetween[] = [
                'created_at', // Column name
                [Carbon::parse($this->start_date)->startOfDay(), Carbon::parse($this->end_date)->endOfDay()] // Date range values
            ];
        }
//        dd($this->whereBetween);
        $listingServ = DataListingService::init($this->model)
            ->setWith($this->with)
            ->setWhere($this->where)
            ->setWhereBetween($this->whereBetween)
            ->setOrderBy($this->orderBy)
            ->setOrderDirection($this->orderDirection)
            ->setSearchText($this->search_text)
            ->setPage($this->page)
            ->setLimit($this->limit)->dataListing();
        $this->total = $listingServ->getTotal();
        $this->offset = $listingServ->getOffset();
        $this->pagesCount = $listingServ->getPagesCount();
        $this->data = $listingServ->getData();
    }

    public function sortBy($orderBy, $direction): void
    {
        $this->orderBy = $orderBy;
        $this->orderDirection = $direction;
        $this->load();
    }

    public function delete($id){
        if($this->model instanceof User && $id == Auth::id()){
            ResponseService::flash("cant delete your self");
            return;
        }
        $this->model::find($id)?->delete();
        $this->load();
        ResponseService::flash("item deleted", 'message');
    }

    public function setPage($page) :void
    {
        $this->page = $page;
    }

    public function setWhere($where): DataListingComponent
    {
        $this->where = $where;
        return $this;
    }

    //set where bettwen start_date and end_date
    public function setWhereBetween($column, $start_date, $end_date): DataListingComponent
    {
        $this->whereBetween[] = [
            'column' => $column,
            'operator' => 'between',
            'value' => [$start_date, $end_date],
        ];
        return $this;
    }

    public function setWith($with): DataListingComponent
    {
        $this->with = $with;
        return $this;
    }

   // start_date and end_date are the date range fields
    public function setStartDate($start_date): DataListingComponent
    {
        $this->start_date = $start_date;
        return $this;
    }

    public function setEndDate($end_date): DataListingComponent
    {
        $this->end_date = $end_date;
        return $this;
    }



}
