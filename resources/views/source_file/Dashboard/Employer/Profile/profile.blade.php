@extends('layouts.layouts')

@section('title', Auth::user()->name)
@section('content')

<!--Title-->
@include('source_file.Dashboard.Employer.inc.title_bar')
<!--Title-->

<!--App-->
<section>
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 column">
          <div class="job-single-sec style3">
            <div class="job-head-wide">
              <div class="row">
                <div class="col-lg-10">
                  <div class="job-single-head3 emplye">
                    <?php
                    if($auth_user->profile_image == null){
                      $profile_image_source = "/storage/storage/profile_image.png";
                    }else{
                      $profile_image_source = "/storage/storage/$auth_user->profile_image";
                    }
                    ?>
                    <div class="job-thumb"> <img src='{{URL::asset("$profile_image_source")}}' style="width: 100px; height: 100px;"  alt="" /></div>
                    <div class="job-single-info3">
                      <h3>{{$auth_user->name}}</h3>
                      <span><i class="la la-map-marker"></i>{{$auth_user->location}}</span>
                      <ul class="tags-jobs">
                        <li><i class="la la-phone"></i> {{$auth_user->contact_number}}</li>
                        <li><i class="la la-mail-forward"></i> {{$auth_user->email}}</li>
                        <!--<li><i class="la la-calendar-o"></i> Lorem Ipsum</li>
                        <li><i class="la la-eye"></i> Lorem Ipsum</li>-->
                      </ul>
                    </div>
                  </div><!-- Job Head -->
                </div>
                <div class="col-lg-2">
                  <!--<div class="share-bar">
                    <a href="#" title="" class="share-google"><i class="la la-google"></i></a><a href="#" title="" class="share-fb"><i class="fa fa-facebook"></i></a><a href="#" title="" class="share-twitter"><i class="fa fa-twitter"></i></a>
                  </div>
                  <div class="emply-btns">
                    <a class="seemap" href="#" title=""><i class="la la-map-marker"></i> Lorem Ipsum</a>
                    <a class="followus" href="#" title=""><i class="la la-paper-plane"></i> lorem Ipsum</a>
                  </div>-->
                </div>
              </div>
            </div>
            <div class="job-wide-devider">
              <div class="row">
                <div class="col-lg-8 column">
                  <div class="job-details">
                    <h3>About</h3>
                    <p>{{$auth_user->description}}</p>
                  </div>
                  <div class="recent-jobs">
                    <h3>Jobs</h3>
                    @if(count($job) > 0)
                    @foreach($job as $jb)
                    <div class="job-list-modern">
                      <div class="job-listings-sec no-border">
                        <div class="job-listing wtabs noimg">
                          <div class="job-title-sec">
                            <h3><a href="/job/{{lcfirst($account)}}/{{$jb->id}}" title="">{{$jb->title}}</a></h3>
                            <span>{{substr($jb->description, 0 , 15)}}</span>
                            <a href="/job/{{lcfirst($account)}}/{{$jb->id}}"><div class="job-lctn"><i class="la la-map-marker"></i>{{$jb->address}}</div></a>
                          </div>
                          <div class="job-style-bx">
                            @if($jb->status == 1)
                            <a href="/job/{{lcfirst($account)}}/{{$jb->id}}"><span class="job-is ft">Pending</span></a>
                            @else
                            <a href="/job/{{lcfirst($account)}}/{{$jb->id}}"><span class="job-is ft">Taken</span></a>
                            @endif
                          </div>
                        </div>
                      </div>
                     </div>
                     @endforeach
                     @else
                     No Job Posted <br/><br/><br/>
                     @endif
                     .
                     <div class="row" id="project_navigation">
                       <div class="col-lg-6 col-sm-6 col-md-6">
                         @if($job->currentPage() > 1)
                         <a href="{{$job->previousPageUrl()}}">
                           <span class="job-is ft">previous</span>
                         </a>
                         @endif
                       </div>
                       <div class="col-lg-6 col-sm-6 col-md-6">
                         @if($job->currentPage() != $job->lastPage() && $job->lastPage() != 0)
                         <a href="{{$job->nextPageUrl()}}">
                           <span class="job-is ft">next</span>
                         </a>
                         @endif
                       </div>
                     </div>
                     <h3>Location</h3>
                     <div class="pf-map" id="map">
                       <div id="googleMap" style="width: 100%; height: 250px;"></div>
                     </div>
                  </div>
                </div>
                <div class="col-lg-4 column">
                  <!--<div class="job-overview">
                    <h3>Company Information</h3>
                    <ul>
                      <li><i class="la la-file-text"></i><h3>Lorem Ipsum</h3><span>Ipsum</span></li>
                      <li><i class="la la-map"></i><h3>Lorem</h3><span>Ipsum</span></li>
                      <li><i class="la la-bars"></i><h3>Lorem</h3><span>Ipsum</span></li>
                      <li><i class="la la-clock-o"></i><h3>Lorem</h3><span>Ipsum</span></li>
                    </ul>
                  </div> Job Overview -->
                </div>
              </div>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--App-->
<script>
var latitude = "<?php echo $auth_user->latitude; ?>";
var longitude = "<?php echo $auth_user->longitude; ?>";
var showMap = 2;
</script>
<script src="{{URL::asset('js/apps/map.js')}}" type="text/javascript"></script>
@endsection
