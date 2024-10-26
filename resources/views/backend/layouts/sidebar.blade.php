<div class="leftside-menu">
    <!-- Brand Logo Light -->
    <a href="index.html" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('template/backend') }}/images/logo.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('template/backend') }}/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('template/backend') }}/images/logo-dark.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('template/backend') }}/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="{{ asset('template/backend') }}/images/users/avatar-1.jpg" alt="user-image" height="42"
                    class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Tosha Minner</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-title">Navigation</li>
            <li class="activeDashboard side-nav-item">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="ri-home-4-line"></i>
                    <span> Dashboards </span>
                </a>
            </li>
            <li class="side-nav-title">Apps</li>
            <li class="activeProduct side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProduct" aria-expanded="false" aria-controls="sidebarProduct"
                    class="side-nav-link">
                    <i class="ri-mail-line"></i>
                    <span> Product </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProduct">
                    <ul class="side-nav-second-level">
                        <li id="activeProduct">
                            <a href="{{ route('product.index') }}">All Product</a>
                        </li>
                        <li>
                            <a href="{{ route('category.index') }}">Category</a>
                        </li>
                        <li>
                            <a href="{{ route('sub-category.index') }}">SubCategory</a>
                        </li>
                        <li>
                            <a href="{{ route('brand.index') }}">Brand</a>
                        </li>
                        <li id="activeAttributes">
                            <a href="{{ route('attributes.index') }}">Attributes</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html">Collection</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html">Product Reviews</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMarketing" aria-expanded="false"
                    aria-controls="sidebarMarketing" class="side-nav-link">
                    <i class="ri-task-line"></i>
                    <span> Marketing </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMarketing">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-tasks.html">Flash Sale</a>
                        </li>
                        <li>
                            <a href="apps-tasks-details.html">Subscribers</a>
                        </li>
                        <li>
                            <a href="apps-tasks-details.html">Coupon</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="apps-kanban.html" class="side-nav-link">
                    <i class="ri-list-check-3"></i>
                    <span> Orders </span>
                </a>
            </li>
            <li class="side-nav-title">Frontend</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUI" aria-expanded="false" aria-controls="sidebarUI"
                    class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span>Website Setup</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="pages-invoice.html">Header</a>
                        </li>
                        <li>
                            <a href="pages-profile.html">Homepage Setting</a>
                        </li>
                        <li>
                            <a href="pages-faq.html">Footer</a>
                        </li>
                        <li>
                            <a href="pages-pricing.html">Pages</a>
                        </li>
                        <li>
                            <a href="pages-maintenance.html">Appearance</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarBlogs" aria-expanded="false" aria-controls="sidebarBlogs"
                    class="side-nav-link">
                    <i class="ri-shield-user-line"></i>
                    <span> Blogs </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarBlogs">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="auth-login.html">All Blogs</a>
                        </li>
                        <li>
                            <a href="auth-login-2.html">Blogs Categories</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="apps-file-manager.html" class="side-nav-link">
                    <i class="ri-home-4-line"></i>
                    <span> Costumers </span>
                </a>
            </li>
            <li class="side-nav-title">Settings</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers"
                    class="side-nav-link">
                    <i class="ri-shield-user-line"></i>
                    <span> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="auth-login.html">All Users</a>
                        </li>
                        <li>
                            <a href="auth-login-2.html">Role & Permissions</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="apps-file-manager.html" class="side-nav-link">
                    <i class="ri-home-4-line"></i>
                    <span> Settings </span>
                </a>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
