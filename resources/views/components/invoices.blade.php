<?php
use Illuminate\Support\Facades\Storage;
    ?>

<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$this->title}}</h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <div class="row gap-3 gap-lg-0">
                       <div class="col-6 col-lg-2">
                           <div class="me-auto text-muted">
                               <label class="d-block">Items Per Page</label>
                               <select wire:model="limit" wire:change="load()" style="width: 70px;" class="form-control">
                                   <option value="20">20</option>
                                   <option value="50">50</option>
                                   <option value="100">100</option>
                                   <option value="0">all</option>
                               </select>
                           </div>
                       </div>

                        <!-- Date Range Filters -->
                        <div class="col-12 col-lg-6">
                            <div class="row mb-3 align-items-end gap-4 gap-lg-0">
                                <div class="col-12 col-lg-5">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" id="start_date" class="form-control" wire:model.lazy="start_date">
                                </div>
                                <div class="col-12 col-lg-5">
                                    <label for="end_date">End Date</label>
                                    <input type="date" id="end_date" class="form-control" wire:model.lazy="end_date">
                                </div>
                                <div class="col-12 col-lg-2">
                                    <button style="color:white" class="btn btn-outline-primary" wire:click="resetDates()">Reset</button>

                                </div>
                            </div>
                        </div>

    <div class="col-12 col-lg-4">
        <div class="ms-auto text-muted">
            <label for="search" class="d-block">Search</label>
            <div class="ms-2 d-inline-block w-100">
                <div class="table-search">
                    <input type="text" class="form-control w-100 form-control-sm me-2" name="search" id="search" wire:keydown.enter="load()"
                           aria-label="Search invoice" wire:model="search_text">
                    <button wire:click="load()" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" style="stroke: white" class="icon icon-tabler icon-tabler-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </div>
{{--                        <button class="btn btn-primary mb-3" wire:click="load()">Apply Filters</button>--}}

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
                                    Client Name
                                    <a href="#" wire:click="sortBy('client_name', 'asc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <a href="#" wire:click="sortBy('client_name', 'desc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="table-sort-angles">
                                    Invoice Number
                                    <a href="#" wire:click="sortBy('invoice_number', 'asc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <a href="#" wire:click="sortBy('invoice_number', 'desc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="table-sort-angles">
                                    Date
                                    <a href="#" wire:click="sortBy('invoice_date', 'asc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <a href="#" wire:click="sortBy('invoice_date', 'desc')" wire:loading.attr="disabled">
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="table-sort-angles">
                                    Branch
                                </div>
                            </th>
                            <th>
                                <div class="table-sort-angles">
                                    PDF
                                </div>
                            </th>
{{--                            <th></th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($this->data as $row)
                            <tr>
                                <td>
                                    {{$row->client_name}}
                                </td>
                                <td>
                                    {{$row->invoice_number}}
                                </td>
                                <td>
                                    {{$row->invoice_date}}
                                </td>

                                <td>
                                    {{$row->branch->name}}
                                </td>
                                <?php
                                    $pdfUrl = Storage::url($row->pdf_path);
                                ?>
                                <td>
                                    <a href="{{$pdfUrl}}" target="_blank">
                                        <i class="fa fa-file
                                        "> preview </i>
                                    </a>
                                </td>
{{--                                <td class="text-end">--}}
{{--                                    <a class="btn btn-cyan" href="{{url('admin/product-edit/'.$row->id)}}" wire:navigate>--}}
{{--                                        <i class="fa fa-pencil"></i>--}}
{{--                                    </a>--}}
{{--                                    <button wire:loading.attr="disabled" class="btn btn-danger" wire:click="delete({{$row->id}})">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
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

