<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if($this->__name == "client-edit")
                        <h4 class="card-title">Edit Client</h4>
                    @else
                        <h4 class="card-title">Add Client</h4>
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
                            <label class="form-label">Name</label>
                            <input type="text" wire:model="name" class="form-control"
                                   autocomplete="off">
                            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Address </label>
                            <input type="text" wire:model="address" class="form-control"
                                   autocomplete="off">
                            @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                            <div class="mb-3">
                                <label class="form-label"> Tax Number </label>
                                <input type="text" wire:model="tax_number" class="form-control"
                                       autocomplete="off">
                                @error('tax_number') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> Phone </label>
                                <input type="text" wire:model="phone" class="form-control"
                                       autocomplete="off">
                                @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>



                        <div class="form-footer">
                            @if($this->__name == "client-edit")
                                <button type="submit" wire:loading.attr="disabled" wire:click.prevent="edit" class="btn btn-cyan w-100">
                                    <span wire:loading><i class="fa fa-circle-o-notch fa-spin"></i></span>
                                    <span wire:loading.remove>
                                        Edit
                                    </span>
                                </button>
                            @else
                                <button type="submit" wire:loading.attr="disabled" wire:click.prevent="add" class="btn btn-cyan w-100">
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

