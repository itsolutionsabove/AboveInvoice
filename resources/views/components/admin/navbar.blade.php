<aside class="navbar navbar-vertical navbar-expand-lg dashboard-color">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark mt-3">
            <a href="{{url("/admin")}}">
                <img src="{{ asset($global->page->logo_url) }}" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin')}}" wire:navigate>
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-infographic" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M7 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                      <path d="M7 3v4h4" />
                      <path d="M9 17l0 4" />
                      <path d="M17 14l0 7" />
                      <path d="M13 13l0 8" />
                      <path d="M21 12l0 9" />
                    </svg>
                  </span>
                        <span class="nav-link-title">
                    Dashboard
                  </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                       data-bs-auto-close="false" role="button" aria-expanded="false" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                              <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                      </span>
                        <span class="nav-link-title">
                    Admins
                  </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{url('admin/add-user')}}" wire:navigate>
                                    Add new Admin
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{url('admin/users')}}" wire:navigate>
                                    List Admins
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                          <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                          <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg>
                  </span>
                        <span class="nav-link-title">
                    Roles
                  </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{url('admin/add-role')}}" wire:navigate>
                                    Add new Role
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{url('admin/roles')}}" wire:navigate>
                                    List Roles
                                </a>
                            </div>
                        </div>
                    </div>
                </li> --}}

{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >--}}
{{--                  <span class="nav-link-icon d-md-none d-lg-inline-block">--}}
{{--                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>--}}
{{--                          <path d="M4 4h6v6h-6z" />--}}
{{--                          <path d="M14 4h6v6h-6z" />--}}
{{--                          <path d="M4 14h6v6h-6z" />--}}
{{--                          <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />--}}
{{--                        </svg>--}}
{{--                  </span>--}}
{{--                        <span class="nav-link-title">--}}
{{--                    Categories--}}
{{--                  </span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu">--}}
{{--                        <div class="dropdown-menu-columns">--}}
{{--                            <div class="dropdown-menu-column">--}}
{{--                                <a class="dropdown-item" href="{{url('admin/add-category')}}" wire:navigate>--}}
{{--                                    Add new Category--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown-menu-column">--}}
{{--                                <a class="dropdown-item" href="{{url('admin/categories')}}" wire:navigate>--}}
{{--                                    List Categories--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M4 4h6v6h-6z" />
                          <path d="M14 4h6v6h-6z" />
                          <path d="M4 14h6v6h-6z" />
                          <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        </svg>
                  </span>
                        <span class="nav-link-title">
                    Invoices
                  </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{url('admin/add-invoice')}}" wire:navigate>
                                    Add new Invoice
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{url('admin/invoices')}}" wire:navigate>
                                    List Invoices
                                </a>
                            </div>
                        </div>
                    </div>
                </li>


                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-ringing" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                              <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                              <path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" />
                              <path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Notifications
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="#{{url('admin/list-notifications')}}" wire:navigate>
                                    Show
                                </a>
                            </div>
                        </div>
                    </div>
                </li> --}}

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-ringing" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                              <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                              <path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" />
                              <path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            contact us
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{url('admin/contact-us')}}" wire:navigate>
                                    Show
                                </a>
                            </div>
                        </div>
                    </div>
                </li> --}}


                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{url('admin/settings')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-cog" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M12.003 21c-.732 .001 -1.465 -.438 -1.678 -1.317a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c.886 .215 1.325 .957 1.318 1.694" />
                              <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                              <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                              <path d="M19.001 15.5v1.5" />
                              <path d="M19.001 21v1.5" />
                              <path d="M22.032 17.25l-1.299 .75" />
                              <path d="M17.27 20l-1.3 .75" />
                              <path d="M15.97 17.25l1.3 .75" />
                              <path d="M20.733 20l1.3 .75" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                </li>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" href="#{{url('admin/my-settings')}}"
                       data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" wire:navigate>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-cog" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                              <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" />
                              <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                              <path d="M19.001 15.5v1.5" />
                              <path d="M19.001 21v1.5" />
                              <path d="M22.032 17.25l-1.299 .75" />
                              <path d="M17.27 20l-1.3 .75" />
                              <path d="M15.97 17.25l1.3 .75" />
                              <path d="M20.733 20l1.3 .75" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Account Settings
                        </span>
                    </a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{url('sign-out')}}" role="button" wire:navigate>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-direction-sign" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M3.32 12.774l7.906 7.905c.427 .428 1.12 .428 1.548 0l7.905 -7.905a1.095 1.095 0 0 0 0 -1.548l-7.905 -7.905a1.095 1.095 0 0 0 -1.548 0l-7.905 7.905a1.095 1.095 0 0 0 0 1.548z" />
                              <path d="M8 12h7.5" />
                              <path d="M12 8.5l3.5 3.5l-3.5 3.5" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Sign out
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
