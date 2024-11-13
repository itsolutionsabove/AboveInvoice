<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Admin</h4>
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
                            <input type="text" wire:model="name" value="{{$this->name}}" class="form-control"
                                   autocomplete="off">
                            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" wire:model="email" value="{{$this->name}}" class="form-control"
                                   placeholder="your@email.com" autocomplete="off">
                            @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        {{-- <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" wire:model="password" class="form-control"  autocomplete="off">
                                <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                           viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                           stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                      </svg>
                    </a>
                  </span>
                            </div>
                            @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div> --}}

                        <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" wire:model="password" class="form-control" id="passwordInput" autocomplete="off">
                                <span class="input-group-text">
                                    <a class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword()">
                                      <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                           viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                           stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                          <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                          <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                      </svg>
                                    </a>
                                </span>
                            </div>
                            @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">
                                Confirm Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" wire:model="c_password" class="form-control" id="confirmPasswordInput" autocomplete="off">
                                <span class="input-group-text">
                                    <a class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="toggleConfirmPassword()">
                                        <svg id="confirmEyeIcon" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                            @error('c_password') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                            @foreach($this->allRoles as $role)
                                <div class="col-sm-3">
                                    <span class="row">
                                        <span class="col">{{$role->name}}</span>
                                        <span class="col-auto">
                                            <label class="form-check form-check-single form-switch">
                                                <input class="form-check-input" wire:model="roles" value="{{$role->id}}"
                                                       type="checkbox" @if(in_array($role->id, $this->roles)) checked @endif>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                            @endforeach
                            @error('roles')<span class="text-danger error">{{ $message }}</span>@enderror
                        <div class="form-footer">
                            <button type="submit" wire:loading.attr="disabled" wire:click.prevent="edit" class="btn btn-cyan w-100">
                                <span wire:loading><i class="fa fa-circle-o-notch fa-spin"></i></span>
                                <span wire:loading.remove>
                                        Update
                                    </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script wire:ignore>
    function togglePassword() {
        var passwordInput = document.getElementById('passwordInput');
        var eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            // Change the input type to text, making the password visible
            passwordInput.type = 'text';
            // Change the eye icon to indicate that the password is visible
            eyeIcon.innerHTML = `<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                 <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                 <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                 <path d="M3 3l18 18" />`; // Eye-slash icon
        } else {
            // Change the input type back to password, hiding the password
            passwordInput.type = 'password';
            // Change the icon back to the regular eye icon
            eyeIcon.innerHTML = `<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                 <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                 <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />`; // Eye icon
        }
    }

    function toggleConfirmPassword() {
        var confirmPasswordInput = document.getElementById('confirmPasswordInput');
        var confirmEyeIcon = document.getElementById('confirmEyeIcon');
        
        if (confirmPasswordInput.type === 'password') {
            // Show password
            confirmPasswordInput.type = 'text';
            // Change icon to indicate password is visible
            confirmEyeIcon.innerHTML = `<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        <path d="M3 3l18 18" />`; // Eye-slash icon
        } else {
            // Hide password
            confirmPasswordInput.type = 'password';
            // Change icon back to indicate password is hidden
            confirmEyeIcon.innerHTML = `<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />`; // Eye icon
        }
    }
</script>