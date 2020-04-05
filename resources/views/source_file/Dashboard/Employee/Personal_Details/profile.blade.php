@extends('layouts.layouts')

@section('title', $auth_user->name)
@section('content')
<!--App-->
<section class="overlape">
  <div class="block no-padding">
    <div data-velocity="-.1" style="background: url(images/resource/mslider1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
    <div class="container fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner-header">
            <div class="container">
              <div class="row">
                <div class="col-lg-6">
                  <div class="text-socail">
                    <!--<a href="#" title=""><i class="fa fa-facebook"></i></a>
                    <a href="#" title=""><i class="fa fa-twitter"></i></a>
                    <a href="#" title=""><i class="la la-google"></i></a>-->
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="action-inner style2">
                    <div class="download-cv">
                      <!--<a href="#" title="">Download CV <i class="la la-download"></i></a>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="overlape">
  <div class="block remove-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="cand-single-user">
            <div class="share-bar circle"></div>
            <div class="can-detail-s">
              <?php
              if($auth_user->profile_image == null){
                $profile_image_source = "/storage/storage/profile_image.png";
              }else{
                $profile_image_source = "/storage/storage/$auth_user->profile_image";
              }
              ?>
              <div class="cst"><img src='{{URL::asset("$profile_image_source")}}' style="width: 100%; height: 140px;"  alt="" /></div>
              <h3>{{$auth_user->name}}</h3>
              @if(Auth::check())<p>{{$auth_user->email}}</a></p>@endif
              <p>Member Since, {{$auth_user->created_at->diffForHumans()}}</p>
              <p><i class="la la-map-marker"></i>{{$auth_user->location}}</p>
              <div class="skills-badge">
                @if($auth_user->trade_name)<span>{{$auth_user->trade_name}}</span>@endif
              </div>
            </div>
            <div class="download-cv"></div>
          </div>
          <div class="cand-details-sec">
            <div class="row no-gape">
              <div class="col-lg-8 column">
                <div class="cand-details">
                  <div class="job-overview style2">
                    <ul>
                      <li><i class="la la-money"></i><h3>Charges</h3><span>{{$auth_user->currency}}{{$auth_user->charges}}</span></li>
                      <!--<li><i class="la la-thumb-tack"></i><h3>Career Level</h3><span>Lorem Ipsum</span></li>
                      <li><i class="la la-puzzle-piece"></i><h3>Industry</h3><span>Lorem Ipsum</span></li>
                      <li><i class="la la-shield"></i><h3>Experience</h3><span>Lorem Ipsum</span></li>
                      <li><i class="la la-line-chart "></i><h3>Qualification</h3><span>Lorem Ipsum</span></li>-->
                    </ul>
                  </div><!-- Job Overview -->
                  <h2>Candidates Experience</h2>

                  <p>{{$auth_user->experience}}</p>
                  <h2>Location</h2>
                  <div class="pf-map" id="map">
                    <div id="googleMap" style="width: 100%; height: 250px;"></div>
                  </div>
                  <!--<div class="edu-history-sec">
                    <h2>Experience</h2>
                    <div class="edu-history">
                      <i class="la la-graduation-cap"></i>
                      <div class="edu-hisinfo">
                        <h3>Institute</h3>
                        <i>Year - Year</i>
                        <span>Institute <i>Department</i></span>
                        <p>Lorem ipsum..</p>
                      </div>
                    </div>
                  </div>-->
                  <!--<div class="edu-history-sec">
                    <h2>Work & Experience</h2>
                    <div class="edu-history style2">
                      <i></i>
                      <div class="edu-hisinfo">
                        <h3>Job <span>lorem Ipsum</span></h3>
                        <i>Year - Year</i>
                        <p>Lorem ipsum..</p>
                      </div>
                    </div>
                  </div>-->
                  <!--<div class="progress-sec">
                    <h2>Professional Skills</h2>
                    <div class="progress-sec style2">
                      <span>Lorem Ipsum</span>
                      <div class="progressbar"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
                        <div class="progress"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
                      </div>
                      <p>80%</p>
                    </div>
                  </div>-->
                  <!--<div class="edu-history-sec">
                    <h2>Awards</h2>
                    <div class="edu-history style2">
                      <i></i>
                      <div class="edu-hisinfo">
                        <h3>Award Title</h3>
                        <i>Year - Years</i>
                        <p>Lorem ipsum.</p>
                      </div>
                    </div>
                  </div>-->
                </div>
              </div>
              <div class="col-lg-4 column">
                <div class="job-overview style3">
                  <!--<a href="#" title="" class="save-resume">Save Resume</a>-->
                  @if(Auth::check())
                  @if(Auth::user()->account_type != 5 && Auth::user()->account_type != 1)
                <a href="/invitation/{{lcfirst($account)}}/{{$auth_user->id}}" title="" class="contct-user">Hire {{$auth_user->name}}</a>
                @endif
                  @elseif(Auth::guard()->check() == false)
                  <a title="" id="registration" class="contct-user">Hire {{$auth_user->name}}</a>
                  @if(isset($link))
                <form id="redirect_registration" action="/registration/{{$link}}" method="get"> 
                    @endif
                    {{ csrf_field() }}
                                
                  </form>
                  <script>
                    $(function(){
                      $('a#registration').click(function(){
                        $("#redirect_registration").submit();
                      });
                    });
                   </script>
                  @endif
                </div><!-- Job Overview -->
                
                
                <div id="schedule_" class="job-overview style3">
                  <a href="#schedule_" title="" class="save-resume"><i class="la la-calendar"></i>Schedule</a>
                  @if($schedule)
                  <span>Monday: {{$schedule->monday}}</span><br/><br/>
                  <span>Tuesday : {{$schedule->tuesday}}</span><br/><br/>
                  <span>Wednesday : {{$schedule->wednesday}}</span><br/><br/>
                  <span>Thursday : {{$schedule->thursday}}</span><br/><br/>
                  <span>Friday : {{$schedule->friday}}</span>
                  @else
                  <span>Monday: </span><br/><br/>
                  <span>Tuesday : </span><br/><br/>
                  <span>Wednesday : </span><br/><br/>
                  <span>Thursday : </span><br/><br/>
                  <span>Friday : </span>
                  @endif

                </div><!-- Job Overview -->
                
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-9 column">
            
            <div class="padding-left">
              <div class="emply-list-sec">
                <h2>Review</h2> 
                @if(count($review) > 0)
                @foreach($review as $view)
                <?php
                $profile_image_source = "/storage/storage/$view->profile_image";
                ?>
  
                <div class="job-listing wtabs">
                  <div class="job-title-sec">
                    <div class="c-logo"><a href="/view_profile/{{$view->company_id}}"><img src='{{URL::asset("$profile_image_source")}}'  style="width: 100px; height: 100px;" class="img-thumbnail rounded-circle" /></a></div>
                    <h3><a href="/view_profile/{{$view->company_id}}"><i class="la la-user"></i>{{$view->name}}</a></h3>
                    <h3><a>{{$view->title}}</a></h3>
                    <div class="job-lctn"><i class="la la-map-marker"></i>{{$view->address}}</div>
                    <span><i class="la la-comment"></i>{{$view->review}}</span>
                  </div>
                  <div>
                    <span class="job-is ft">{{$view->trade_name}}</span>
                  </div>
                </div>
                @endforeach
                @else
                No Review
                @endif
                .
                <div class="row" id="project_navigation">
                  <div class="col-lg-6 col-sm-6 col-md-6">
                    @if($review->currentPage() > 1)
                    <a href="{{$review->previousPageUrl()}}">
                      <span class="job-is ft">previous</span>
                      </button>
                    </a>
                    @endif
                  </div>
                  <div class="col-lg64 col-sm-6 col-md-6">
                    @if($review->currentPage() != $review->lastPage() && $review->lastPage() != 0)
                    <a href="{{$review->nextPageUrl()}}">
                      <span class="job-is ft">next</span>
                      </button>
                    </a>
                    @endif
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
