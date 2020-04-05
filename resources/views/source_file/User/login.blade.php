@extends('layouts.layouts')

@section('title', 'Login')
@section('content')
<section>
  <div class="block no-padding  gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner2">
            <div class="inner-title2">
              <h3>Login</h3>
            </div>
            <div class="page-breacrumbs">
              <ul class="breadcrumbs">
                <li><a href="#" title="">Home</a></li>
                <li><a href="#" title="">Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="block remove-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="account-popup-area signin-popup-box static">
            <div class="account-popup">
              <h3>Log in</h3>
              <form role="form" method="post" action="{{url('/user/login')}}">
                {{ csrf_field() }}
                @if($errors->has('email'))
                  <span style="color: #B22222; float: right">
                    {{$errors->first('email')}}
                  </span>
                @endif
                <div class="cfield">
                  <input id="email" name="email" type="email" value="{{old('email')}}" placeholder="Email" required/>
                  <i class="la la-envelope-o"></i>
                </div>
                @if($errors->has('password'))
                  <span style="color: #B22222; float: right">
                    {{$errors->first('password')}}
                  </span>
                @endif
                <div class="cfield">
                  <input id="password" name="password" type="password" placeholder="********" required/>
                  <i class="la la-key"></i>
                </div>
                <a href="#" title="">Forgot Password?</a>
                <button type="submit">Login</button>
              </form>
              <span>
                <a href="/user/register" title="">Don't have an account? Register</a>
              </span>
              <div class="extra-login">
                <span>Or</span>
                <div class="login-social">
                  <a class="fb-login" href="{{URL::asset('social/facebook')}}" title=""><i class="fa fa-facebook"></i></a>
                  <a class="gl-login" href="{{URL::asset('social/google')}}" title=""><i class="fa fa-google-plus"></i></a>
                </div>
              </div>
            </div>
          </div><!-- LOGIN POPUP -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
