@extends('layouts.layouts')
<!--profile image-->
<style type="text/css">
label::before, label::after{
  width:0px !important;
  height:0px !important;
  border: 0px !important;
}
label{
  padding: 0 !important;
  height: 0px;
}
</style>
<!--profile image-->
@section('title', 'Edit Profile')
@section('content')

<!--Title-->
@include('source_file.Dashboard.Employer.inc.title_bar')
<!--Title-->

<section>
  <div class="block no-padding">
    <div class="container">
       <div class="row no-gape">
         <!--Menu-->
        @include('source_file.Dashboard.Employer.inc.menu_tab')
        <!--Menu-->

        <!--App-->
        <div class="col-lg-9 column">
          <div class="padding-left">
            <div class="profile-title">
              <h3>My Profile</h3>
              <div class="upload-img-bar">
                <?php
                if($auth_user->profile_image == null){
                  $profile_image_source = "/storage/storage/profile_image.png";
                }else{
                  $profile_image_source = "/storage/storage/$auth_user->profile_image";
                }
                $loading = "/images/loaders.gif";
                ?>
                <span class="round"><img src='{{URL::asset("$profile_image_source")}}' style="width: 100%; height: 140px;" id="set_profile_image" /></span>
                <div class="upload-info">
                  <a><label for="profile_image">Browse</label></a>
                  <input type="file" name="profile_image" id="profile_image" style="display: none;"/>
                </div>
              </div>
            </div>

            <div class="profile-form-edit">
              <div class="row">
                <!--name-->
                <div class="col-lg-6">
                  <span class="pf-title" id="fullname_">Full Name</span>
                  <div class="pf-field">
                    <input type="text" id="fullname" placeholder="Enter your fullname" value="{{$auth_user->name}}"/>
                  </div>
                </div>
                <div class="col-lg-6">
                  <span class="pf-title" id="phone_">Phone Number</span>
                  <div class="pf-field">
                    <input type="text" id="phone" placeholder="Enter your phone number" value="{{$auth_user->contact_number}}"/>
                  </div>
                </div>
                <!--experience-->
                <div class="col-lg-12">
                  <span class="pf-title" id="description_">About</span>
                  <div class="pf-field">
                    <textarea id="description">{{$auth_user->description}}</textarea>
                  </div>
                </div>
                <!--submit-->
                <div class="col-lg-12">
                  <button id="update" type="submit">Update</button>
                </div>
              </div>
            </div>
            <div class="contact-edit">
              <h3>Location</h3>
              <form>
                <div class="row">
                  <!--location-->
                  <div class="col-lg-6">
                    <span class="pf-title">Address</span>
                    <div class="pf-field">
                      <input id="address" type="text" value="{{$auth_user->location}}" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <span class="pf-title">Street Number</span>
                    <div class="pf-field">
                      <input id="streetNumber" type="text" placeholder="Enter street number" value="" />
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <a id="search" class="srch-lctn">Search Location</a>
                  </div>
                  <div class="col-lg-12">
                    <span class="pf-title">Maps</span>
                    <div class="pf-map" id="map">
                      <div id="googleMap" style="width: 100%; height: 250px;"></div>
                    </div>
                    <div class="container" id="loading">
                      <div class="row" id="loadings1">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                          <img src="{{URL::asset('images/loaders.gif')}}" alt="" />
                        </div>
                        <div class="col-md-4"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!--App-->

       </div>
    </div>
  </div>
</section>

<script>

var latitude, longitude;
var showMap = 1;
var loading = "<?php echo $loading;?>";

$(function(){
  /*
  * if location is set
  */
  var user_location_check = <?php if(isset($user_location_view)){echo 1;}else{echo 2;}?>;
  if(user_location_check == 1){
    latitude = <?php if(isset($user_location_view)){echo $user_location_view->latitude;}else{echo 1;}?>;
    longitude = <?php  if(isset($user_location_view)){echo $user_location_view->longitude;}else{echo 1;}?>;
    showMap = 2;
  }
  /*
  * if location is set set latitude and longitude
  */
});
</script>
<script src="{{URL::asset('js/apps/edit_profile_employer.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/apps/map.js')}}" type="text/javascript"></script>
@endsection
