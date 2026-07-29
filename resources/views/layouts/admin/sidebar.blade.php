<aside class="main-sidebar" style="margin-top: 55px;">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->is('dashboard') || request()->is('profile/*') ? 'active blk' : '' }}">
                    <i class="fa fa-laptop"></i> <span>Dashboard</span>
                </a>
            </li>
            @can('role-list')
                <li class="treeview">
                    <a href="{{ route('role.index') }}"
                        class="{{ request()->is('role') || request()->is('role/create') || request()->is('role/*/edit') ? 'active blk' : '' }}">
                        <i class="fa fa-user-plus"></i> <span>Roles</span>
                    </a>
                </li>
            @endcan
            @can('permission-list')
                <li class="treeview">
                    <a href="{{ route('permission.index') }}"
                        class="{{ request()->is('permission') || request()->is('permission/create') || request()->is('permission/*/edit') ? 'active blk' : '' }}">
                        <i class="fa fa-lock"></i> <span>Permissions</span>
                    </a>
                </li>
            @endcan
            @can('page-list')
                <li class="treeview">
                    <a href="{{ route('page.index') }}"
                        class="{{ request()->is('page') || request()->is('page/*') || request()->is('page_setting/*') ? 'active blk' : '' }}">
                        <i class="fa fa-cog"></i> <span>Settings</span>
                    </a>
                </li>
            @endcan  
          
            {{-- @can('banner-list')
                <li class="treeview mt-2">
                    <a href="{{ route('banner.index') }}" class="{{ request()->is('banner') || request()->is('banner/create') || request()->is('banner/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-picture-o"></i> <span>All Banners</span>
                    </a>
                </li>
            @endcan

            @can('homeslider-list')
                <li class="treeview mt-2">
                    <a href="{{ route('homeslider.index') }}" class="{{ request()->is('homeslider') || request()->is('homeslider/create') || request()->is('homeslider/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-tasks"></i> <span>Home Banner Slider</span>
                    </a>
                </li>
            @endcan --}}  
            
            {{-- @can('testimonial-list')
                <li class="treeview mt-2">
                    <a href="{{ route('testimonial.index') }}" class="{{ request()->is('testimonial') || request()->is('testimonial/create') || request()->is('testimonial/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-tasks"></i> <span>Testimonials</span>
                    </a>
                </li>
            @endcan   --}} 
            
            
            <li class="treeview mt-2 {{ (request()->is('service') || request()->is('service/create') || request()->is('service/*/edit') || request()->is('service/*') || request()->is('servicePage') || request()->is('servicePage/create') || request()->is('servicePage/*/edit') || request()->is('servicePage/*') ) ? 'active' : '' }}" style="height: auto;">
                <a href="#" class="{{ (request()->is('service') || request()->is('service/create') || request()->is('service/*/edit') || request()->is('service/*') || request()->is('servicePage') || request()->is('servicePage/create') || request()->is('servicePage/*/edit') || request()->is('servicePage/*') ) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Services Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu" style="display: {{ (request()->is('service') || request()->is('service/create') || request()->is('service/*/edit') || request()->is('service/*') || request()->is('servicePage') || request()->is('servicePage/create') || request()->is('servicePage/*/edit') || request()->is('servicePage/*') ) ? 'block' : 'none' }};">

                    @can('service-list')
                    <li class="treeview mt-2">
                        <a href="{{ route('service.index') }}" class="{{ request()->is('service') || request()->is('service/create') || request()->is('service/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-sitemap"></i> <span>Services</span>
                        </a>
                    </li>
                    @endcan

                    @can('servicepage-list')
                    <li class="treeview mt-2">
                        <a href="{{ route('servicePage.index') }}" class="{{ request()->is('servicePage') || request()->is('servicePage/create') || request()->is('servicePage/*/edit') || request()->is('servicePage/*') ? 'active' : '' }}">
                            <i class="fa fa-code-fork"></i> <span>Service Pages</span>
                        </a>
                    </li>
                    @endcan   
                </ul>
            </li> 
            @can('contactus-list')
                <li class="treeview mt-2">
                    <a href="{{ route('contactus.index') }}" class="{{ request()->is('contactus') || request()->is('contactus/create') || request()->is('contactus/*/edit') || request()->is('contactus/*') ? 'active' : '' }}">
                        <i class="fa fa-envelope"></i> <span>All Contact Us</span>
                    </a>
                </li>
            @endcan
            @can('faq-list')
                <li class="treeview">
                    <a href="{{ route('faq.index') }}" class="{{ request()->is('faq') || request()->is('faq/create') || request()->is('faq/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-question-circle"></i> <span>Faqs</span>
                    </a>
                </li>
            @endcan
            @can('policy-list')
                <li class="treeview">
                    <a href="{{ route('policy.index') }}" class="{{ request()->is('policy') || request()->is('policy/create') || request()->is('policy/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-file-text"></i> <span>Policies</span>
                    </a>
                </li>
            @endcan
            @can('location-list')
                <li class="treeview">
                    <a href="{{ route('location.index') }}" class="{{ request()->is('location') || request()->is('location/create') || request()->is('location/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-map-marker"></i> <span>Locations</span>
                    </a>
                </li>
            @endcan
            @can('blog-list')
                <li class="treeview mt-2">
                    <a href="{{ route('blog.index') }}" class="{{ request()->is('blog') || request()->is('blog/create') || request()->is('blog/*/edit') ? 'active' : '' }}">
                        <i class="fa fa-file-text-o"></i> <span>Blogs Management</span>
                    </a>
                </li>
            @endcan 
        </ul>
    </section>
</aside>
