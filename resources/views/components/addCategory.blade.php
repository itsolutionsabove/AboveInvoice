<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if($this->__name == "category-edit")
                        <h4 class="card-title">Edit Category</h4>
                    @else
                        <h4 class="card-title">Add Category</h4>
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
                            <label class="form-label">Name AR</label>
                            <input type="text" wire:model="name_ar" class="form-control"
                                   autocomplete="off">
                            @error('name_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            @if($this->image_url)
                                <a href="{{$this->image_url}}" target="_blank">download</a>
                            @endif
                            <input type="file" wire:model="image" class="form-control"
                                accept="image/*" autocomplete="off">
                            @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                            <div class="col-md-3 mb-3">
                                <span class="row">
                                    <label class="col">Show in Homepage</label>
                                    <span class="col-auto">
                                        <label class="form-check form-check-single form-switch">
                                            <input class="form-check-input" type="checkbox" wire:model="show_in_home_page">
                                        </label>
                                    </span>
                                </span>
                            </div>
                        <div class="form-footer">
                            @if($this->__name == "category-edit")
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

