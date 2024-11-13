<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if($this->__name == "product-edit")
                        <h4 class="card-title">Edit Product</h4>
                    @else
                        <h4 class="card-title">Add Product</h4>
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
                            <label class="form-label">Default Price</label>
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
                            <label class="form-label">Default Rate</label>
                            <input type="number" wire:model="default_rate" class="form-control"
                                   autocomplete="off">
                            @error('default_rate') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Story</label>
                            <textarea wire:model="story" class="form-control"
                                   autocomplete="off"></textarea>
                            @error('story') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Story AR</label>
                            <textarea wire:model="story_ar" class="form-control"
                                   autocomplete="off"></textarea>
                            @error('story_ar') <span class="text-danger error">{{ $message }}</span>@enderror
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
                        
                        
                        
                        <div class="mb-3">
                            <label class="form-label">Default Image</label>
                            @if($this->default_image_url)
                                <a href="{{$this->default_image_url}}" target="_blank">download</a>
                            @endif
                            <input type="file" wire:model="default_image" class="form-control"
                                accept="image/*"   autocomplete="off" wire:loading.attr="disabled">
                            @error('default_image') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Multi Images</label>
                            <span class="form-text text-muted">select one or more image please</span>
                            <input type="file" wire:model="images" class="form-control"
                                accept="image/*"  autocomplete="off" multiple wire:loading.attr="disabled">
                            @error('images') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="row">
                                <label class="col">Best Selling</label>
                                <span class="col-auto">
                                    <label class="form-check form-check-single form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model="visibility">
                                    </label>
                                </span>
                            </span>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Categories</label>
                                @error('categories') <span class="text-danger error">{{ $message }}</span>@enderror
                                <div>
                                    @foreach($this->allCategories as $role)
                                        <span class="row">
                                        <span class="col">{{$role->name}}</span>
                                        <span class="col-auto">
                                            <label class="form-check form-check-single form-switch">
                                                <input class="form-check-input" wire:model="categories" value="{{$role->id}}"
                                                       type="checkbox" @if(in_array($role->id, $this->categories)) checked @endif>
                                            </label>
                                        </span>
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Calories</label>
                            <input type="text" wire:model="calories" class="form-control"
                                   autocomplete="off">
                            @error('calories') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Serving Size</label>
                            <input type="text" wire:model="serving_size" class="form-control"
                                   autocomplete="off">
                            @error('serving_size') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="form-label">Add Nutrition Facts Details</h3>
                                <div class="card">
                                    <div class="container-fluid" style='margin: 10px'>
                                        <div class="row">
                                            @foreach($this->caloriesForm as $key => $input)
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
                                        <button type="submit" wire:loading.attr="disabled" wire:click.prevent="addCalories"
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
                                            @foreach($this->caloriesForm as $key => $input)
                                                <th>{{$input['name']}}</th>
                                            @endforeach
                                            <th>
                                                -
                                            </th>
                                        </tr>
                                        @foreach($this->savedCalories as $index => $role)
                                        <tr>
                                            @foreach($this->caloriesForm as $key => $input)
                                                <td>{{$role[$key]}}</td>
                                            @endforeach
                                            <td>
                                                <button class="btn btn-danger"
                                                        wire:click.prevent="deleteCalories({{$index}})">
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
                        <div class="mb-3">
                            <label class="form-label">Fact Details</label>
                            <textarea wire:model="fact_detail" class="form-control"
                                   autocomplete="off"></textarea>
                            @error('fact_detail') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Fact Details AR  </label>
                            <textarea wire:model="fact_detail_ar" class="form-control"
                                   autocomplete="off"></textarea>
                            @error('fact_detail_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="form-footer">
                            @if($this->__name == "product-edit")
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

