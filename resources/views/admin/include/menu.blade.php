<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="./assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Category
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Category</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sub-category.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Product</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('admin.family.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Family</p>
                    </a>
                </li>
 
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Site Settings
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                    </ul>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.about.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>About Us</p>
                            </a>
                        </li>
                    </ul>
                    {{-- <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('admin.sub-category.index')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Sub Category</p>
                    </a>
                  </li>
                </ul> --}}
                </li>



                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Site Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}


            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
