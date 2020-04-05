@extends('layouts.layouts')

@section('title', 'Reviews')
@section('content')

<!--Title-->
@include('source_file.Dashboard.Employee.inc.title_bar')
<!--Title-->

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
            <div class="emply-list-sec">
              @if(count($review) > 0)
              <?php $i = 1; ?>
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
                                            <input type="hidden" name="whatever1" class="rating-value{{$i}}" value="{{$view->rating}}">
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
                <div>
                  <span class="job-is ft">{{$view->trade_name}}</span>
                </div>
              </div>
              <?php $i++; ?>
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
        <!--App-->

       </div>
    </div>
  </div>
</section>
@endsection
