@include('includes/header_start')
    <link href="css/overlay-bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/overlay-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style>
        .container {
            position: relative;
            font-family: Arial;
        }

        .text-block {
            position: absolute;
            bottom: 0;
            right: 0;
            color: white;
            padding-left: 20px;
            background-color: rgba(0,0,0,0.7);
            width: 100%;
            padding-right: 20px;
        }
    </style>
@include('includes/header_end')

        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">{{ ucfirst($user->display_name) }}</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
PAGE CONTENT START
================== -->

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">

                <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="card m-b-30">
                            {{-- <img class="card-img-top img-fluid" src="assets/images/small/img-2.jpg" alt="Card image cap"> --}}
                            <div class="text-center bg_light_grey ">
                                    <img class="m-t-20 m-b-20 rounded-circle circular_image" src=".{{ $user->profile_pic_url!=''?config('constants.attachment_path.emp_qr_destination_path').$user->emp_code.'/profile_picture/'.$user->profile_pic_url: asset('assets/images/users/avatar-4.jpg')}}" alt="Nature" style="width:50%; object-fit: cover;"/></div>                                        
                            <div class="card-body text-center">
                                <h4 class="card-title font-20 mt-0 m-b-5">{{$user['display_name']}}</h4>
                                <p class="card-text font-12">(Designation)</p>
                            </div>
                            <ul class="list-group list-group-flush">
                              {{--   <li class="list-group-item">
                                        <span class="profile-card-icon text-center"><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal" ></i>
                                        </span>
                                        {{ $user['emp_code'] ? $user['emp_code'] : '---' }}
                                </li> --}}
                               {{--  <li class="list-group-item">
                                     <span class="profile-card-icon text-center"><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal" id="set"></i>
                                        </span>
                                        London, UK

                                </li> --}}
                                 <li class="list-group-item">
                                     <span class="profile-card-icon text-center">
                                        <i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal" id="set"></i>
                                        </span>
                                        {{$user['email']}}

                                </li>
                                <li class="list-group-item">
                                     <span class="profile-card-icon text-center">
                                       <i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal" id="set"></i>
                                        </span>
                                        {{$user['mobile_no']}}

                                </li>
                            </ul>
                            <div class="card-body">
                                <div id="select_image_div" hidden>
                                    <form name="Image_upload" enctype="multipart/form-data" action="{{route('profiles.update_avatar')}}" method="POST">
                                        <div class="form-group display-flex">
                                            <input type="file" class="filestyle" name="avatar" data-buttonname="btn-flat btn-secondary">
                                            <button type="submit" class="btn btn-flat btn-sm btn-success">Save</button>
                                        </div>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                                <button class="btn btn-sm btn-outline-info" id="upload_btn" type="button" onclick="profilechange('select_image_div')">Upload New Picture</button>
                            </div>
                        </div>

                    </div><!-- end col -->


            <div class="col-md-8 col-lg-8 col-xl-9">
                <div class="card m-b-30">
                    <div class="card-body">
                        @include('profiles.profile')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
    @include('alertify::alertify')
    <script type="text/javascript" src="{{ asset('js/profile/profile.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/user/change-password.js')  }}"></script>
    
@include('includes/footer_end')
