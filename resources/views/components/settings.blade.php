<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Settings</h4>
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
                        @foreach($this->settings as $setting)
                            <div class="mb-3">
                                <label class="form-label">{{$setting['key']}}</label>
                                <input type="{{$setting['type']}}" wire:model="formSettings.{{$this->name($setting['key'])}}" class="form-control"
                                       autocomplete="off"
                                >
                                @error("formSettings.{$this->name($setting['key'])}") <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        @endforeach
                        <div class="form-footer">
                            <button type="submit" wire:loading.attr="disabled" wire:click.prevent="add" class="btn btn-cyan w-100">
                                <span wire:loading><i class="fa fa-circle-o-notch fa-spin"></i></span>
                                <span wire:loading.remove>
                                    Save
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

