<div class="page page-center">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="./" class="navbar-brand navbar-brand-autodark">
                <img src="{{asset("static/logo.svg")}}" height="60px" alt="">
            </a>
        </div>
        <div class="card card-md" >
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Login to your account</h2>
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
                        <label class="form-label">Email address</label>
                        <input type="email" wire:model="email" class="form-control"
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
                            {{-- <span class="form-label-description">
                                <a href="#">I forgot password</a>
                            </span> --}}
                        </label>
                        <div class="input-group input-group-flat">
                            <input type="password" wire:model="password" class="form-control" id="passwordInput" autocomplete="off">
                            <span class="input-group-text">
                                <a class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword()">
                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                </a>
                            </span>
                        </div>
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-check">
                            <input wire:model="remember"  type="checkbox" class="form-check-input"/>
                            <span class="form-check-label">Remember me</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" wire:loading.attr="disabled" wire:click.prevent="authTaken" class="btn btn-cyan w-100" style="background-color: #538072;">
                            <span wire:loading>
                                <i class="fa fa-circle-o-notch fa-spin"></i>
                            </span>
                            <span wire:loading.remove>
                                Sign in
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script wire:ignore>
    function togglePassword() {
        var passwordInput = document.getElementById('passwordInput');
        var eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            // Show the password
            passwordInput.type = 'text';
            // Change the eye icon to an eye-slash
            eyeIcon.innerHTML = `<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                 <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                 <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                 <path d="M3 3l18 18" />`; // Eye-slash icon
        } else {
            // Hide the password
            passwordInput.type = 'password';
            // Change the icon back to the regular eye
            eyeIcon.innerHTML = `<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                 <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                 <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />`; // Eye icon
        }
    }
</script>