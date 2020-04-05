@extends('layouts.layouts')

@section('title', 'Subscription')
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
            <div class="block">
        			<div class="container">
        				<div class="row">
        					<div class="col-lg-12">
        						<div class="heading">
        							<h2>Upgrade Packages</h2>
        							<span>Active plan - {{$plan_name}}</span>
                      @if(session('status'))
                      <br/>
                        <a class="post-job-btn" id="status__">{{session('status')}} <i class="fa fa-thumbs-up"></i></a>
                      <br/>
                      @endif
        						</div><!-- Heading -->
        						<div class="plans-sec">
        							<div class="row">
        								<div class="col-lg-4">
        								</div>
        								<div class="col-lg-4">
        									<div class="pricetable active">
        										<div class="pricetable-head">
        											<h3>Membership Plan</h3>
        											<h2><i>$</i>10</h2>
        											<span> 30Days</span>
        										</div><!-- Price Table -->
        										<ul>
        										</ul>
                            @if($status__ == 1)
                            <a id="subscribe" title="">Subscribe with <i class="la la-paypal"></i></a>
                            <a id="subscribe_stripe" title="">Subscribe with Stripe</a>
                            @endif
                            <form method="post" id="subscribe__" action="/transaction/subscribe">
                              {{ csrf_field() }}
                              <input type="hidden" name="amount" id="amount" value="10"/>
                            </form>
                            <form method="post" id="subscribe_stripe__" action="/transaction/subscribe_stripe">
                              {{ csrf_field() }}
                              <input type="hidden" name="amount" value="10"/>
                              <input type="hidden" name="action" value="subscribe" />
                            </form>
        									</div>
        								</div>
        								<div class="col-lg-4">
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
<script>
$(function(){
  $('#subscribe').click(function(){
    $('#subscribe__').submit();
  });
  $('#subscribe_stripe').click(function(){
    $('#subscribe_stripe__').submit();
  });
  setTimeout(function(){
    $('#status__').hide('slow');
  }, 5000);
});
</script>
@endsection
