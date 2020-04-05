@extends('layouts.layouts')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/loader2.css')}}" />

@section('title', 'Dashboard')
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

        <!--dashboard-->
        <div class="col-lg-9 column" id="dashboard">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              @if(session('status'))
              <a id="status__" class="post-job-btn">{{session('status')}}</a>
              @endif
              <h3>Candidate Dashboard</h3>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="" id="details">
                        <i class="la la-briefcase"></i>
                        <span>Personal Details</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category ">
                      <a  title="" id="subscription">
                        <i class="la la-database"></i>
                        <span>Manage subscription Packages</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/search/{{$account}}" title="" id="">
                        <i class="la la-search"></i>
                        <span>Search Jobs</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/bidding/{{$account}}" title="" id="">
                        <i class="la la-exchange"></i>
                        <span>Bid and Proposals</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/faq/{{$account}}" title="" id="">
                        <i class="la la-question"></i>
                        <span>Help & FAQ's</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/review/{{$account}}" title="" id="">
                        <i class="la la-comment"></i>
                        <span> Reviews</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cat-sec">
                <div class="row no-gape">
                  <!--<div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a id="message">
                        <i class="la la-comments"></i>
                        <span> Message</span>
                      </a>
                    </div>
                  </div>-->
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--dashbaord-->

        <!--details-->
        <div class="col-lg-9 column" id="details">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <h3><i class="la la-database"></i> Personal Details</h3>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/profile/{{$account}}" title="" id="">
                        <i class="la la-user"></i>
                        <span>Profile Summary</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category ">
                      <a  href="/edit/{{$account}}" title="" id="">
                        <i class="la la-user-plus"></i>
                        <span>Edit Profile</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/change_password/{{$account}}" title="" id="">
                        <i class="la la-plug"></i>
                        <span>Forgotten Password Retrieval</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <!--<a href="" title="" id="">
                        <i class="la la-cogs"></i>
                        <span>Settings</span>
                      </a>-->
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--details-->

        <!--subscription-->
        <div class="col-lg-9 column" id="subscription">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <h3><i class="la la-database"></i> Manage subscription Packages</h3>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/invoices/{{$account}}" title="" id="">
                        <i class="la la-archive"></i>
                        <span>Payment invoices</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category ">
                      <a href="/upgrade/{{$account}}" title="" id="">
                        <i class="la la-credit-card"></i>
                        <span>Upgrade Package</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--subscription-->

        <!--message-->
        <!--<div class="col-lg-9 column" id="message">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <h3><i class="la la-comments"></i> Messages</h3>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/inbox/technician" title="" id="">
                        <i class="la la-download"></i>
                        <span>Inbox</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category ">
                      <a href="/sent/technician" title="" id="">
                        <i class="la la-upload"></i>
                        <span>Sent</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a href="/deleted/technician" title="" id="">
                        <i class="la la-close"></i>
                        <span>Deleted Items</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>-->
        <!--message-->

        <!--loader-->
        <div class="col-lg-9 column" id="loader">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <div class="container" id="loading">
                <div class="row" id="loadings1">
                  <div class="col-md-2"></div>
                  <div class="col-md-6">
                    <img src="{{URL::asset('images/loaders.gif')}}" alt="" />
                  </div>
                  <div class="col-md-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--loader-->
       </div>
    </div>
  </div>
</section>
<script>
$(function(){
  setTimeout(function(){
    $('#status__').hide('slow');
  }, 5000);
});
</script>
<script src="{{URL::asset('js/apps/employee_dashboard.js')}}" type="text/javascript"></script>
@endsection
