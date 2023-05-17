<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="20">
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="20">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.home') }}"  class="{{  (request()->route()->getName() == 'admin.home')?'active':''  }}">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="" class="has-arrow">My Profile</a>
                        </li>
                        <li>
                            <a href="" class="has-arrow">All Users</a>
                        </li>
                    </ul>
                </li>

                <li class="menu-title">Pages</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>Product Page</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a  href="{{  route('admin.category.index')  }}">Category</a></li>
                        <li><a  href="{{  route('admin.home-subcategory')   }}">SubCategory</a></li>
                        <li><a  href="{{  route('admin.product.index') }}">Products</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>Post Page</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a  href="{{ route('admin.tags.index') }}">Tag</a></li>
                        <li><a  href="{{ route('admin.categories.index') }}">Category</a></li>
                        <li><a  href="{{  route('admin.blog.index') }}">Blog</a></li>
                    </ul>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
