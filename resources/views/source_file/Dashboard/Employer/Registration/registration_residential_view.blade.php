@extends('layouts.layouts')

@section('title', 'Register')
@section('content')
<section>
  <div class="block no-padding  gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner2">
            <div class="inner-title2">
              <h3>Register</h3>
            </div>
            <div class="page-breacrumbs">
              <ul class="breadcrumbs">
                <li><a href="#" title="">Home</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="wow bounceInDown" id="signup_how_it_work">
  <div class="block remove-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="account-popup-area signup-popup-box static">
            <div class="account-popup">
              <h3>Sign Up</h3>

              <div class="select-user">
                <span id="residential-option">Residential</span>
                

                @if(session('store_error'))
                  <span style="color: #B22222;">
                    {{session('store_error')}}
                  </span>
                @endif
              </div>
              <form role="form" method="post" action="{{url('/user/register')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!--Residential input-->
                <div class="residential">
                  <!--residential name-->
                  @if($errors->has('name_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('name_residential')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="residential-input1" name="name_residential" type="text" value="{{old('name_residential')}}" placeholder="Name"  required/>
                    <i class="la la-user"></i>
                  </div>

                  <!--residential email-->
                  @if($errors->has('email_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('email_residential')}}
                    </span>
                  @endif
                  @if(session('error_email'))
                    <span style="color: #B22222; float: right">
                      {{session('error_email')}}
                    </span>
                  @endif
                  <?php
                  /*
                  * if email has error
                  */
                  if($errors->has('email_residential')){
                    $error_validation_email_residential = old('email_residential');
                  }else{
                    $error_validation_email_residential = '';
                  }
                  ?>
                  <div class="cfield">
                    <input id="residential-input2" name="email_residential" type="email" value="{{$error_validation_email_residential}}" placeholder="Email"  required/>
                    <i class="la la-envelope-o"></i>
                  </div>

                  <!--residential password-->
                  @if($errors->has('password_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_residential')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="residential-input3" name="password_residential" type="password" placeholder="Enter password"  required/>
                    <i class="la la-key"></i>
                  </div>
                  @if($errors->has('password_confirmation_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_confirmation_residential')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="residential-input6" name="password_confirmation_residential" type="password" placeholder="Confirm password"  required/>
                    <i class="la la-key"></i>
                  </div>

                  <!--residential address-->
                  @if($errors->has('address_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('address_residential')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="residential-input4" name="address_residential" value="{{old('address_residential')}}" type="text" placeholder="Address"  required/>
                    <i class="la la-map-marker"></i>
                  </div>

                  <!--residential phone-->
                  @if($errors->has('phone_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('phone_residential')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="residential-input5" name="phone_residential"  value="{{old('phone_residential')}}" type="text" placeholder="Phone Number" required/>
                    <i class="la la-phone"></i>
                  </div>

                </div>
                <!--Residential Input-->

                <?php
                /*
                * selected hidden user option
                */
                if(old('user_option_type')){
                  $user_type_selected = old('user_option_type');
                }else{
                  $user_type_selected = 'residential';
                }
                ?>
                <!--Technician Input-->
                <input type="hidden" id="user_option_type" name="user_option_type" value="{{$user_type_selected}}">
                <button type="submit">Signup</button>
              </form>
              <span>
                <a href="/user/login" title="">Already have an account? Sign in</a>
              </span>

              <div class="extra-login">
                <span>Or</span>
                <div class="login-social">
                  <a class="fb-login" href="{{URL::asset('social/facebook')}}" title=""><i class="fa fa-facebook"></i></a>
                  <a class="gl-login" href="{{URL::asset('social/google')}}" title=""><i class="fa fa-google-plus"></i></a>
                </div>
              </div>
            </div>
          </div><!-- SIGNUP POPUP -->
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
