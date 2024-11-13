<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add User</h4>
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
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <span class="col">select all</span>
                                                <span class="col-auto">
                                                    <label class="form-check form-check-single form-switch">
                                                        <input class="form-check-input select-all" wire:click="selectAll"
                                                               value="1" type="checkbox" wire:model="selectAllItems">
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            @foreach($this->allPermissions as $permission)
                                <div class="col-sm-3">
                                    <span class="row">
                                        <span class="col">{{$permission->name}}</span>
                                        <span class="col-auto">
                                            <label class="form-check form-check-single form-switch">
                                                <input class="form-check-input" wire:model="permissions" value="{{$permission->name}}"
                                                       type="checkbox" @if(in_array($permission->name, $this->permissions)) checked @endif>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                            @endforeach
                            </div>
                            @error('permissions') <span class="text-danger error">{{ $message }}</span>@enderror
                            @error('permissions.*') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" wire:loading.attr="disabled" wire:click.prevent="add" class="btn btn-cyan w-100">
                                <span wire:loading><i class="fa fa-circle-o-notch fa-spin"></i></span>
                                <span wire:loading.remove>
                                        Create
                                    </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /*
    document.querySelector('.select-all').addEventListener('click', (e) => {
        let status = e.target.checked;
        document.querySelectorAll('.form-check-input:not(.select-all)').forEach((e) => {
            e.checked = true;
        });
    });

     */
</script>
