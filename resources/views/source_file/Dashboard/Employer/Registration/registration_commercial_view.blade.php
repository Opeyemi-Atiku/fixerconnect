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
                <li><a href="#" title="">Register</a></li>
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
                <span id="residential-option">Commercial</span>
                

                @if(session('store_error'))
                  <span style="color: #B22222;">
                    {{session('store_error')}}
                  </span>
                @endif
              </div>
              <form role="form" method="post" action="{{url('/user/register')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!--Commercial input-->
                <div class="commercial">
                    <!--residential name-->
                    @if($errors->has('name_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('name_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input1" name="name_commercial" type="text" value="{{old('name_commercial')}}" placeholder="name" required/>
                    <i class="la la-user"></i>
                  </div>

                  <!--commercial email-->
                  @if($errors->has('email_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('email_commercial')}}
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
                  if($errors->has('email_commercial')){
                    $error_validation_email_commercial = old('email_commercial');
                  }else{
                    $error_validation_email_commercial = '';
                  }
                  ?>
                  <div class="cfield">
                    <input id="commercial-input2" name="email_commercial" type="email" value="{{$error_validation_email_commercial}}" placeholder="Email" required/>
                    <i class="la la-envelope-o"></i>
                  </div>

                  <!--commercial password-->
                  @if($errors->has('password_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input3" name="password_commercial" type="password" placeholder="Enter password" required/>
                    <i class="la la-key"></i>
                  </div>
                  @if($errors->has('password_confirmation_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_confirmation_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input6" name="password_confirmation_commercial" type="password" placeholder="Confirm password" required/>
                    <i class="la la-key"></i>
                  </div>

                  <!--commercial address-->
                  @if($errors->has('address_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('address_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input4" name="address_commercial" value="{{old('address_commercial')}}" type="text" placeholder="Address" required/>
                    <i class="la la-map-marker"></i>
                  </div>

                  <!--commercial phone-->
                  @if($errors->has('phone_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('phone_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input5" name="phone_commercial"  value="{{old('phone_commercial')}}" type="text" placeholder="Phone Number" required/>
                    <i class="la la-phone"></i>
                  </div>

                </div>
                        
                <!--commercial Input-->

                <?php
                /*
                * selected hidden user option
                */
                if(old('user_option_type')){
                  $user_type_selected = old('user_option_type');
                }else{
                  $user_type_selected = 'commercial';
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
