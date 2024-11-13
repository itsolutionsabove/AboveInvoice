<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$this->title}}</h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <div class="me-auto text-muted">
                            <select wire:model="limit" wire:change="load()" class="form-control">
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="0">all</option>
                            </select>
                        </div>
                        <div class="ms-auto text-muted">
                            Search:
                            <div class="ms-2 d-inline-block">
                                <div class="table-search">
                                    <input type="text" class="form-control form-control-sm" wire:keydown.enter="load()"
                                           aria-label="Search invoice" wire:model="search_text">
                                    <button wire:click="load()" class="btn btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="ms-auto text-muted" >
                            <a href="{{ url('admin/task-sort?flag=Product') }}" class="btn btn-cyan">
                                Sort Products&nbsp;<i class="fa fa-sort"></i> 
                            </a>
                        </div>
                    </div>
                </div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th>
                                <div class="table-sort-angles">
                                    Name
                                    <a href="#" wire:click="sortBy('name', 'asc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <a href="#" wire:click="sortBy('name', 'desc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="table-sort-angles">
                                    Price
                                    <a href="#" wire:click="sortBy('default_price', 'asc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <a href="#" wire:click="sortBy('default_price', 'desc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                </div>
                            </th>                           
                            <th>
                                <div class="table-sort-angles">
                                    Price After Discount
                                    <a href="#" wire:click="sortBy('price_after_discount', 'asc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <a href="#" wire:click="sortBy('price_after_discount', 'desc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                </div>
                            </th>                           

                            <th>
                                <div class="table-sort-angles">
                                    Categories
                                </div>
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($this->data as $row)
                            <tr>
                                <td>
                                    {{$row->name}}
                                </td>
                                <td>
                                    {{$row->default_price}}
                                </td>
                                <td>
                                    {{$row->price_after_discount}}
                                </td>
                                <td>
                                    @if($row->productCategories->count())
                                        {{implode(', ', $row->productCategories()->get()->transform(fn($item) => $item->category?->name)->toArray())}}
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-cyan" href="{{url('admin/product-edit/'.$row->id)}}" wire:navigate>
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button wire:loading.attr="disabled" class="btn btn-danger" wire:click="delete({{$row->id}})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>{{$this->offset + 1}}</span> to <span>{{$this->offset + $this->limit}}</span>
                        of <span>{{$this->total}}</span> entries</p>
                    <ul class="pagination m-0 ms-auto">
                        @if ($this->page > 1)
                            <li class="page-item">
                                <a class="page-link" href="#" tabindex="-1" wire:loading.attr="disabled" wire:click="setPage({{$this->page - 1}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                                    prev
                                </a>
                            </li>
                        @endif
                        @for($i = 1; $i <= $this->pagesCount; $i++)
                            <li class="page-item"><a class="page-link" wire:loading.attr="disabled" wire:click="setPage({{$i}})" href="#">{{$i}}</a></li>
                        @endfor

                        @if ($this->page < $this->pagesCount)
                                <li class="page-item">
                                    <a class="page-link" wire:loading.attr="disabled" wire:click="setPage({{$this->page + 1}})" href="#">
                                        next
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                                    </a>
                                </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

