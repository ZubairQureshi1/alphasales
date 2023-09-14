            <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">
                        <nav class="navbar-custom">
                            <!-- Search input
                            <div class="search-wrap" id="search-wrap">
                                <div class="search-bar">
                                    <input class="search-input" type="search" placeholder="Search" />
                                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                                        <i class="mdi mdi-close-circle"></i>
                                    </a>
                                </div>
                            </div>
                            -->
                            <ul class="list-inline float-right mb-0">
                                <!-- Search -->
                                <!-- <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                                        <i class="mdi mdi-magnify noti-icon"></i>
                                    </a>
                                </li> -->
                                
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                        data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                        aria-expanded="false">
                                        <img src="{{ asset('assets/images/users/dummy.png') }}" alt="user"
                                            class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="http://localhost/cms_alpha_client/profiles"><i class="dripicons-user text-muted"></i>
                                            Profile</a>
                                      <!-- <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i>
                                            Lock screen</a> -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"><i
                                                class="dripicons-exit text-muted"></i>
                                            {{ 'Logout' }}</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                            </ul>

                            <ul class="list-inline float-right dropdown notification-list mb-0" style="margin-top: 1%;">
                                <!--<li class="list-inline-item">
                                    {!! Form::select(
    'organization_campus_id',
    \Auth::user()->campusDetails()->get()->pluck('organization_campus_name', 'organization_campus_id'),
    Illuminate\Support\Facades\Session::get('organization_campus_id'),
    ['id' => 'global_organization_campus_id', 'class' => 'form-control select2 data-filters', 'placeholder' => '--- Select Office Location ---'],
) !!}
                                </li>

                                {{-- <li class="list-inline-item" style="min-width: 150px">
                                    {!! Form::select(
    'session_id',
    \Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'),
    Illuminate\Support\Facades\Session::get('selected_session_id'),
    ['id' => 'global_session_id', 'class' => 'form-control select2 data-filters', 'placeholder' => '--- Select Session ---'],
) !!}
                                </li> --}}

                                <li class="list-inline-item">
                                    <button onclick="updateCampusAndSession()"
                                        class="btn btn-dark btn-sm">Change</button>
                                </li>
                                -->

                            </ul>
                            <!-- <script type='text/javascript'>
                                function updateCampusAndSession() {
                                    var organization_campus_id = document.getElementById('global_organization_campus_id').value;
                                    var session_id = document.getElementById('global_session_id').value;
                                    $.ajax({
                                        url: "/home/updateSystemSession",
                                        // dataType: "json",
                                        type: "POST",
                                        data: {
                                            _token: $("input[name='_token']").val(),
                                            organization_campus_id: organization_campus_id,
                                            session_id: session_id,
                                        },
                                        success: function(data) {
                                            alertify.success(data.message);
                                            window.location.reload();
                                        },
                                        error: function(data) {
                                            if (data.status == 0) {
                                                alertify.error("Internet connection failed.");
                                            } else {
                                                swal('Something went wrong!', JSON.parse(data.responseText).error, 'error');
                                            }
                                        }
                                    });
                                }
                            </script>
                            -->
