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
@include('source_file.Dashboard.Employee.inc.title_bar')
<!--Title-->
<style>
.daterangepicker .calendar-time {
    margin: 12px 12px !important;
}
</style>

<section>
  <div class="block no-padding">
    <div class="container">
       <div class="row no-gape">
         <!--Menu-->
        @include('source_file.Dashboard.Employee.inc.menu_tab')
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
                <span class="round"><img src='{{URL::asset("$profile_image_source")}}' style="width: 100%; height: 160px;" id="set_profile_image" /></span>
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
                  <span class="pf-title" id="firstName_">First Name</span>
                  <div class="pf-field">
                    <input type="text" id="firstName" placeholder="Enter your First Name" value="{{$auth_user->firstName}}"/>
                  </div>
                </div>
                
                
                <div class="col-lg-6">
                  <span class="pf-title" id="lastName_">Last Name</span>
                  <div class="pf-field">
                    <input type="text" id="lastName" placeholder="Enter your Last Name" value="{{$auth_user->lastName}}"/>
                  </div>
                </div>
                
                <!--trade type-->
                @if($account == 'technician')
                <div class="col-lg-6">
                  <span class="pf-title">Trade Type</span>
                  <div class="dropdown-field">
            				<select id="trade_type" data-placeholder="Please Select Trade Type" class="chosen">
                      <option disabled>Trade</option>
                      @foreach($tradeList as $trade)
                      <?php $act = ""; if($trade->id == $auth_user->trade_id){$act = "selected";}?>
            					<option {{$act}} value={{$trade->id}}>{{$trade->trade_name}}</option>
                      @endforeach
            				</select>
            			</div>
                </div>
                @endif
                <!--experience-->
                <div class="col-lg-12">
                  <span class="pf-title" id="experience_">Description</span>
                  <div class="pf-field">
                    <textarea id="experience">{{$auth_user->experience}}</textarea>
                  </div>
                </div>
                <!--submit-->
                <div class="col-lg-12">
                  <button id="update" type="submit">Update</button>
                </div>
              </div>
            </div>
            
            <div class="profile-form-edit">
              <div class="row">
                <!--name-->
                <div class="col-lg-4">
                  <span class="pf-title" id="monday">Monday Schedule</span>
                  <div class="pf-field">
                    <input type="text" name="monday" id="datetimes" placeholder="Monday Schedule" value=""/>
                  </div>
                </div>
                
                
                <div class="col-lg-4">
                  <span class="pf-title" id="tuesday">Tuesday Schedule</span>
                  <div class="pf-field">
                    <input type="text" name="tuesday" id="datetimes" placeholder="Tuesday Schedule" value=""/>
                  </div>
                </div>
                
                
                <!--name-->
                <div class="col-lg-4">
                  <span class="pf-title" id="wednesday">Wednesday Schedule</span>
                  <div class="pf-field">
                    <input type="text" name="wednesday" id="datetimes" placeholder="Monday Schedule" value=""/>
                  </div>
                </div>
                
                
                <div class="col-lg-4">
                  <span class="pf-title" id="thursday">Thursday Schedule</span>
                  <div class="pf-field">
                    <input type="text" name="thursday" id="datetimes" placeholder="Tuesday Schedule" value=""/>
                  </div>
                </div>
                
                
                <!--name-->
                <div class="col-lg-4">
                  <span class="pf-title" id="friday">Friday Schedule</span>
                  <div class="pf-field">
                    <input type="text" name="friday" id="datetimes" placeholder="Monday Schedule" value=""/>
                  </div>
                </div>
                <!--submit-->
                <div class="col-lg-12">
                  <button id="schedule" type="submit">Update</button>
                </div>
              </div>
            </div>
            
            <div class="contact-edit">
              <h3>Contact</h3>
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
                    <span class="pf-title" id="city">City</span>
                    <div class="pf-field">
                      <input id="streetNumber" type="text" placeholder="Enter street number" value="{{$auth_user->city}}" />
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <a id="search" id="search" class="srch-lctn">Search Location</a>
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
$(function() {
   $('input[id="datetimes"]').daterangepicker({
            timePicker : true,
            timePickerIncrement : 1,
            timePickerSeconds : true,
            locale : {
                format : 'hh:mm A'
            }
        }).on('div.daterangepicker', function(ev, picker) {
            //picker.container.find(".calendar-table").hide();
        }).on('showCalendar.daterangepicker', function(ev, picker){
           picker.container.find('.calendar-table').remove();
        });
})
</script>


<script>
var latitude, longitude;
var showMap = 1;
var loading = "<?php echo $loading;?>";



$(function(){
    var monday = $('input[name="monday"]').val();
var tuesday = $('input[name="tuesday"]').val();
var wednesday = $('input[name="wednesday"]').val();
var thursday = $('input[name="thursday"]').val();
var friday = $('input[name="friday"]').val();
    
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
  
  
  $('input').on('change',function(){
      $(this).attr('name') == 'monday' ? monday = $(this).val() : '';
      $(this).attr('name') == 'tuesday'? tuesday = $(this).val() : '';
      $(this).attr('name') == 'wednesday'? wednesday = $(this).val() : '';
      $(this).attr('name') == 'thursday'? thursday = $(this).val() : '';
      $(this).attr('name') == 'friday'? friday = $(this).val() : '';
  });
  
  $('#schedule').click(function(){
      $.ajax({
                type: 'get',
                url: '/update_schedule',
                credentials: 'same-origin',
                data: {
                  monday: monday,
                  tuesday: tuesday,
                  wednesday: wednesday,
                  thursday: thursday,
                  friday: friday,
                },
                timeout: 100000,
                success: function(data){
                  if(data == 'save'){
                    $('#schedule').text('Saved');
                    setTimeout(function(){
                      $('#schedule').text('Update');
                    }, 1500);
                  }else{
                    $('#schedule').text('No new schedule');
                    setTimeout(function(){
                      $('#schedule').text('Update');
                    }, 1500);
                  }

                },
                error: function(){
                  alert('Unkown error occured');
                },
              });
  });
  
  
});
</script>
<script src="{{URL::asset('js/apps/edit_profile_employee8.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/apps/map.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
