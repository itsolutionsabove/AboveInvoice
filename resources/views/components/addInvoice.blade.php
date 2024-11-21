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
                            <div>
                                <!-- Tab Navigation -->
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary" wire:click="$set('isAddingClient', false)">
                                        Select Client
                                    </button>
                                    <button type="button" class="btn btn-secondary" wire:click="$set('isAddingClient', true)">
                                        Add Client
                                    </button>
                                </div>

                                <!-- Select Client Tab -->
                                @if(!$isAddingClient)
                                    <div>
                                        <label class="form-label">Select Client</label>
                                        <select class="form-control" wire:model="selected_client_id" wire:change="$set('isSelectingClient', true)">
                                            <option value="">Select Client</option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selected_client_id')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <!-- Add New Client Tab -->
                                @if($isSelectingClient)
                                    <hr>
                                    <div>
                                        <!-- Edit Button -->
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-cyan" wire:click="$toggle('isEditing')">
                                                <i class="fa fa-edit me-2"></i> Toggle Edit
                                            </button>
                                        </div>

                                        <!-- Input Fields -->
                                        <div>
                                            <div class="mb-3">
                                                <label class="form-label">Client Name</label>
                                                <input
                                                    type="text"
                                                    wire:model="client_name"
                                                    class="form-control"
                                                    autocomplete="off"
                                                    @if(!$isEditing) disabled @endif
                                                >
                                                @error('client_name')
                                                <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Client Address</label>
                                                <input
                                                    type="text"
                                                    wire:model="client_address"
                                                    class="form-control"
                                                    autocomplete="off"
                                                    @if(!$isEditing) disabled @endif
                                                >
                                                @error('client_address')
                                                <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Client Tax Number</label>
                                                <input
                                                    type="text"
                                                    wire:model="client_tax_number"
                                                    class="form-control"
                                                    autocomplete="off"
                                                    @if(!$isEditing) disabled @endif
                                                >
                                                @error('client_tax_number')
                                                <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Client Phone</label>
                                                <input
                                                    type="text"
                                                    wire:model="client_phone"
                                                    class="form-control"
                                                    autocomplete="off"
                                                    @if(!$isEditing) disabled @endif
                                                >
                                                @error('client_phone')
                                                <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                @endif
                                @if($isAddingClient)
                                    <hr>
                                    <div>
                                        <div class="mb-3">
                                            <label class="form-label">Client Name</label>
                                            <input type="text" wire:model="client_name" class="form-control" autocomplete="off">
                                            @error('client_name')
                                            <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Client Address</label>
                                            <input type="text" wire:model="client_address" class="form-control" autocomplete="off">
                                            @error('client_address')
                                            <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Client Tax Number</label>
                                            <input type="text" wire:model="client_tax_number" class="form-control" autocomplete="off">
                                            @error('client_tax_number')
                                            <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Client Phone</label>
                                            <input type="text" wire:model="client_phone" class="form-control" autocomplete="off">
                                            @error('client_phone')
                                            <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>


                                    </div>
                                @endif
                            </div>

                            {{--                        <div class="mb-3">--}}
{{--                            <label class="form-label">Total Amount in Text</label>--}}
{{--                            <input type="text" wire:model="total_amount" class="form-control"--}}
{{--                                   autocomplete="off">--}}
{{--                            @error('total_amount') <span class="text-danger error">{{ $message }}</span>@enderror--}}
{{--                        </div>--}}






                        <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">Branches</label>
                                    @error('branches') <span class="text-danger error">{{ $message }}</span> @enderror
                                    <div>
									        @foreach($this->branches as $branch)
                                            <span class="row">
                    <span class="col">{{ $branch->name }}</span>
                    <span class="col-auto">
                        <label class="form-check form-check-single form-switch">
                            <input
                                class="form-check-input"
                                wire:model="selectedBranch"
                                value="{{ $branch->id }}"
                                type="radio"> <!-- Changed to radio instead of checkbox -->
                        </label>

                    </span>
                </span>
                                        @endforeach
                                                @error('selectedBranch') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>



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
                                                        @error('formModel.'. $key )  <span class="text-danger error"> please fill This field</span>@enderror
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
                                        @error('savedItems') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            @foreach($this->itemsForm as $key => $input)
                                                <th style="color:black; border: 1px solid #ddd; padding: 8px;">{{$input['name']}}</th>
                                            @endforeach
                                            <th style="border: 1px solid #ddd; padding: 8px;">-</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($this->savedItems as $index => $role)
                                            <tr>
                                                @foreach($this->itemsForm as $key => $input)
                                                    <td style="border: 1px solid #ddd; padding: 8px;">{{$role[$key]}}</td>
                                                @endforeach
                                                <td style="border: 1px solid #ddd; padding: 8px;">
                                                    <button class="btn btn-danger" wire:click.prevent="deleteItems({{$index}})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-striped" style="border: 1px solid #ddd; padding: 8px;">
                                        <tr>
                                            <td>  Total Price  </td>
                                            <td>
											{{$this->total_price}}
                                            </td>

                                        </tr>
                                        <tr>
                                            <td> Tax Amount </td>
                                            <td>
                                              {{ $tax_percentage }}
                                            </td>

                                        </tr>
										<tr>
                                            <td>  Total Price with Tax  </td>
                                            <td>
											{{$this->total_price_after_tax}}
                                            </td>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Total Amount in Text</label>
                            <input type="text" wire:model="total_amount" class="form-control"
                                   autocomplete="off">
                            @error('total_amount') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                            <div class="col-sm-12">
                                <span class="row">
                                    <label class="col">Show QR Code</label>
                                    <span class="col-auto">
                                        <label class="form-check form-check-single form-switch">
                                            <input class="form-check-input" type="checkbox" wire:model="show_qr">
                                        </label>
                                    </span>
                                </span>
                            </div>

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

<script>
    // window.addEventListener('pdf-generated', (event) => {
    //     window.location = event.detail[0].url;
    // })
    window.addEventListener('pdf-generated', (event) => {
        window.open(event.detail[0].url, '_blank'); // Open the URL in a new tab
    });
</script>
