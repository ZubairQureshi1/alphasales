<li class="has_sub menu-divider">
    <a class="waves-effect">
        <i class="fa fa-money">
        </i>
        <span>
            Accounts Management
            <span class="pull-right">
                <i class="mdi mdi-chevron-right">
                </i>
            </span>
        </span>
    </a>
    <ul class="list-unstyled">
        <li class="child-menu-divider">
            <a class="waves-effect" href="{{ route('accounts.index') }}">
                <i class="mdi mdi-menu">
                </i>
                <span>
                    Accounts
                </span>
            </a>
        </li>
        {{-- <li>
                                <a href="{{route('accounts.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    My Attendance
                                </a>
                            </li> --}}
        {{-- @can('view_account_reportings') --}}
        <li class="child-menu-divider">
            <a href="{{ route('accounts.reportings') }}">
                <i class="mdi mdi-menu">
                </i>
                Reporting
            </a>
        </li>
        <li class="child-menu-divider">
            <a href="{{ route('accounts.sessionReport') }}">
                <i class="mdi mdi-menu">
                </i>
                Overall Paid Unpaid Report
            </a>
        </li>
        <li class="child-menu-divider">
            <a href="{{ route('accounts.getOverallClearanceSlip') }}">
                <i class="mdi mdi-menu">
                </i>
                Overall Clearance Slip
            </a>
        </li>
        {{-- @endcan --}}
        {{-- @can('view_account_package_verification') --}}
        <li class="child-menu-divider">
            <a href="{{ route('accounts.verifyPackages') }}">
                <i class="mdi mdi-menu">
                </i>
                Package Plan Verification
            </a>
        </li>
        {{-- @endcan --}}
        {{-- @can('view_account_instalment_verification') --}}
        <li class="child-menu-divider">
            <a href="{{ route('accounts.verifyInstalments') }}">
                <i class="mdi mdi-menu">
                </i>
                Instalments Verification
            </a>
        </li>
        {{-- @endcan --}}
        <li class="child-menu-divider">
            <a href="{{ route('accounts.voucherLists') }}">
                <i class="mdi mdi-menu">
                </i>
                Voucher Lists
            </a>
        </li>
        <li class="child-menu-divider">
            <a href="{{ route('accounts.headsVoucherLists') }}">
                <i class="mdi mdi-menu">
                </i>
                Heads Voucher Lists
            </a>
        </li>
        <li class="child-menu-divider">
            <a href="{{ url('accountGrowth') }}">
                <i class="mdi mdi-chart-bar">
                </i>
                Insights
            </a>
        </li>
    </ul>
</li>




























<!-- Loader -->
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
        <div class="topbar-left">
            <div class="">
                <div class="topbar-left-img-div ">
                    <img alt="Nature" class="m-t-20 m-b-5 rounded-circle circular_image"
                        src=".{{ $user->profile_pic_url!=''?config('constants.attachment_path.emp_qr_destination_path').$user->emp_code.'/profile_picture/'.$user->profile_pic_url: asset('assets/images/users/avatar-4.jpg')}}" style="width:30%;" />
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
        <div class="sidebar-inner slimscrollleft ">
            <div id="sidebar-menu">
                <ul>
                    <li class="menu-title">
                    </li>
                    <li class="menu-divider">
                        <a class="waves-effect" href="{{ route('home') }}">
                            <i class="ion-laptop">
                            </i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>
                    @can('view_profile')
                        <li class="menu-divider">
                            <a class="waves-effect" href="{{ route('profiles.index') }}">
                                <i class="ion-person-stalker">
                                </i>
                                <span>
                                    Profile
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('view_user_masters')
                        <li class="has_sub menu-divider">
                            <a class="waves-effect">
                                <i class="ion-ios7-people">
                                </i>
                                <span>
                                    User Masters
                                    <span class="pull-right">
                                        <i class="mdi mdi-chevron-right">
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                @can('view_users')
                                    <li class="child-menu-divider">
                                        <a href="{{ route('users.index') }}">
                                            <i class="mdi mdi-menu">
                                            </i>
                                            Users
                                        </a>
                                    </li>
                                @endcan
                                @can('view_roles')
                                    <li class="child-menu-divider">
                                        <a href="{{ route('roles.index') }}">
                                            <i class="mdi mdi-menu">
                                            </i>
                                            Roles
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('view_enquiries')
                        <li class="has_sub menu-divider">
                            <a class="waves-effect">
                                <i class="ion-android-note">
                                </i>
                                <span>
                                    Enquiries Management
                                    <span class="pull-right">
                                        <i class="mdi mdi-chevron-right">
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                <li class="child-menu-divider">
                                    <a class="waves-effect" href="{{ route('enquiries.index') }}">
                                        <i class="ion-android-note">
                                        </i>
                                        <span>
                                            Enquiries
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('view_follow_ups')
                        <li>
                        <li class="has_sub menu-divider">
                            <a class="waves-effect">
                                <i class="ion-android-note">
                                </i>
                                <span>
                                    Followups Management
                                    <span class="pull-right">
                                        <i class="mdi mdi-chevron-right">
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                <li class="child-menu-divider">
                                    <a class="waves-effect" href="{{ route('followups.index') }}">
                                        <i class="ion-android-note">
                                        </i>
                                        <span>
                                            Followups
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        </li>
                    @endcan
                    @can('view_admissions')
                        <li class="has_sub menu-divider">
                            <a class="waves-effect">
                                <i class="fa fa-money">
                                </i>
                                <span>
                                    Admission Management
                                    <span class="pull-right">
                                        <i class="mdi mdi-chevron-right">
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                <li class="child-menu-divider">
                                    <a class="waves-effect" href="{{ route('admissions.index') }}">
                                        <i class="mdi mdi-book-open-page-variant">
                                        </i>
                                        <span>
                                            Admissions
                                        </span>
                                    </a>
                                </li>
                                <li class="child-menu-divider">
                                    <a class="waves-effect" href="{{ route('admissionByEnquiryForm.index') }}">
                                        <i class="ion-android-note">
                                        </i>
                                        <span>
                                            Confirmed Admissions
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    <li class="has_sub menu-divider">
                        <a class="waves-effect">
                            <i class="fa fa-building">
                            </i>
                            <span>
                                Organization Management
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
                                    Organizations
                                </a>
                            </li>
                            <li class="child-menu-divider">
                                <a href="{{ route('organizationOfficeLocation.index') }}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Organization Campuses
                                </a>
                            </li>
                            <li class="child-menu-divider">
                                <a href="{{ route('wings.index') }}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Academic Wing
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('jobtitle.index') }}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Job Titles
                                </a>
                            </li>

                        </ul>
                    </li>
                    @can('view_settings')
                        <li class="has_sub menu-divider">
                            <a class="waves-effect">
                                <i class="ion-ios7-cog">
                                </i>
                                <span>
                                    Settings
                                    <span class="pull-right">
                                        <i class="mdi mdi-chevron-right">
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <ul class="list-unstyled">
                                <li class="child-menu-divider">
                                    <a href="{{ route('affiliatedBody.index') }}">
                                        <i class="mdi mdi-menu">
                                        </i>
                                        Affiliated Body
                                    </a>
                                </li>
                                {{-- <li class="child-menu-divider">
                                <a href="{{route('announcements.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Announcement
                                </a>
                            </li> --}}
                                {{-- @can('view_degrees')
                            <li>
                                <a href="{{route('courses.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Degree/Courses
                                </a>
                            </li>
                            @endcan --}}
                                {{-- @can('view_departments') --}}
                                {{-- <li class="child-menu-divider">
                                <a href="{{route('departments.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Departments
                                </a>
                            </li> --}}
                                {{-- @endcan --}}
                                {{-- @can('view_designations') --}}
                                {{-- <li class="child-menu-divider">
                                <a href="{{route('designations.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Designations
                                </a>
                            </li> --}}
                                {{-- @endcan --}}
                                {{-- <li class="child-menu-divider">
                                <a href="{{route('headFines.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Heads
                                </a>
                            </li>
                            <li class="child-menu-divider">
                                <a href="{{route('notice_board.index')}}">
                                    <i aria-hidden="true" class="mdi mdi-menu">
                                    </i>
                                    Notice Board
                                </a>
                            </li> --}}
                                {{-- <li class="child-menu-divider">
                                <a href="{{route('rooms.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Rooms
                                </a>
                            </li> --}}
                                {{-- @can('view_subjects')
                            <li>
                                <a href="{{route('subjects.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Subjects
                                </a>
                            </li>
                            @endcan --}}
                                @can('view_sessions')
                                    <li class="child-menu-divider">
                                        <a href="{{ route('sessions.index') }}">
                                            <i class="mdi mdi-menu">
                                            </i>
                                            Sessions
                                        </a>
                                    </li>
                                @endcan
                                {{-- <li class="child-menu-divider">
                                <a href="{{route('sections.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Sections
                                </a>
                            </li> --}}

                                @can('view_semesters')
                                    {{-- <li class="child-menu-divider">
                                <a href="{{route('semester.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Semester
                                </a>
                            </li> --}}
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </div>
            <div class="clearfix">
            </div>
        </div>
        <!-- end sidebarinner -->
    </div>
    <!-- Left Sidebar End -->
</div>










{{-- @can('view_settings') --}}
<li class="has_sub menu-divider">
    <a class="waves-effect">
        <i class="ion-ios7-cog">
        </i>
        <span>
            General Settings
            <span class="pull-right">
                <i class="mdi mdi-chevron-right">
                </i>
            </span>
        </span>
    </a>
    <ul class="list-unstyled">
        {{-- <li class="child-menu-divider">
                                <a href="{{route('affiliatedBody.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Affiliated Body
                                </a>
                            </li> --}}
        {{-- <li class="child-menu-divider">
                                <a href="{{route('announcements.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Announcement
                                </a>
                            </li> --}}

        {{-- <li class="child-menu-divider">
                                <a href="{{route('headFines.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Heads
                                </a>
                            </li>
                            <li class="child-menu-divider">
                                <a href="{{route('notice_board.index')}}">
                                    <i aria-hidden="true" class="mdi mdi-menu">
                                    </i>
                                    Notice Board
                                </a>
                            </li> --}}
        {{-- @can('view_references') --}}
        {{-- <li class="child-menu-divider">
                                <a href="{{route('references.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    References
                                </a>
                            </li> --}}
        {{-- @endcan --}}
        {{-- <li class="child-menu-divider">
                                <a href="{{route('rooms.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Rooms
                                </a>
                            </li> --}}
        {{-- @can('view_subjects')
                            <li>
                                <a href="{{route('subjects.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Subjects
                                </a>
                            </li>
                            @endcan --}}
        {{-- @can('view_sessions') --}}
        {{-- <li class="child-menu-divider">
                                <a href="{{route('sessions.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Sessions
                                </a>
                            </li> --}}
        {{-- @endcan --}}
        {{-- <li class="child-menu-divider">
                                <a href="{{route('sections.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Sections
                                </a>
                            </li> --}}
        {{-- @endcan --}}

        {{-- @can('view_semesters') --}}
        {{-- <li class="child-menu-divider">
                                <a href="{{route('semester.index')}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    Semester
                                </a>
                            </li> --}}
        {{-- @endcan --}}
        {{-- <li class="child-menu-divider">
                                <a href="{{route('dynamicMenu.index', ['menu' => $menu->id])}}">
                                    <i class="mdi mdi-menu">
                                    </i>
                                    System Menu
                                </a>
                            </li> --}}
        {{-- end --}}

    </ul>
</li>
{{-- @endcan --}}
