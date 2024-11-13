<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if($this->__name == "subscription-edit")
                        <h4 class="card-title">Edit Subscription</h4>
                    @else
                        <h4 class="card-title">Add Subscription</h4>
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
                            <label class="form-label">title</label>
                            <input type="text" wire:model="title" class="form-control"
                                   autocomplete="off">
                            @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">title AR</label>
                            <input type="text" wire:model="title_ar" class="form-control"
                                   autocomplete="off">
                            @error('title_ar') <span class="text-danger error">{{ $message }}</span>@enderror
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
                        <div class="mb-3">
                            <label class="form-label">Subscription Count</label>
                            <input type="text" wire:model="count" class="form-control"
                                   autocomplete="off">
                            @error('count') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" wire:model="default_price" class="form-control"
                                   autocomplete="off">
                            @error('default_price') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price After Discount</label>
                            <input type="text" wire:model="price_after_discount" class="form-control"
                                   autocomplete="off">
                            @error('price_after_discount') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea wire:model="description" class="form-control"
                                   autocomplete="off"></textarea>
                            @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description AR</label>
                            <textarea wire:model="description_ar" class="form-control"
                                   autocomplete="off"></textarea>
                            @error('description_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-footer">
                            @if($this->__name == "subscription-edit")
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

