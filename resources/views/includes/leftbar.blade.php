<!-- Loader -->
<style type="text/css">
    #sidebar-menu > ul > li > a > span {
        color: #fff !important;
    }
    #sidebar-menu>ul>li>a.active {
        background: #0a1f3e !important;
        
    }
    #sidebar-menu > ul > li > a {
        color: #fff !important;
    }
    #sidebar-menu>ul>li>a.active i {
        color: #fff !important;
    }
</style>
<div id="preloader">
    <div id="status">
        <div class="spinner">
        </div>
    </div>
</div>
<!-- Begin page -->
<div id="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <!-- LOGO -->
        <div class="topbar-left" style="background-color: #0171c3; ">
            <div class="">
                <div class="topbar-left-img-div ">
                    <img alt="Nature" class="m-t-20 m-b-5 rounded-circle circular_image"
                        src="{{ asset('assets/images/users/dummy.png') }}" style="width:30%;" />
                    <div class="topbar-left-detail-div">
                        <p class="textcolor_light_grey m-b-5 font-12">
                            {{ ucfirst(Auth::user()->name) }}
                        </p>
                        <h4 class="textcolor_white font-14 mt-0 m-b-5">
                            {{ ucfirst(Auth::user()->emp_code) }}
                        </h4>
                    </div>
                </div>
                <!--<a href="index" class="logo text-center">Fonik</a>-->
                {{-- <a class="logo" href="{{route('home')}}">
                    <img alt="logo" height="20" src="{{asset('assets/images/logo.png')}}"/>
                </a> --}}
            </div>
        </div>
        <div class="sidebar-inner slimscrollleft " style="background-color: #0171c3; color: #fff" >
            <div id="sidebar-menu">
                <ul>

                    <li class="menu-title">{{ $menu->name }}</li>
                    
                    @foreach ($public_menu as $menu)
                        @if($menu['parent']==0 && $menu['isActive'] == 1)
                         
                        @can('view_' . Illuminate\Support\Str::snake($menu['label']))
                            <li class="menu-divider {{ $menu['class'] }}">
                                <a class="waves-effect"
                                    href="{{ $menu->child()->count() == 0 && $menu['link'] != '#' ? route($menu['link']) : '#' }}">
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span>
                                        {{ $menu['label'] }}
                                        @if (count($menu['child']) > 0)
                                            <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                                        @endif
                                    </span>
                                </a>
                                @if (count($menu['child']) > 0)
                                    <ul class="list-unstyled">
                                        @foreach ($menu['child'] as $child)
                                            @can('view_' . Illuminate\Support\Str::snake($child['label']))
                                                <li class="child-menu-divider {{ $child['class'] }}">
                                                    <a href="{{ route($child['link']) }}" title="{{ $child['label'] }}">
                                                        <i class="{{ $child['icon'] }}"></i>
                                                        {{ $child['label'] }}
                                                    </a>
                                                </li>
                                            @endcan
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endcan
                        @endif
                    @endforeach
 
                    @if (Auth::user()->isSuperADmin())
                        <li class="has_sub menu-divider">
                            <a class="waves-effect">
                                <i class="fa fa-building">
                                </i>
                                <span>
                                    Organization Setting
                                    <span class="pull-right">
                                        <i class="mdi mdi-chevron-right">
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                
                                <li class="child-menu-divider">
                                    <a href="{{ route('organizations.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Organization
                                    </a>
                                </li>
                                <li class="child-menu-divider">
                                    <a href="{{ route('affiliatedBody.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Developer(s)
                                    </a>
                                </li>
                                <li class="child-menu-divider">
                                    <a href="{{ route('wings.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Project(s)
                                    </a>
                                </li>
                                <li class="child-menu-divider">
                                    <a href="{{ route('organizationOfficeLocation.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Office Location(s)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('courses.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Product(s)
                                    </a>
                                </li>
                                <li class="child-menu-divider">
                                    <a href="{{ route('devproducts') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        View Hierarchy
                                    </a>
                                </li>
                                {{-- @can('view_departments') --}}
                                {{-- <li class="child-menu-divider">
                                    <a href="{{ route('departments.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Departments
                                    </a>
                                </li> --}}
                                {{-- @endcan --}}
                                {{-- @can('view_designations') --}}
                                {{-- <li class="child-menu-divider">
                                    <a href="{{ route('designations.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Designations
                                    </a>
                                </li> --}}

                                {{-- <li>
                                    <a href="{{ route('jobtitle.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Job Titles
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        @endif
                        @can('view_followups_management')
                       <!--  <li class="has_sub menu-divider">
                            <a class="waves-effect">
                                <i class="fa fa-building">
                                </i>
                                <span>
                                    Messages
                                    <span class="pull-right">
                                        <i class="mdi mdi-chevron-right">
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                <li class="child-menu-divider">
                                    <a href="{{ route('message-templates') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Message Templates
                                    </a>
                                </li>
                                <li class="child-menu-divider">
                                    <a href="{{ route('wa-groups') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Groups
                                    </a>
                                </li>  
                                <li class="child-menu-divider">
                                    <a href="{{ route('whatsapp.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Send Message
                                    </a>
                                </li> 
                                <li class="child-menu-divider">
                                    <a href="{{ route('message-logs') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Message Logs
                                    </a>
                                </li> 
                                <li class="child-menu-divider">
                                    <a href="{{ route('contact-us') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Contact Us
                                    </a>
                                </li> 
                            </ul>
                        </li> -->
                       
                        {{-- @can('view_settings') --}}
                        {{-- <li class="has_sub menu-divider">
                            <a class="waves-effect">
                                <i class="ion-ios7-cog">
                                </i>
                                <span>
                                    System Settings
                                    <span class="pull-right">
                                        <i class="mdi mdi-chevron-right">
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <ul class="list-unstyled">

                                <li>
                                    <a href="{{ route('courses.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Products
                                    </a>
                                </li>
                                <li class="child-menu-divider">
                                    <a href="{{ route('dynamicMenu.index', ['menu' => $menu->id]) }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        System Menu
                                    </a>
                                </li>

                                {{-- <li>
                                    <a href="{{ route('subjects.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Subjects
                                    </a>
                                </li> --}}
                        {{-- <li>
                            <a href="{{ route('permissions.index') }}">
                                <i class="mdi mdi-menu">
                                </i>
                                Permissions
                            </a>
                        </li> --}}
                        </ul>
                </li>
                @endcan 
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- end sidebarinner -->
    </div>
    <!-- Left Sidebar End -->
</div>
