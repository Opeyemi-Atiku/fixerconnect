@extends('layouts.layouts')


@section('title', 'Technician List')
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
                <div class="emply-list-sec">
                        @foreach ($technician as $technician_)
                        <?php
                        $profile_image_source = "/storage/storage/$technician_->profile_image";
                        //$link = "/job/technician/$job->id";
                        ?>
            
                        <div class="emply-resume-list round justify-content-center">
                          <div class="emply-resume-thumb">
                            <img src="{{$profile_image_source}}" alt="" />
                          </div>
                          <div class="emply-resume-info">
                            <h3><a href="#" title="">{{$technician_->name}}</a></h3>
                            <span>{{$technician_->trade_type}}</span>
                            <p><i class="la la-map-marker"></i>{{$technician_->location}}</p>
                          </div>
                          <div class="shortlists">
                            <a href="/view_technician/{{$technician_->id}}" title="">Hire <i class="la la-plus"></i></a>
                          </div>
                        </div><!-- Emply List -->                
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
            </div>
          </div>
        <!--App-->

       </div>
    </div>
  </div>
</section>

@endsection
