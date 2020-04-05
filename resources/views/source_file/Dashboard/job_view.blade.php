@extends('layouts.layouts')


@section('title', 'Jobs')
@section('content')

<!--Title-->
@include('source_file.Dashboard.Employer.inc.title_bar')
<!--Title-->
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/chat_and_job_navigation.css')}}" />
<style>.star-rating {
  line-height:32px;
  font-size:1.25em;
}

.star-rating .la-star{color: yellow;}
</style>



<!--App-->
<section id="app">
    
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 column">
          <div class="job-single-sec style3">
            <div class="job-head-wide">
              <div class="row">
                <div class="col-lg-8">
                  <div class="job-single-head3">
                    <!--<div class="job-thumb"> <img src="images/resource/sdf.png" alt="" /><span>12 Open Position</span> </div>-->
                    <div class="job-single-info3">
                      <h3>{{$job->title}}</h3>
                      <span><i class="la la-map-marker"></i>{{$job->address}}</span><span class="job-is ft">{{$job->trade_name}}</span>
                      <ul class="tags-jobs">
                        <!--<li><i class="la la-file-text"></i> Applications 1</li>-->
                        <li><i class="la la-calendar-o"></i> {{$job->created_at->diffForHumans()}} </li>
                        <li><i class="la la-money"></i> ${{$job->budget_from}} - ${{$job->budget_to}}</li>
                        <li><a href="/view_profile/{{$job->user_id}}"><i class="la la-user"></i>{{$job->company_name}}</a></li>
                      </ul>
                    </div>
                  </div><!-- Job Head -->
                </div>
                <div class="col-lg-4">
                  @if($account == 'Technician')
                  @if($applied == 2)
                  <a class="apply-thisjob" href="#applyForm" title="" id="apply"><i class="la la-paper-plane"></i>Apply for job</a>
                  @elseif($applied == 1)
                  <a class="apply-thisjob" title="" id="applied"><i class="la la-paper-plane"></i>Applied</a>
                  @endif
                  @endif
                </div>
              </div>
            </div>
            <div class="job-wide-devider">
              <div class="row">
                <div class="col-lg-8 column">
                  <div class="job-details">
                    <h3>Job Description</h3>
                    <p>{{$job->description}}</p>
                  </div>
                  <h4>Location</h4>
                  <div class="pf-map" id="map">
                    <div id="googleMap" style="width: 100%; height: 250px;"></div>
                  </div>
                  <div class="recent-jobs">
                    <h3>Technician</h3>
                    <div class="job-list-modern">
                      <div class="job-listings-sec no-border">
                        @if(count($accept_applicant) > 0)
                        <?php
                          $i = 1;
                        ?>
                        @foreach($accept_applicant as $applicant__)
                        <?php
                        $profile_image_source = "/storage/storage/$applicant__->profile_image";
                        
                        ?>
                        <div class="job-listing wtabs">
                          <div class="job-title-sec">
                            <div class="c-logo"> <img src='{{URL::asset("$profile_image_source")}}'  style="width: 90px; height: 90px;" class="img-thumbnail rounded-circle" /> </div>
                            <h3><a title="">{{$applicant__->name}}</a></h3>
                            <span><i class="la la-comment"></i>{{substr($applicant__->review, 0, 12)}}</span>
                            <div class="job-lctn"><i class="la la-map-marker"></i>{{$applicant__->address}}</div>
                            <style>
                            .star-rating{{$i}} {
                                line-height:32px;
                                font-size:1.25em;
                            }
                            .star-rating{{$i}} .la-star{color: yellow;}
                            </style>
                            <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                          <div class="star-rating{{$i}}">
                                            <i class="la la-star-o" data-rating="1"></i>
                                            <i class="la la-star-o" data-rating="2"></i>
                                            <i class="la la-star-o" data-rating="3"></i>
                                            <i class="la la-star-o" data-rating="4"></i>
                                            <i class="la la-star-o" data-rating="5"></i>
                                            <input type="hidden" name="whatever1" class="rating-value{{$i}}" value="{{$applicant__->rating}}">
                                    </div>
                                   </div>
                                 </div>
                                 
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
                          <div class="job-style-bx">
                            @if($job->user_id == Auth::id())
                            @if($applicant__->review_status == 2)
                            <span class="job-is ft signin-popup" user_id="{{$applicant__->user_id}}" name="{{$applicant__->name}}" id="popup__">Add Review</span>
                            @elseif($applicant__->review_status == 1)
                            <span class="job-is ft signin-popup" user_id="{{$applicant__->user_id}}" name="{{$applicant__->name}}" id="popup__">Update Review</span>
                            @endif
                            @endif
                          </div>
                        </div>
                        <?php
                          $i++;
                        ?>
                        @endforeach
                        <!--review-->
                        <div class="account-popup-area signin-popup-box">
                        	<div class="account-popup">
                            <h3 id="name_review"></h3>
                            <span id="review_validation"></span>
                        		<span class="close-popup"><i class="la la-close"></i></span>
                        		<form>
                        			<div class="cfield">
                        				<input type="text" name="review" id="review" placeholder="Enter Review" />

                        			</div>
                                      
                        			<a class="post-job-btn" id="review__"><i class="la la-comment"></i>Submit Review</a>
                        			
                        			<div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                          <div class="star-rating">
                                            <span class="la la-star-o" data-rating="1"></span>
                                            <span class="la la-star-o" data-rating="2"></span>
                                            <span class="la la-star-o" data-rating="3"></span>
                                            <span class="la la-star-o" data-rating="4"></span>
                                            <span class="la la-star-o" data-rating="5"></span>
                                            <input type="hidden" id="whatever1" name="whatever1" class="rating-value" value="4">
                                    </div>
                                   </div>
                                 </div>
                        		</form>
                        	</div>
                        </div>
                        <!--Review-->
                        .
                        <div class="row" id="project_navigation">
                          <div class="col-lg-6 col-sm-6 col-md-6">
                            @if($accept_applicant->currentPage() > 1)
                            <a href="{{$accept_applicant->previousPageUrl()}}">
                              <span class="job-is ft">previous</span>
                              </button>
                            </a>
                            @endif
                          </div>
                          <div class="col-lg64 col-sm-6 col-md-6">
                            @if($accept_applicant->currentPage() != $accept_applicant->lastPage() && $accept_applicant->lastPage() != 0)
                            <a href="{{$accept_applicant->nextPageUrl()}}">
                              <span class="job-is ft">next</span>
                              </button>
                            </a>
                            @endif
                          </div>
                        </div>

                        @else
                        No Worker
                        @endif
                      </div>
                     </div>
                  </div>
                </div>


                <div class="col-lg-4 column">
                  @if($account == 'Technician')
                  <div class="quick-form-job" id="applyForm">
                      <input type="text" name="bid" id="bid" placeholder="Enter your bid price" />
                      <span id="validation"></span>
                      <button id="bidSubmit" class="submit">Bid</button>
                  </div>
                  <div class="row" id="loading">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                      <img src="{{URL::asset('images/loaders.gif')}}" alt="" style="width: 100%; height: 100%;" />
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  @endif
                  <div class="job-overview">
                    @if($account == 'Technician')
                    @if($applied == 1)
                    <div id="message" user_id="{{$job->user_id}}" price="{{$price}}"><ul><a class="apply-thisjob"><i class="la la-comments"></i>Open Chat</a></ul></div>
                    @endif
                    @endif
                    <h3>Bid And Invitation</h3>
                    <ul>
                      @if(count($applicant) > 0)
                      @foreach($applicant as $app)
                      <?php
                      $profile_image_source = "/storage/storage/$app->profile_image";
                      ?>
                      @if($job->user_id == Auth::id())
                      <div class="item d-flex align-items-center" id="message" user_id="{{$app->user_id}}" price="{{$app->bid_price}}">
                        @else
                          <div class="item d-flex align-items-center" user_id="{{$app->user_id}}">
                        @endif
                        <div class="image"><img src='{{URL::asset("$profile_image_source")}}' style="width: 70px; height: 70px;" class="img-thumbnail rounded-circle"></div>

                        <div class="text" style="margin-left: 10px;">
                          <a>
                             {{$app->name}}<br/>
                          </a>
                          @if($job->user_id == Auth::id())
                          <a>
                            @if($app->status != 6)
                            <small style="font-size: 15px;"> ${{$app->bid_price}}</small>
                            @endif
                          </a>
                          @endif
                        </div>

                        @if($job->user_id == Auth::id())
                        <div id="applicant">
                          @if($app->status == 1)
                          <button class="post-job-btn" style="font-size: 10px; padding: 10px 5px !important"><span>pending</span></button>
                          @elseif($app->status == 2)
                          <button class="post-job-btn" style="font-size: 10px; padding: 10px 5px !important"><span>hired</span></button>
                          @elseif($app->status == 3)
                          <button class="post-job-btn" style="font-size: 10px; padding: 10px 5px !important"><span>waiting</span></button>
                          @elseif($app->status == 4)
                          <button class="post-job-btn" style="font-size: 10px; padding: 10px 5px !important"><span>paid</span></button>
                          @elseif($app->status == 5)
                          <button class="post-job-btn" style="font-size: 10px; padding: 10px 5px !important"><span>Decline</span></button>
                          @elseif($app->status == 6)
                          <button class="post-job-btn" style="font-size: 10px; padding: 10px 5px !important"><span>Invite</span></button>
                          @endif
                          <a><i class="la la-comments"></i></a>
                        </div>
                        @else
                        @if($account == 'Technician')
                        <!--<div id="applicant">
                          @if($app->status == 1)
                          <button class="post-job-btn" style="font-size: 13px; padding: 10px 5px !important"><span>pending</span></button>
                          @elseif($app->status == 2)
                          <button class="post-job-btn" style="font-size: 13px; padding: 10px 5px !important"><span>hired</span></button>
                          @elseif($app->status == 3)
                          <button class="post-job-btn" style="font-size: 13px; padding: 10px 5px !important"><span>waiting</span></button>
                          @elseif($app->status == 4)
                          <button class="post-job-btn" style="font-size: 10px; padding: 10px 5px !important"><span>paid</span></button>
                          @endif
                        </div>-->
                        @endif
                        @endif
                      </div>


                      @endforeach
                      <div class="row" id="project_navigation">
                        <div class="col-lg-6 col-sm-6 col-md-6">
                          @if($applicant->currentPage() > 1)
                          <a href="{{$applicant->previousPageUrl()}}">
                            <span class="job-is ft">previous</span>
                            </button>
                          </a>
                          @endif
                        </div>
                        <div class="col-lg64 col-sm-6 col-md-6">
                          @if($applicant->currentPage() != $applicant->lastPage() && $applicant->lastPage() != 0)
                          <a href="{{$applicant->nextPageUrl()}}">
                            <span class="job-is ft">next</span>
                            </button>
                          </a>
                          @endif
                        </div>
                      </div>
                      @else
                      No bid
                      @endif
                    </ul>


                  </div><!-- Job Overview -->
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

<!--loading-->
<section id="loading">
  <div class="row" id="loading">
    <div class="col-md-2"></div>
    <div class="col-md-6">
      <img src="{{URL::asset('images/loaders.gif')}}" alt="" style="width: 100%; height: 100%;" />
    </div>
    <div class="col-md-4"></div>
  </div>
</section>
<!--loading-->

<!--ChatApp-->
<section id="chat">
  <div class="container">
    <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
          </div>
          <div class="inbox_chat" id="contactList">

          </div>
        </div>
        <div class="mesgs">
          <!--<div class="t-center" id="newMessageChat"><button class="button button--small button--primary"><span style="color:white;">view new message</span></button></div>-->
          <div class="t-center" id="job_status_viewer">
            <button class="post-job-btn" id="hired_status" style="float: right !important; font-size: 10px; padding: 2px 15px !important;"><span id="job_status"></span></button>
            <button class="post-job-btn" id="choose_yes" style="float: right !important; font-size: 8px; padding: 2px 15px !important;"><span id="yes"></span>Yes</button>
            <button class="post-job-btn" id="choose_no" style="float: right !important; font-size: 8px; padding: 2px 15px !important;"><span id="no"></span>No</button>
          </div>

          <div id="current"><a id="currentUserLink"><img class="img-thumbnail rounded-circle" src="/storage/storage/profile_image.png" id="currentImage" height="50px" width="50px"><h5 id="currentName"></h5></a></div>


          <div class="msg_history">
            <div id="front" class="frontMessageView">

            </div>
            <div class="type_msg">
              <div class="input_msg_write">
                <input type="text" class="write_msg" placeholder="Type a message" id="message" />
                <button  id="sendMessage" msg="message" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" style="margin-left: -10px" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--ChatApp-->


<script>
var latitude = "<?php echo $job->latitude; ?>";
var longitude = "<?php echo $job->longitude; ?>";
var transact_account_ = "<?php echo lcfirst($account);?>";
var showMap = 2;
var job_id = <?php echo $job->id; ?>;
var total_message_fetch;
var auth_user = <?php echo Auth::id();?>;
var inbox_message_count_;
var user_fetch;
var user_id;
var total_contact = 0;
var previous_id;
var popUpNew = 2;
var new_message_sent = 1;
$(function(){
    if(transact_account_ === 'technician'){
        $('#job_status_viewer').hide();
    }
});

var user_id_review;
var name_review;
var message_review;
var star_rating;
var $star_rating = $('.star-rating .la');

var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('la-star-o').addClass('la-star');
    } else {
      return $(this).removeClass('la-star').addClass('la-star-o');
    }
  });
};

$star_rating.on('click', function() {
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

SetRatingStar();



</script>


<script src="{{URL::asset('js/apps/job_view_navigation_.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/apps/review4.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/apps/employer_message6.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/apps/map.js')}}" type="text/javascript"></script>
@endsection
