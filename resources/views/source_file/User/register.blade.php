@extends('layouts.layouts')

@section('title', 'Register')
@section('content')
<section>
  <div class="block no-padding  gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner2">
            <div class="inner-title2">
              <h3>Register</h3>
            </div>
            <div class="page-breacrumbs">
              <ul class="breadcrumbs">
                <li><a href="#" title="">Home</a></li>
                <li><a href="#" title="">Register</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="wow slideInLeft" data-wow-duration="500ms" data-wow-delay="500ms">
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading">
            <h2>How It Works</h2>
            </span>
          </div><!-- Heading -->
          <div class="how-to-sec style2 no-lines">
            <div class="how-to">
              <span class="how-icon"><i class="la la-user"></i></span>
              <h3>Register an account</h3>
              <p>Post a job to tell us about your project.</p>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-file-archive-o"></i></span>
              <h3>Specify & search your job</h3>
              <p>Browse and reviews profiles</p>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-list"></i></span>
              <h3>Apply for job</h3>
              <p>Apply for job and get hired.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="browse-all-cat">
            <a href="/register/technician" title="">Register As Technician</a>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="browse-all-cat">
            <a href="/register/residential" title="">Register As Residential</a>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="browse-all-cat">
            <a href="/register/commercial" title="">Register As Commercial</a>
          </div>
        </div>
        
        <div class="col-lg-3">
          <div class="browse-all-cat">
            <a href="/register/contractor" title="">Register As Local Contractor</a>
          </div>
        </div>
        

      </div>
    </div>
  </div>
</section>


<script>
$(function(){
  $('section#signup_how_it_work').hide();

  $('a#how_it_work').click(function(){
    $('section#signup_how_it_work').show();
  });

});
</script>
@endsection
