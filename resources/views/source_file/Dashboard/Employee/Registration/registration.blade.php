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
<?php
$account_type = request()->segments(1)[1];
if($account_type == 'contractor'){
    $title_ = 'Local Contractor';
    $action = false;
    $third = 'Browse Project';
}else{
    $title_ = 'Technician';
    $action = true;
    $third = 'Connect with Local Customers';
}

?>


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
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-check"></i></span>
              <h3>Account Verification</h3>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-list"></i></span>
              <h3>{{$third}}</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="browse-all-cat">
            <a id="how_it_work" title="">Get Started</a>
            <br/><br/>
            <video id="video_tutorial" width="320" height="240" controls>
                <source src="movie.mp4" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
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
                            <span id="residential-option">{{$title_}}</span>
                            
            
                            @if(session('store_error'))
                              <span style="color: #B22222;">
                                {{session('store_error')}}
                              </span>
                            @endif
                          </div>
                          <form role="form" method="post" action="{{url('/user/register')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <!--Technician Input-->
                            <div class="techinician">

                                    <!--technician full name-->
                                    @if($errors->has('fullname_technician'))
                                      <span style="color: #B22222; float: right">
                                        {{$errors->first('fullname_technician')}}
                                      </span>
                                    @endif
                                    <div class="cfield">
                                      <input id="technician-input1" name="fullname_technician" value="{{old('fullname_technician')}}" type="text" placeholder="Username"  required/>
                                      <i class="la la-user"></i>
                                    </div>
                                    
                                    
                                    <!--technician full name-->
                                    @if($errors->has('First_Name'))
                                      <span style="color: #B22222; float: right">
                                        {{$errors->first('First_Name')}}
                                      </span>
                                    @endif
                                    <div class="cfield">
                                      <input id="technician-input1" name="First_Name" value="{{old('First_Name')}}" type="text" placeholder="First Name" />
                                      <i class="la la-user"></i>
                                    </div>
                                    
                                                                        <!--technician full name-->
                                    @if($errors->has('Last_Name'))
                                      <span style="color: #B22222; float: right">
                                        {{$errors->first('Last_Name')}}
                                      </span>
                                    @endif
                                    <div class="cfield">
                                      <input id="technician-input1" name="Last_Name" value="{{old('Last_Name')}}" type="text" placeholder="Last Name"  />
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
                  
                  
                                    @if($action)
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
                                    
                                    @endif
                                    <div class="uploadbox">
                                      <label for="file-upload" class="custom-file-upload">
                                          <i class="la la-cloud-upload"></i> <span id="job_media_">Upload Type of Sevice and License</span>
                                      </label>
                                      <input name="license_technician" id="file-upload" type="file" style="display: none;" />
                                    </div>
                                    
                                    
                                    <!--technician  license-->
                                    <div class="uploadbox">
                                      <label for="file-uploads" class="custom-file-upload">
                                          <i class="la la-cloud-upload"></i> <span id="job_medias_">*Optional* Upload Type of Sevice and License</span>
                                      </label>
                                      <input name="document_technician" id="file-uploads" type="file" style="display: none;" />
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
                                          <input name="charges_technician" id="technician-input8" type="text" value="{{old('charges_technician')}}" placeholder="Charges" required/>
                  
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


@if($errors->isEmpty() && session('error_email') == false)
<script>
$(function(){
  $('section#signup_how_it_work').hide();

  $('a#how_it_work').click(function(){
    $('section#signup_how_it_work').show();
    $('#video_tutorial').hide();
  });

});
</script>
@else
<script>
    $(function(){
        $('#video_tutorial').hide();
    });
</script>
@endif
<script src="{{URL::asset('js/apps/update_file_names.js')}}" type="text/javascript"></script>
@endsection
