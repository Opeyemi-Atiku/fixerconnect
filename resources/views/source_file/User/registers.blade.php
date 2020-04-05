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


<section class="wow slideInLeft" data-wow-duration="500ms" data-wow-delay="500ms">
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading">
            <h2>How It Works</h2>
            </span>
          </div><!-- Heading -->
          <div class="how-to-sec style2 no-lines">
            <div class="how-to">
              <span class="how-icon"><i class="la la-user"></i></span>
              <h3>Register an account</h3>
              <p>Post a job to tell us about your project.</p>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-file-archive-o"></i></span>
              <h3>Specify & search your job</h3>
              <p>Browse and reviews profiles</p>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-list"></i></span>
              <h3>Apply for job</h3>
              <p>Apply for job and get hired.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="browse-all-cat">
            <a id="how_it_work" title="">Get Started</a>
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

              <div class="select-user" style="width: 440px !important;">
                <span id="technician-option" class="active">Technician</span>
                <span id="residential-option">Residential</span>
                <span id="commercial-option">Commercial</span>
                <script>
                var user;

                /*
                * each input index for residential
                */
                var residential_index = [1, 2, 3, 4, 5, 6];

                /*
                * each input index for commercial
                */
                var commercial_index = [1, 2, 3, 4, 5, 6];

                /*
                * each input index for technician
                */
                var technician_index = [1, 2, 3, 4, 5, 6, 7, 8, 9];

                $(function(){

                  /*
                  * page to render after registration
                  */

                  <?php

                  $render_selected;
                  if(old('user_option_type')){
                    $render_selected = old('user_option_type');
                  }else{
                    $render_selected = 'unselected';
                  }
                  ?>

                  user = '<?php echo $render_selected; ?>';

                  if(user == 'residential'){
                    /*
                    * display
                    */
                    $('div.techinician').hide();
                    $('div.residential').show();
                    $('div.commercial').hide();

                    /*
                    * active option
                    */
                    $('span#technician-option').attr('class', '');
                    $('span#residential-option').attr('class', 'active');
                    $('span#commercial-option').attr('class', '');

                    /*
                    * disable and enable event
                    */
                    $.each(residential_index, function(index, value){
                      $('input#residential-input'+value).removeAttr('disabled');
                    });
                    $.each(technician_index, function(index, value){
                      $('#technician-input'+value).prop('disabled', 'true');
                    });
                    $.each(commercial_index, function(index, value){
                      $('input#commercial-input'+value).prop('disabled', 'true');
                    });

                  }else if(user == 'technician'){
                    /*
                    * display
                    */
                    $('div.techinician').show();
                    $('div.residential').hide();
                    $('div.commercial').hide();

                    /*
                    * active option
                    */
                    $('span#technician-option').attr('class', 'active');
                    $('span#residential-option').attr('class', '');
                    $('span#commercial-option').attr('class', '');

                    /*
                    * disable and enable event
                    */
                    $.each(residential_index, function(index, value){
                      $('input#residential-input'+value).prop('disabled', 'true');
                    });
                    $.each(commercial_index, function(index, value){
                      $('input#commercial-input'+value).prop('disabled', 'true');
                    });
                    $.each(technician_index, function(index, value){
                      $('#technician-input'+value).removeAttr('disabled');
                    });
                  }else if(user == 'commercial'){
                    /*
                    * display
                    */
                    $('div.techinician').hide();
                    $('div.residential').hide();
                    $('div.commercial').show();

                    /*
                    * active option
                    */
                    $('span#technician-option').attr('class', '');
                    $('span#residential-option').attr('class', '');
                    $('span#commercial-option').attr('class', 'active');

                    /*
                    * disable and enable event
                    */
                    $.each(commercial_index, function(index, value){
                      $('input#commercial-input'+value).removeAttr('disabled');
                    });
                    $.each(technician_index, function(index, value){
                      $('#technician-input'+value).prop('disabled', 'true');
                    });
                    $.each(residential_index, function(index, value){
                      $('#residential-input'+value).prop('disabled', 'true');
                    });
                  }
                });
                </script>

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
                    <input id="residential-input1" name="name_residential" type="text" value="{{old('name_residential')}}" placeholder="Name" disabled="true" required/>
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
                    <input id="residential-input2" name="email_residential" type="email" value="{{$error_validation_email_residential}}" placeholder="Email" disabled="true" required/>
                    <i class="la la-envelope-o"></i>
                  </div>

                  <!--residential password-->
                  @if($errors->has('password_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_residential')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="residential-input3" name="password_residential" type="password" placeholder="Enter password" disabled="true" required/>
                    <i class="la la-key"></i>
                  </div>
                  @if($errors->has('password_confirmation_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_confirmation_residential')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="residential-input6" name="password_confirmation_residential" type="password" placeholder="Confirm password" disabled="true" required/>
                    <i class="la la-key"></i>
                  </div>

                  <!--residential address-->
                  @if($errors->has('address_residential'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('address_residential')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="residential-input4" name="address_residential" value="{{old('address_residential')}}" type="text" placeholder="Address" disabled="true" required/>
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

                <!--Residential input-->
                <div class="commercial">
                  <!--residential name-->
                  @if($errors->has('name_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('name_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input1" name="name_commercial" type="text" value="{{old('name_commercial')}}" placeholder="name" disabled="true" required/>
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
                    <input id="commercial-input2" name="email_commercial" type="email" value="{{$error_validation_email_commercial}}" placeholder="Email" disabled="true" required/>
                    <i class="la la-envelope-o"></i>
                  </div>

                  <!--commercial password-->
                  @if($errors->has('password_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input3" name="password_commercial" type="password" placeholder="Enter password" disabled="true" required/>
                    <i class="la la-key"></i>
                  </div>
                  @if($errors->has('password_confirmation_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_confirmation_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input6" name="password_confirmation_commercial" type="password" placeholder="Confirm password" disabled="true" required/>
                    <i class="la la-key"></i>
                  </div>

                  <!--commercial address-->
                  @if($errors->has('address_commercial'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('address_commercial')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="commercial-input4" name="address_commercial" value="{{old('address_commercial')}}" type="text" placeholder="Address" disabled="true" required/>
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


                <!--Technician Input-->
                <div class="techinician">

                  <!--technician full name-->
                  @if($errors->has('fullname_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('fullname_technician')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="technician-input1" name="fullname_technician" value="{{old('fullname_technician')}}" type="text" placeholder="Full Name"  required/>
                    <i class="la la-user"></i>
                  </div>

                  <!--technician email-->
                  @if($errors->has('email_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('email_technician')}}
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
                  if($errors->has('email_technician')){
                    $error_validation_email_technician = old('email_technician');
                  }else{
                    $error_validation_email_technician = '';
                  }
                  ?>
                  <div class="cfield">
                    <input id="technician-input2" name="email_technician" value="{{$error_validation_email_technician}}" type="email" placeholder="Email" required/>
                    <i class="la la-envelope-o"></i>
                  </div>

                  <!--technician  password-->
                  @if($errors->has('password_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_technician')}}
                    </span>
                  @endif

                  <div class="cfield">
                    <input id="technician-input3" type="password" name="password_technician" placeholder="Enter Password" required/>
                    <i class="la la-key"></i>
                  </div>
                  @if($errors->has('password_confirmation_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('password_confirmation_technician')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="technician-input9" type="password" name="password_confirmation_technician" placeholder="Confirm Password" required/>
                    <i class="la la-key"></i>
                  </div>

                  <!--technician  address --->
                  @if($errors->has('address_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('address_technician')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="technician-input4" type="text" name="address_technician" value="{{old('address_technician')}}" placeholder="Address" required/>
                    <i class="la la-map-marker"></i>
                  </div>



                  <?php
                  /*
                  * selection value
                  */

                  $trade = "selected";

                  if(old('trade_technician')){
                    $trade = 'unselected';
                  }

                  ?>
                  @if($errors->has('trade_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('trade_technician')}}
                    </span>
                  @endif
                  <div class="dropdown-field">
            				<select id="technician-input9" name="trade_technician" data-placeholder="Please Select Trade Type" class="chosen">
                      <option {{$trade}} disabled>Type Of Business</option>
                      @foreach($tradeList as $trade)
                      <?php $act = "unselected"; if($trade->id == old('trade_technician')){$act = "selected";}?>
            					<option {{$act}}  value={{$trade->id}}>{{$trade->trade_name}}</option>
                      @endforeach
            				</select>
            			</div>

                  <!--technician  license-->
                  @if($errors->has('license_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('license_technician')}}
                    </span>
                  @endif
                  <div class="uploadbox">
                    <label for="file-upload" class="custom-file-upload">
                        <i class="la la-cloud-upload"></i> <span id="job_media_">Upload Type of Sevice and License</span>
                    </label>
                    <input name="license_technician" id="file-upload" type="file" style="display: none;" />
                  </div>

                  <!--technician  experience-->
                  @if($errors->has('experience_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('experience_technician')}}
                    </span>
                  @endif
                  <div class="pf-field" style="margin-top: 20px;">
                    <textarea name="experience_technician" id="technician-input6" placeholder="Describe your working experience">{{old('experience_technician')}}</textarea>
                  </div>

                  <!--technician  charges-->
                  @if($errors->has('charges_technician'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('charges_technician')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <div class="row">
                      <div class="col-lg-4">
                        <select name="currency_technician" id="technician-input7" data-placeholder="Please Select Specialism" class="chosen">
                					<option>$</option>
                				</select>
                      </div>
                      <div class="col-lg-7">
                        <input name="charges_technician" id="technician-input8" type="text" value="{{old('charges_technician')}}" placeholder="Charges" disabled="true" required/>

                      </div>
                      <div class="col-lg-1">
                      </div>
                    </div>
                  </div>

                </div>
                <!--Technician Input-->

                <?php
                /*
                * selected hidden user option
                */
                if(old('user_option_type')){
                  $user_type_selected = old('user_option_type');
                }else{
                  $user_type_selected = 'technician';
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

@if($errors->isEmpty())
<script>
$(function(){
  $('section#signup_how_it_work').hide();
  $('a#how_it_work').click(function(){
    $('section#signup_how_it_work').show();
  });
});
@endif
</script>
<script src="{{URL::asset('js/apps/registration4.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/apps/update_file_name.js')}}" type="text/javascript"></script>
@endsection
