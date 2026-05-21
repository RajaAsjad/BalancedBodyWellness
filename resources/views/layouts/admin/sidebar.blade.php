<aside class="main-sidebar" style="margin-top: 55px;">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->is('dashboard') || request()->is('profile/*') ? 'active blk' : '' }}">
                    <i class="fa fa-laptop"></i> <span>Dashboard</span>
                </a>
            </li>
            {{-- @can('role-list')
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
            @endcan --}}
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

            

            @can('service-list')
                <li class="treeview mt-2">
                    <a href="{{ route('service.index') }}" class="{{ request()->is('service') || request()->is('service/create') || request()->is('service/*/edit') || request()->is('service/*') ? 'active' : '' }}">
                        <i class="fa fa-envelope"></i> <span>Services</span>
                    </a>
                </li>
            @endcan

             
            {{-- <li class="treeview mt-2 {{ (request()->is('video') || request()->is('video/create') || request()->is('video/*/edit') || request()->is('audio') || request()->is('audio/create') || request()->is('audio/*/edit') || request()->is('audio/*') || request()->is('photogallery') || request()->is('photogallery/*') ) ? 'active' : '' }}" style="height: auto;">
                <a href="#" class="{{ (request()->is('video') || request()->is('video/create') || request()->is('video/*/edit') || request()->is('audio') || request()->is('audio/create') || request()->is('audio/*/edit') || request()->is('audio/*') || request()->is('photogallery') || request()->is('photogallery/*') ) ? 'active' : '' }}">
                    <i class="fa fa-files-o"></i>
                    <span>Highlight Videos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu" style="display: {{ (request()->is('video') || request()->is('video/create') || request()->is('video/*/edit') || request()->is('audio') || request()->is('audio/create') || request()->is('audio/*/edit') || request()->is('audio/*') || request()->is('photogallery') || request()->is('photogallery/*') ) ? 'block' : 'none' }};">

                    @can('video-list')
                    <li class="treeview mt-2">
                        <a href="{{ route('video.index') }}" class="{{ request()->is('video') || request()->is('video/create') || request()->is('video/*/edit') ? 'active' : '' }}">
                            <i class="fa fa-sitemap"></i> <span>Videos</span>
                        </a>
                    </li>
                    @endcan

                     @can('audio-list')
                    <li class="treeview mt-2">
                        <a href="{{ route('audio.index') }}" class="{{ request()->is('audio') || request()->is('audio/create') || request()->is('audio/*/edit') || request()->is('audio/*') ? 'active' : '' }}">
                            <i class="fa fa-code-fork"></i> <span>Audio</span>
                        </a>
                    </li>
                    @endcan   
                      @can('photogallery-list')
                    <li class="treeview mt-2">
                        <a href="{{ route('photogallery.index') }}" class="{{ request()->is('photogallery') || request()->is('photogallery/*') ? 'active' : '' }}">
                            <i class="fa fa-camera"></i> <span>Photo Gallery</span>
                        </a>
                    </li>
                    @endcan  
                </ul>
            </li> --}}
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
             
            {{-- @can('brands-list')
                <li class="treeview">
                    <a href="{{ route('brands.index') }}"
                        class="{{ request()->is('brands') || request()->is('brands/create') || request()->is('brands/*/edit') ? 'active blk' : '' }}">
                        <i class="fa fa-pencil-square-o"></i> <span>All Brands</span>
                    </a>
                </li>
            @endcan
            @can('weblinks-list')
                <li class="treeview">
                    <a href="{{ route('weblinks.index') }}"
                        class="{{ request()->is('weblinks') || request()->is('weblinks/create') || request()->is('weblinks/*/edit') ? 'active blk' : '' }}">
                        <i class="fa fa-pencil-square-o"></i> <span>All Web Links</span>
                    </a>
                </li>
            @endcan --}}
        </ul>
    </section>
</aside>
