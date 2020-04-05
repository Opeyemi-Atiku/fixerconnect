@extends('layouts.layouts')

@section('title', 'Commercial Request Service')
@section('content')
<section>
  <div class="block no-padding  gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner2">
            <div class="inner-title2">
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
              <h3>Commercial Service Request</h3>

              <div class="select-user">
                

                @if(session('status'))
                  <span style="">
                    {{session('status')}}
                  </span>
                @endif
              </div>
              <form role="form" method="post" action="{{url('/commercial/request')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!--Residential input-->
                <div class="residential">
                  <!--residential name-->
                  @if($errors->has('name'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('name')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="" name="name" type="text" value="{{old('name')}}" placeholder="Name"  required/>
                    <i class="la la-user"></i>
                  </div>

                  <!--residential email-->
                  @if($errors->has('email'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('email')}}
                    </span>
                  @endif
                  @if(session('error_email'))
                    <span style="color: #B22222; float: right">
                      {{session('error_email')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="" name="email" type="email" value="{{old('email')}}" placeholder="Email"  required/>
                    <i class="la la-envelope-o"></i>
                  </div>

                  <!--residential phone-->
                  @if($errors->has('phone'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('phone')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="" name="phone"  value="{{old('phone')}}" type="text" placeholder="Phone Number" required/>
                    <i class="la la-phone"></i>
                  </div>

                </div>
                <!--Residential Input-->
                <button type="submit">Submit</button>
              </form>
            </div>
          </div><!-- SIGNUP POPUP -->
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
