@extends('layouts.layouts')

@section('title', 'Help & FAQ')
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
            <div class="block">
        			<div class="container">
        				<div class="row">
        					<div class="col-lg-12">
        						<div class="faqs">
        							<div class="faq-box">
        								<h2>Lorem Ipsum? <i class="la la-minus"></i></h2>
        								<div class="contentbox">
        									<p>Lorem Ipsum</p>
        								</div>
        							</div>
        						</div>
        					</div>
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
