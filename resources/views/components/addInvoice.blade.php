<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if($this->__name == "invoice-edit")
                        <h4 class="card-title">Edit Invoice</h4>
                    @else
                        <h4 class="card-title">Add Invoice</h4>
                    @endif
                </div>
                <div class="card-body">
                    <form>
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
                        <div class="mb-3">
                            <label class="form-label">client_name</label>
                            <input type="text" wire:model="client_name" class="form-control"
                                   autocomplete="off">
                            @error('client_name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">client_address</label>
                            <input type="text" wire:model="client_address" class="form-control"
                                   autocomplete="off">
                            @error('client_address') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">client_tax_number</label>
                            <input type="text" wire:model="client_tax_number" class="form-control"
                                   autocomplete="off">
                            @error('client_tax_number') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">client_phone</label>
                            <input type="text" wire:model="client_phone" class="form-control"
                                   autocomplete="off">
                            @error('client_phone') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">total_amount</label>
                            <input type="number" wire:model="total_amount" class="form-control"
                                   autocomplete="off">
                            @error('total_amount') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>


                        <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">Branches</label>
                                    @error('categories') <span class="text-danger error">{{ $message }}</span> @enderror
                                    <div>
                                        @foreach($this->allCategories as $role)
                                            <span class="row">
                    <span class="col">{{ $role->name }}</span>
                    <span class="col-auto">
                        <label class="form-check form-check-single form-switch">
                            <input
                                class="form-check-input"
                                wire:model="selectedCategory"
                                value="{{ $role->id }}"
                                type="radio"> <!-- Changed to radio instead of checkbox -->
                        </label>
                    </span>
                </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <label class="form-label">Categories</label>--}}
{{--                                @error('categories') <span class="text-danger error">{{ $message }}</span>@enderror--}}
{{--                                <div>--}}
{{--                                    @foreach($this->allCategories as $role)--}}
{{--                                        <span class="row">--}}
{{--                                        <span class="col">{{$role->name}}</span>--}}
{{--                                        <span class="col-auto">--}}
{{--                                            <label class="form-check form-check-single form-switch">--}}
{{--                                                <input class="form-check-input" wire:model="categories" value="{{$role->id}}"--}}
{{--                                                       type="checkbox" @if(in_array($role->id, $this->categories)) checked @endif>--}}
{{--                                            </label>--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <hr>


                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="form-label">Add Items Details</h3>
                                <div class="card">
                                    <div class="container-fluid" style='margin: 10px'>
                                        <div class="row">
                                            @foreach($this->itemsForm as $key => $input)
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{$input['name']}}</label>
                                                        @if($input['type'] == "textarea")
                                                            <textarea wire:model.defer="formModel.{{ $key }}"
                                                                      class="form-control"
                                                                      autocomplete="off"></textarea>
                                                        @else
                                                            <input type="{{$input['type']}}"
                                                                   wire:model.defer="formModel.{{ $key }}"
                                                                   class="form-control"
                                                                   autocomplete="off">
                                                        @endif
                                                        @error('formModel.'. $key )  <span class="text-danger error">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="submit" wire:loading.attr="disabled" wire:click.prevent="addItemes"
                                                class="btn btn-cyan">
                                            <span wire:loading><i class="fa fa-circle-o-notch fa-spin"></i></span>
                                            <span wire:loading.remove>
                                                Add to list
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <table class="table table-striped">
                                        <tr>
                                            @foreach($this->itemsForm as $key => $input)
                                                <th>{{$input['name']}}</th>
                                            @endforeach
                                            <th>
                                                -
                                            </th>
                                        </tr>
                                        @foreach($this->savedItems as $index => $role)
                                        <tr>
                                            @foreach($this->itemsForm as $key => $input)
                                                <td>{{$role[$key]}}</td>
                                            @endforeach
                                            <td>
                                                <button class="btn btn-danger"
                                                        wire:click.prevent="deleteItems({{$index}})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </Tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>


                        <div class="form-footer">
                            @if($this->__name == "invoice-edit")
                                <button type="submit" wire:loading.attr="disabled"
                                        wire:click.prevent="edit" class="btn btn-cyan w-100">
                                    <span wire:loading><i class="fa fa-circle-o-notch fa-spin"></i></span>
                                    <span wire:loading.remove>
                                        Edit
                                    </span>
                                </button>
                            @else
                                <button type="submit" wire:loading.attr="disabled" wire:click.prevent="add"
                                        class="btn btn-cyan w-100">
                                    <span wire:loading><i class="fa fa-circle-o-notch fa-spin"></i></span>
                                    <span wire:loading.remove>
                                        Create
                                    </span>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

