@extends('layouts.layouts')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/loader2.css')}}" />

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
        <!--dashboard-->
        <div class="col-lg-9 column" id="dashboard">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <h3>{{$account}} Dashboard</h3>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="" id="business">
                        <i class="la la-briefcase"></i>
                        <span>Business Details</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category view-resume-list">
                      <a  title="" id="project">
                        <i class="la la-dashboard"></i>
                        <span>Projects</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="" id="message">
                        <i class="la la-comments"></i>
                        <span>Messages</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="">
                        <i class="la la-comment"></i>
                        <span>Reviews</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category follow-companies-popup">
                      <a  title="">
                        <i class="la la-question"></i>
                        <span> Help & FAQ's</span>
                      </a>
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
        <!--dashboard-->

        <!--Business details-->
        <div class="col-lg-9 column" id="business">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <h3><i class="la la-briefcase"></i> Business Details</h3>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="">
                        <i class="la la-user"></i>
                        <span>Profile Summary</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category view-resume-list">
                      <a  title="">
                        <i class="la la-user-plus"></i>
                        <span>Edit Profile</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="">
                        <i class="la la-plug"></i>
                        <span>Forgotten Password</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="">
                        <i class="la la-cogs"></i>
                        <span>Settings</span>
                      </a>
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
        <!--Business details-->

        <!--projects-->
        <div class="col-lg-9 column" id="project">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <h3><i class="la la-dashboard"></i> Projects</h3>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="">
                        <i class="la la-toggle-on"></i>
                        <span>Accepted Projects</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category view-resume-list">
                      <a  title="">
                        <i class="la la-spinner"></i>
                        <span>Pending Projects</span>
                      </a>
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
        <!--projects-->

        <!--message-->
        <div class="col-lg-9 column" id="message">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <h3><i class="la la-comments"></i> Messages</h3>
              <div class="cat-sec">
                <div class="row no-gape">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="">
                        <i class="la la-download"></i>
                        <span>Inbox</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category view-resume-list">
                      <a  title="">
                        <i class="la la-upload"></i>
                        <span>Sent</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="p-category">
                      <a  title="">
                        <i class="la la-close"></i>
                        <span>Deleted Items</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--message-->

        <!--loader-->
        <div class="col-lg-9 column" id="loader">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <div class="container" id="loading">
                <div class="row" id="loadings1">
                  <div class="col-md-5"></div>
                  <div class="col-md-3">
                    <div class="loader"></div>
                  </div>
                  <div class="col-md-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--loader-->

        <!--App-->

       </div>
    </div>
  </div>
</section>
<script src="{{URL::asset('js/apps/employer_dashboard4.js')}}" type="text/javascript"></script>
@endsection
