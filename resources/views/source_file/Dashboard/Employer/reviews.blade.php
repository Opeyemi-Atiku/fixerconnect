@extends('layouts.layouts')

@section('title', 'Review')
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
				 			<div class="emply-list">
				 				<div class="emply-list-thumb">
				 					<a href="#" title=""><img src="{{URL::asset('images/resource/em2.jpg')}}" alt="" /></a>
				 				</div>
				 				<div class="emply-list-info">
				 					<div class="emply-pstn">Lorem Ipsum</div>
				 					<h3><a href="#" title="">Lorem Ipsum</a></h3>
				 					<span>Lorem Ipsum</span>
				 					<h6><i class="la la-map-marker"></i>Lorem Ipsum</h6>
				 					<p>Lorem Ipsum</p>
				 				</div>
				 			</div><!-- Employe List -->
				 			<div class="pagination">
								<ul>
									<li class="prev"><a href="#"><i class="la la-long-arrow-left"></i> Prev</a></li>
									<li><a href="#">1</a></li>
									<li class="active"><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><span class="delimeter">...</span></li>
									<li><a href="#">14</a></li>
									<li class="next"><a href="#">Next <i class="la la-long-arrow-right"></i></a></li>
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
