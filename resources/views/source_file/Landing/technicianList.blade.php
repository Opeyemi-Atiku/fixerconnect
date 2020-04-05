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
                        <h3><a href="#" title="">{{$technician_->name}}</a></h3>
                        <span>{{$trade_type}}</span>
                        <p><i class="la la-map-marker"></i>{{substr($technician_->location, 0, 25)}}...</p>
                    </div>
                    <div class="shortlists">
                        <a href="/view_profile/{{$technician_->user_id}}" title="">View Profile <i class="la la-plus"></i></a>
                    </div>
                </div><!-- Emply List -->  
            @endforeach  
            @else
            <div class="emply-resume-list round">
                No {{$trade_type}} Found
            </div><!-- Emply List --> 
            @endif

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
</section>


@endsection
