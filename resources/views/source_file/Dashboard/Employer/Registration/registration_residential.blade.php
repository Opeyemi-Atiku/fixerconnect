@extends('layouts.layouts')

@section('title', 'Register')
@section('content')
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
              <span class="how-icon"><i class="la la-sticky-note-o"></i></span>
              <h3>Describe your Project</h3>
              <p>Tell us what needs to be done, where and when</p>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-search"></i></span>
              <h3>Choose Technician</h3>
              <p>Browse and choose the Technician</p>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-tasks"></i></span>
              <h3>Get it done</h3>
              <p>Job is done, pay and rate us</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="browse-all-cat">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="browse-all-cat">
              <div class="dropdown-field">
                <select id="trade_list" name="trade_list" data-placeholder="Please Select Trade Type" class="chosen">
                        <option selected disabled>Select Trade</option>
                        @foreach($tradeList as $trade)
                          <option  value={{$trade->id}}>{{$trade->trade_name}}</option>
                        @endforeach
                </select>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="browse-all-cat">
              
          </div>
        </div>
        
        
        
        <div class="col-lg-12">
          <div class="browse-all-cat">
            <a id="how_it_work" href"#signup_how_it_work" title="">Get Started</a>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>



<?/*php<section id="signup_how_it_work">
        <div class="emply-resume-sec">
            <?php $i=1; ?>
            @foreach ($technician as $technician_)
     <?php
              $profile_image_source = "/storage/storage/$technician_->profile_image";
              //$link = "/job/technician/$job->id";
              ?>
            <div class="emply-resume-list round">
                    <div class="emply-resume-thumb">
                        <img src="{{$profile_image_source}}" style="width: 100%; height: 100px;" alt="" />
                    </div>
                    <div class="emply-resume-info">
                        <h3><a href="#" title="">{{$technician_->firstName}}  {{$technician_->lastName}} </a></h3>
                        <span>{{$technician_->trade_type}}</span>
                        <p><i class="la la-map-marker"></i>{{$technician_->city}}<style>
                   .star-rating{{$i}} {
                        line-height:32px;
                        font-size:1.25em;
                    }
                    .star-rating{{$i}} .la-star{color: yellow;}
                   </style>
                   <div class="">
                                        <div class="">
                                          <div class="star-rating{{$i}}">
                                            <i class="la la-star-o" data-rating="1"></i>
                                            <i class="la la-star-o" data-rating="2"></i>
                                            <i class="la la-star-o" data-rating="3"></i>
                                            <i class="la la-star-o" data-rating="4"></i>
                                            <i class="la la-star-o" data-rating="5"></i>
                                            <input type="hidden" name="whatever1" class="rating-value{{$i}}" value="{{$technician_->rating}}">
                                    </div>
                                   </div>
                                 </div></p>
                                 
                                 <script>
                                    var i = "<?php echo $i; ?>";
                                       var $star_rating = $('.star-rating'+i+' .la');
                                       var SetRatingStar = function() {
                                           return $star_rating.each(function() {    if (parseInt($star_rating.siblings('input.rating-value'+i).val()) >= parseInt($(this).data('rating'))) {      return $(this).removeClass('la-star-o').addClass('la-star');
                                           } else {
                                               return $(this).removeClass('la-star').addClass('la-star-o');
                                               }
                                               });
                                           
                                       };
                                       $star_rating.on('click', function() {  $star_rating.siblings('input.rating-value').val($(this).data('rating')); return SetRatingStar();
                                           
                                       });
                                       SetRatingStar();
                                   </script>
                    </div>
                    <div class="shortlists">
                        <a href="/residential_view_technician/{{$technician_->id}}" title="">Hire <i class="la la-plus"></i></a>
                    </div>
                </div><!-- Emply List -->        
                <?php $i++; ?>
            @endforeach                       

                <div class="pagination">
                   <ul>
                       @if($technician->currentPage() > 1)
                       <li class="prev"><a href="{{$technician->previousPageUrl()}}"><i class="la la-long-arrow-left"></i> Prev</a></li>
                       @endif
                       @if($technician->currentPage() != $technician->lastPage() && $technician->lastPage() != 0)
                       <li class="next"><a href="{{$technician->nextPageUrl()}}">Next <i class="la la-long-arrow-right"></i></a></li>
                       @endif
                   </ul>
               </div><!-- Pagination -->

            </div>     
</section>*/?>

<section id="signup_how_it_work">
  <div class="block remove-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="account-popup-area signup-popup-box static">
            <div class="account-popup">
              <form id="technician_form" role="form" method="get" action="/register/technician_list">
                {{ csrf_field() }}

                <!--Residential input-->
                <div class="ui-widget">
                    
                    <input type="hidden" name="latitude" id="latitude" />
                    <input type="hidden" name="longitude" id="longitude" />
                    <input type="hidden" name="trade_" id="trade_" value="1" />
                    <span id="location" style="color: #B22222; float: right">
                    </span>
                  <div class="cfield">
                    <input id="zip_code" name="zip_code" value="{{old('zip_code')}}" type="text" placeholder="Enter Zip Code"  required/>
                    <i class="la la-map-marker"></i>
                  </div>
                  
                  
                <div class="pf-field" style="margin-top: 20px;">
                  <textarea name="experience_technician" id="technician-input6" placeholder="Describe task">{{old('experience_technician')}}</textarea>
                </div>

                </div>
                <button id="near_" type="button">Next</button>
              </form>
            </div>
          </div><!-- SIGNUP POPUP -->
        </div>
      </div>
    </div>
  </div>
</section>



<script>


$(function(){
    
    function getLatLngByZipcode(zipcode) 
{
    var geocoder = new google.maps.Geocoder();
    var address = zipcode;
    geocoder.geocode({ 'address': 'zipcode '+address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            
            $('input#latitude').val(latitude);
            $('input#longitude').val(longitude);
            
            $('#technician_form').submit();
            
        } else {
            $('span#location').text('Invalid Zip Code');
            console.log('error');
        }
    });
}


    var data_arr = [''];
    
    
  
  $('#zip_code').keypress(function(){
     zip = $(this).val();
     $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+zip+'&key=AIzaSyAkwr5rmzY9btU08sQlU9N0qfmo8YmE91Y').success(function(response){
         
        
        var locationList = response.results;
        
        data_arr = locationList.map(function(val){
                 return val.formatted_address;
        });
        
        
        $( "#zip_code" ).autocomplete({
           source: data_arr,
           minLength :0
        });
        $( "#zip_code" ).autocomplete("search", "");
        
  });
  
  });
  
  $('input#zip_code').bind('keypress keydown keyup', function(e){
       if(e.keyCode == 13) { e.preventDefault(); }
    });
  
  
    
    
  $('section#signup_how_it_work').hide();

  $('a#how_it_work').click(function(){
    $('section#signup_how_it_work').show();
    $('html,body').animate({
    scrollTop: $('section#signup_how_it_work').offset().top
}, 1000);
  });
  
  $('#trade_list').change(function(){
      $('input#trade_').val($(this).val());
  });
  
  $('button#near_').click(function(){
      let zip = $('#zip_code').val();
      getLatLngByZipcode(zip);
  });
});
</script>
@endsection
