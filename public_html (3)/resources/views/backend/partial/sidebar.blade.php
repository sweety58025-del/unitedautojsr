@php
    use App\Models\CompanySetting;
    $logo = CompanySetting::firstRecord();
    $logo_image = "";
@endphp
@if ($logo)
    @php
        $logo_image = $logo->logo
    @endphp
@endif

<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="{{ route('admindashboard.get') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/company/'.$logo_image) }}" alt="" height="24">
                    </span>
                </a>
                <a href="{{ route('admindashboard.get') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/company/'.$logo_image) }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admindashboard.get') }}" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Pages</li>

                <li>
                    <a href="#services" data-bs-toggle="collapse">
                        <i data-feather="tool"></i>
                        <span> Services </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="services">
                        <ul class="nav-second-level">
                            {{-- <li>
                                <a href="{{ route('services.index') }}" class="tp-link">Service List</a>
                            </li> --}}
                            <li>
                                <a href="{{ route('category.index') }}" class="tp-link">Service</a>
                            </li>
                            <li>
                                <a href="{{ route('subcategory.index') }}" class="tp-link">Category</a>
                            </li>
                        </ul>
                    </div>
                </li> 

                <li>
                    <a href="#frontweb" data-bs-toggle="collapse">
                        <i data-feather="layout"></i>
                        <span>Website Content</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="frontweb">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('about_website.index') }}" class="tp-link">About Company</a>
                            </li>
                            <li>
                                <a href="{{ route('website_content.hero_banner') }}" class="tp-link">Hero Banner</a>
                            </li>
                            <li>
                                <a href="{{ route('service-price.index') }}" class="tp-link">Price List</a>
                            </li>
                            <li>
                                <a href="{{ route('brands.index') }}" class="tp-link">Brands</a>
                            </li>
                            <li>
                                <a href="{{ route('gallery.index') }}" class="tp-link">Gallery Images</a>
                            </li>
                            <li>
                                <a href="{{ route('testimonial.index') }}" class="tp-link">Testimonials</a>
                            </li>
                            <li>
                                <a href="{{ route('appointment.index') }}" class="tp-link">Appointments</a>
                            </li>
                        </ul>
                    </div>
                </li> 

                {{-- <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Employees </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employee') }}" class="tp-link">Employee List</a>
                            </li>
                        </ul>
                    </div>
                </li>  --}}

                {{-- <li>
                    <a href="widgets.html" class="tp-link">
                        <i data-feather="aperture"></i>
                        <span> Widgets </span>
                    </a>
                </li> --}}

                {{-- <li>
                    <a href="#sidebarMaps" data-bs-toggle="collapse">
                        <i data-feather="settings"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('roles') }}" class="tp-link">Roles</a>
                            </li>
                            <li>
                                <a href="{{ route('permission') }}" class="tp-link">Permissions</a>
                            </li>
                            <li>
                                <a href="{{ route('permission-categories.index') }}" class="tp-link">Permissions Category</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.setting') }}" class="tp-link">Company Setting</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->