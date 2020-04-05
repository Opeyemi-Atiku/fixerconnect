@extends('layouts.layouts')

@section('title', 'Home')
@section('content')
<link href="{{URL::asset('css/apps/fonts/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{URL::asset('css/apps/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/apps/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/apps/style_carousel2.css')}}">

<section>
  <div class="cl-left wow bounceInLeft">
    <div class="img-o">
      <div class="img-hover-zoom img-hover-zoom--brightness">
        <img src="images/resource/residentail.png" class="img-responsive">
      </div>
      <div class="img-bg p-top">
        <h1 class="text-center">Residential</h1>
        <ul class="list-ul clearfix">
          <li>
            <div class="over-text">
              <a href="/category/1"><img src="images/resource/hvacs.png" class="img-responsive sz">
                <h3>HVAC Tech</h3></a>
            </div>
          </li>
          <li>
            <div class="over-text">
              <a href="/category/2"><img src="images/resource/electricians.png" class="img-responsive sz">
                <h3>Electrician</h3></a>
            </div>
          </li>
          <li>
            <div class="over-text">
              <a href="/category/3"><img src="images/resource/plumbers.png" class="img-responsive sz">
                <h3>Plumber</h3></a>
            </div>
          </li>
        </ul>
        <a href="/register/residential" class="signup">Signup for Free</a>
      </div>
    </div>
  </div>
  <div class="cl-right wow bounceInRight">
    <div class="img-o">
      <div class="img-hover-zoom img-hover-zoom--brightness">
        <img src="images/resource/commercial.png" class="img-responsive">
      </div>
      <div class="img-bg  p-top">
        <h1 class="text-center">Commercial</h1>
        <ul class="list-ul clearfix">
          <li>
            <div class="over-text">
              <a href="/local_contractor"><img src="images/resource/contractor.png" class="img-responsive sz">
                <h3>Connect with local contractor</h3></a>
            </div>
          </li>
          <li>
            <div class="over-text">
              <a href="/project_listing"><img src="images/resource/project.png" class="img-responsive sz">
                <h3>List your project</h3></a>
            </div>
          </li>
          <li>
            <div class="over-text">
              <a href="/customize"><img src="images/resource/site.png" class="img-responsive sz">
                <h3>Customize service for your site</h3></a>
            </div>
          </li>
        </ul>
        <a href="/register/commercial" class="signup">Signup for Free</a>
      </div>
    </div>
  </div>
  <div class="clearfix">
  </div>
</section>


<section id="scroll-here" class="wow slideInUp" data-wow-duration="500ms" data-wow-delay="500ms">
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading">
            <h2>Popular Categories</h2>
          </div><!-- Heading -->
          <div class="cat-sec">
            <div class="row no-gape">
              <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="p-category">
                  <a href="/category/1" title="">
                   <img src="images/resource/havc-icon.png" style="width: 150px; height: 150%;" alt="">
                    <span>HVAC Tech</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="p-category">
                  <a href="/category/2" title="">
                       <img src="images/resource/electricianz.png" style="width: 150px; height: 230%;" alt="">
                    <span>Electrician</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="p-category">
                  <a href="/category/3" title="">
                          <img src="images/resource/plumberz.png" style="width: 150px; height: 230%;" alt="">
                    <span>Plumber</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="p-category">
                  <a href="/project_listing" title="">
                      <img src="images/resource/checklistz.png" style="width: 150px; height: 150%;" alt="">
                    <span>List your Project </span>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="p-category">
                  <a href="/category/4" title="">
                      <img src="images/resource/handy-pros.png" style="width: 150px; height: 150%;"  alt="">
                    <span>Handy Pro </span>
                  </a>
                </div>
              </div>
			        <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="p-category">
                  <a href="/local_contractor" title="">
                      <img src="images/resource/contractr.png" style="width: 150px; height: 150%;" alt="">
                    <span>Connect with local contractor </span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
            </div>
        <div class="col-lg-4 col-md-4">
          <div class="browse-all-cat">
            <div class="widget">
              <a class="sb-title closed" title="">Browse Technician Near You</a>
              <div class="type_widget">
                  <br/>
                  <p><a href="/category/1">HVCA</a></p>
                  <p><a href="/category/2">Electrical</a></p>
                  <p><a href="/category/3">Plumber</a></p>
                  <p><a href="/category/4">Handy Pro</a></p>
                  
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
            </div>
      </div>
    </div>
  </div>
</section>

<section class="wow slideInRight" data-wow-duration="500ms" data-wow-delay="500ms">
  <div class="pf-map" id="map">
    <div id="googleMap" style="width: 100%; height: 250px;"></div>
  </div>
</section>

<section class="wow slideInLeft" data-wow-duration="500ms" data-wow-delay="500ms">
  <div class="owl-carousel owl-theme" style="margin-top: 30px;">
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="testimonial">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
        <div class="media">
          <div class="media-left d-flex mr-3">
            <img src="images/1.jpg" alt="">
          </div>
          <div class="media-body">
            <div class="overview">
              <div class="name"><b>Michael Holz</b></div>
              <div class="details">Web Developer / DevCorp</div>
              <div class="star-rating">
                <ul class="stars">
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                  <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<section>
  <div class="block double-gap-top double-gap-bottom" style="margin-top: 30px;">
    <div data-velocity="-.1" style="background: url(images/resource/parallax1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div><!-- PARALLAX BACKGROUND IMAGE -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="simple-text-block wow bounceInUp">
            <h3>Make a Difference with Your Online Resume!</h3>
            <span>Lorem Ipsum</span>
            <a href="#" title="">Create an Account</a>
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
      </div>
    </div>
  </div>
</section>

<section class="wow bounceInDown">
  <div class="block no-padding">
    <div class="container fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="simple-text">
            <h3>Got a question?</h3>
            <span>We're here to help. Check out our FAQs, send us an email or call us at 1 (800)</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  var latitude = 0;
  var  longitude = 0;
  var showMap = 2;
  $(document).ready(function(){
  //document.location.href = '/location_8.1227496_4.2435893';
  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }
  function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    document.location.href = '/location_'+latitude+'_'+longitude;
  }
  getLocation();
  });
</script>
<script src="{{URL::asset('js/apps/map.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/apps/owl.carousel.min.js')}}"></script>
<script src="{{URL::asset('js/apps/js_carousel.js')}}"></script>
@endsection
