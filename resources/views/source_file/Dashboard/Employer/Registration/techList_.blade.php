
@extends('layouts.layouts')

@section('title', "{$trade_type}")
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
                <li><a href="#" title="">{{$trade_type}}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="wow bounceInDown" id="signup_how_it_work">
        <div class="emply-resume-sec">
            @if(count($technician) > 0)
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
                        <span>{{$trade_type}}</span>
                        <span>${{$technician_->charges}}/hrs</span>
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
                        <a @if(auth::check() == false)href="/commercial_view_technician/{{$technician_->user_id}}"@else href="/view_profile/{{$technician_->user_id}}"@endif title="">Hire <i class="la la-plus"></i></a>
                    </div>
                </div><!-- Emply List -->        
                <?php $i++; ?>
            @endforeach  
            @else
            <div class="emply-resume-list round">
                No {{$trade_type}} Found
            </div><!-- Emply List --> 
            @endif

                <?php
                $prev = $technician->currentPage() - 1;
                $next = $technician->currentPage() + 1;
                $url = Request::fullUrl();
                $nextUrl = $url.'&current_page='.$next;
                $prevUrl = $url.'&current_page='.$prev;
                ?>

                <div class="pagination">
                   <ul>
                       @if($technician->currentPage() > 1)
                       <li class="prev"><a href="{{$prevUrl}}"><i class="la la-long-arrow-left"></i> Prev</a></li>
                       @endif
                       @if($lastPage != $technician->currentPage() && && $lastPage != 0)
                       <li class="next"><a href="{{$nextUrl}}">Next  {{$technician->currentPage()}} <i class="la la-long-arrow-right"></i></a></li>
                       @endif
                   </ul>
               </div><!-- Pagination -->
              </div>

            </div>     
</section>


@endsection