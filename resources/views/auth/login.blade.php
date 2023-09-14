@include('includes/header_account')
<!-- Begin page -->

<div class="row">
   <div class="col-md-8 col-sm-8 col-xl-8">
      <div class="accountbg">
         <h3 class="m-0 float-left" style="width: 50%;">
            <a href="index" class="logo logo-admin img-logo">
                <img src="assets/images/alph-logo.jpeg" alt="logo" style="height: 150px;width: 150px;">
            </a>
         </h3>

         <h3 class="m-0 float-right" style="width: 50%;text-align: right;">
            <a href="index" class="logo logo-admin img-logo">
                <img src="assets/images/logo_cent.png" alt="logo" style="height: 150px;width: 150px;">
            </a>
         </h3>

      </div>
      <!--  <div class="transparentOverlay"></div> --> 
   </div>

   <div class="col-md-4 col-sm-4 col-xl-4">
      <div class="wrapper-page">
         <div class="card login-card-bg">
            <div class="card-body">
               <div class="login-main">
                  <div class="p-3">
                     <h4 class=" font-18 m-b-5 text-center" style="color:#fff">Welcome!</h4>
                     <form method="POST" action="{{ route('login') }}" aria-label="{{ ('Login') }}">
                        @csrf
                        <div class="form-group">
                           <label for="username" class="text-white">Email</label>
                           <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                           @if ($errors->has('email'))
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('email') }}</strong>
                           </span>
                           @endif
                           <!-- <input type="text" class="form-control" id="username" placeholder="Enter username"> -->
                        </div>
                        <div class="form-group">
                           <label for="userpassword" class="text-white">Password</label>
                           <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                           @if ($errors->has('password'))
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('password') }}</strong>
                           </span>
                           @endif
                           <!-- <input type="password" class="form-control" id="userpassword" placeholder="Enter password"> -->
                        </div>
                        <div class="form-group row m-t-20">
                           <div class="col-sm-6">
                              <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input" id="customControlInline">
                                 <label class="custom-control-label text-white" for="customControlInline">Remember me</label>
                              </div>
                           </div>
                           <div class="col-12 m-t-20">
                              <button class="btn btn-md btn-block waves-effect" type="submit">Log In</button>
                           </div>
                        </div>
                        <div class="form-group m-t-10 mb-0 row">
                           <div class="col-12 text-center m-t-10">
                              <!-- <a href="pages-recoverpw" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a> -->
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- 
            <div class="m-t-40 text-center">
                <p>Don't have an account ? <a href="pages-register" class="font-500 font-14 text-primary font-secondary"> Signup Now </a> </p>
                <p>© 2018 Fonik. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
            </div> -->
      </div>
   </div>
</div>
@include('includes/footer_account')
