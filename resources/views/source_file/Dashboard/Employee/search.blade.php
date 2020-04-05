@extends('layouts.layouts')


@section('title', 'Jobs')
@section('content')

<!--Title-->
@include('source_file.Dashboard.Employee.inc.title_bar')
<!--Title-->

<!--App-->
<section>
  <div class="block no-padding">
    <div class="container">
       <div class="row no-gape">
        <aside class="col-lg-3 column border-right">
          <form id="search_form" method="get" action="/search">
            <div class="widget">
              @if($errors->has('title'))
                <span style="color: #B22222; float: right">
                  {{$errors->first('title')}}
                </span>
              @endif
              <div class="search_widget_job">
                <h4><a id="dashboard" href="/redirect_dashboard"><i class="la la-sitemap"></i> Dashboard</a></h4>
                <div class="field_w_search">
                  <input type="text" name="title" placeholder="Search Keywords" />
                  <a><i id="search__" class="la la-search"></i></a>
                  <div class="field_w_search">
                    <input type="text" id="location" name="location" placeholder="All Locations" />
                    <input type="hidden" id="latitude" name="latitude" value=""/>
                    <input type="hidden" id="longitude" name="longitude" value""/>
                    <i id="map_before" class="la la-map-o"></i>
                    <i id="loading__"><img src="{{URL::asset('images/loaders.gif')}}" width="50" height="20" alt="" /></i>
                    <i id="map_after" class="la la-map-marker"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="widget">
              <h3 class="sb-title closed">Date Posted</h3>
              <div class="posted_widget">
                <input type="radio" name="choose" value="1" id="232"><label for="232">Last Hour</label><br />
                <input type="radio" name="choose"value="2" id="wwqe"><label for="wwqe">Last 24 hours</label><br />
                <input type="radio" name="choose" value="4" id="erewr"><label for="erewr">Last 7 days</label><br />
                <input type="radio" name="choose" value="5" id="qwe"><label for="qwe">Last 14 days</label><br />
                <input type="radio" name="choose" value="6" id="wqe"><label for="wqe">Last 30 days</label><br />
                <input type="radio" name="choose" value="7" id="qweqw"><label class="nm" for="qweqw">All</label><br />
              </div>
            </div>
            <div class="widget">
              <h3 class="sb-title closed">Job Type</h3>
              <div class="type_widget">
                <p class="flchek"><input type="checkbox" name="choosetype[]" value="1" id="33r"><label for="33r">HVCA</label></p>
                <p class="ftchek"><input type="checkbox" name="choosetype[]" value="2" id="dsf"><label for="dsf">Electrical</label></p>
                <p class="ischek"><input type="checkbox" name="choosetype[]" value="3" id="sdd"><label for="sdd">Plumbing</label></p>
                <p class="ptchek"><input type="checkbox" name="choosetype[]" value="4" id="sadd"><label for="sadd">Handy Pro</label></p>
              </div>
            </div>
          </form>
        </aside>
        <div class="col-lg-9 column">
          <div class="modrn-joblist">
            <div class="filterbar">
              <h3>Jobs & Vacancies</h3>
            </div>
           </div><!-- MOdern Job LIst -->
           <div class="job-list-modern">
            <div class="job-listings-sec">

              @if(count($jobs) > 0)
              @foreach($jobs as $job)
              <?php
              $profile_image_source = "/storage/storage/$job->profile_image";
              $link = "/job/technician/$job->id";
              ?>
              <div class="job-listing wtabs">
                <a href="{{$link}}">
                <div class="job-title-sec">
                  <div class="c-logo"> <img src='{{URL::asset("$profile_image_source")}}' style="width: 100px; height: 100px;"/> </div>
                  <h3>{{$job->title}}</h3>
                  <h6><i class="la la-user"></i>{{$job->name}}</h6>
                  <div class="job-lctn"><i class="la la-map-marker"></i>{{$job->address}}</div>
                </div>
                <div class="job-style-bx">
                  <i><i class="la la-calendar-o"></i>{{$job->created_at->diffForHumans()}}</i>
                </div>
                </a>
              </div><!-- Job -->
              @endforeach
              @else
              <div class="job-listing wtabs">
                No Job Posted Yet
              </div><!-- Job -->
              @endif
              .
              <div class="row" id="project_navigation">
                <div class="col-lg-6 col-sm-6 col-md-6">
                  @if($jobs->currentPage() > 1)
                  <a href="{{$jobs->previousPageUrl()}}">
                    <span class="job-is ft">previous</span>
                  </a>
                  @endif
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6">
                  @if($jobs->currentPage() != $jobs->lastPage() && $jobs->lastPage() != 0)
                  <a href="{{$jobs->nextPageUrl()}}">
                    <span class="job-is ft">next</span>
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

<script src="{{URL::asset('js/apps/search_location_.js')}}" type="text/javascript"></script>
@endsection
