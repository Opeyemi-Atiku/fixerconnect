@extends('layouts.layouts')

@section('content')
<section>
  <div class="block no-padding overlape">
    <div class="container fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="main-featured-sec style3">
            <ul class="main-slider-sec style3 text-arrows">
              <li><img src="images/resource/sn1.jpg" alt="" /></li>
              <li><img src="images/resource/sn2.jpg" alt="" /></li>
              <li><img src="images/resource/sn3.jpg" alt="" /></li>
            </ul>
            <div class="job-search-sec style3">
              <div class="job-search style2">
                <h3>Find the career you deserve</h3>
                <span>Your job search starts and ends with us.</span>
                <div class="search-job2 style2">
                  <form>
                    <div class="row no-gape">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="job-field">
                          <label>Search Keywords</label>
                          <input type="text" placeholder="Search keywords e.g. web design" />
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="job-field">
                          <label>All specialisms</label>
                          <select data-placeholder="Filter by specialisms e.g. developer, designer" class="chosen-city">
                            <option>Banking</option>
                            <option>Estate</option>
                            <option>Retail</option>
                            <option>Agency</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="job-field">
                          <div class="job-field">
                            <label>All Locations</label>
                            <select data-placeholder="Filter by specialisms e.g. developer, designer" class="chosen-city">
                              <option>New York</option>
                              <option>Istanbul</option>
                              <option>London</option>
                              <option>Russia</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit"><i class="la la-search"></i> FIND JOB</button>
                      </div>
                    </div>
                  </form>
                </div><!-- Job Search 2 -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="scroll-here">
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading">
            <h2>Popular Categories</h2>
          </div><!-- Heading -->
          <div class="cat-sec">
            <div class="row no-gape">
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="p-category">
                  <a href="#" title="">
                    <i class="la la-bullhorn"></i>
                    <span>Design, Art & Multimedia</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="p-category">
                  <a href="#" title="">
                    <i class="la la-graduation-cap"></i>
                    <span>Education Training</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="p-category">
                  <a href="#" title="">
                    <i class="la la-line-chart "></i>
                    <span>Accounting / Finance</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="p-category">
                  <a href="#" title="">
                    <i class="la la-users"></i>
                    <span>Human Resource</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="cat-sec">
            <div class="row no-gape">
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="p-category">
                  <a href="#" title="">
                    <i class="la la-phone"></i>
                    <span>Telecommunications</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="p-category">
                  <a href="#" title="">
                    <i class="la la-cutlery"></i>
                    <span>Restaurant / Food Service</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="p-category">
                  <a href="#" title="">
                    <i class="la la-building"></i>
                    <span>Construction / Facilities</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="p-category">
                  <a href="#" title="">
                    <i class="la la-user-md"></i>
                    <span>Health</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="browse-all-cat">
            <a href="#" title="">Browse All Categories</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="block double-gap-top double-gap-bottom">
    <div data-velocity="-.1" style="background: url(images/resource/parallax1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div><!-- PARALLAX BACKGROUND IMAGE -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="simple-text-block">
            <h3>Make a Difference with Your Online Resume!</h3>
            <span>Your resume in minutes with JobHunt resume assistant is ready!</span>
            <a href="#" title="">Create an Account</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading">
            <h2>Featured Jobs</h2>
            <span>Leading Employers already using job and talent.</span>
          </div><!-- Heading -->
          <div class="job-listings-sec">
            <div class="job-listing">
              <div class="job-title-sec">
                <div class="c-logo"> <img src="images/resource/mb3.jpg" alt="" /> </div>
                <h3><a href="#" title="">Web Designer / Developer</a></h3>
                <span>Company</span>
              </div>
              <span class="job-lctn"><i class="la la-map-marker"></i>Location</span>
              <span class="job-is ft">FULL TIME</span>
            </div><!-- Job -->
          </div>
        </div>
        <div class="col-lg-12">
          <div class="browse-all-cat">
            <a href="#" title="">Load more listings</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="block no-padding">
    <div class="container fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="simple-text">
            <h3>Gat a question?</h3>
            <span>We're here to help. Check out our FAQs, send us an email or call us at 1 (800) 555-5555</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Auth-->
<div class="account-popup-area signin-popup-box">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
		<h3>User Login</h3>
		<span>Click To Login With Demo User</span>
		<div class="select-user">
			<span>Candidate</span>
			<span>Employer</span>
		</div>
		<form>
			<div class="cfield">
				<input type="text" placeholder="Username" />
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input type="password" placeholder="********" />
				<i class="la la-key"></i>
			</div>
			<p class="remember-label">
				<input type="checkbox" name="cb" id="cb1"><label for="cb1">Remember me</label>
			</p>
			<a href="#" title="">Forgot Password?</a>
			<button type="submit">Login</button>
		</form>
		<div class="extra-login">
			<span>Or</span>
			<div class="login-social">
				<a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
				<a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</div>
</div><!-- LOGIN POPUP -->

<div class="account-popup-area signup-popup-box">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
		<h3>Sign Up</h3>
		<div class="select-user">
			<span>Candidate</span>
			<span>Employer</span>
		</div>
		<form>
			<div class="cfield">
				<input type="text" placeholder="Username" />
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input type="password" placeholder="********" />
				<i class="la la-key"></i>
			</div>
			<div class="cfield">
				<input type="text" placeholder="Email" />
				<i class="la la-envelope-o"></i>
			</div>
			<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen">
					<option>Web Development</option>
					<option>Web Designing</option>
					<option>Art & Culture</option>
					<option>Reading & Writing</option>
				</select>
			</div>
			<div class="cfield">
				<input type="text" placeholder="Phone Number" />
				<i class="la la-phone"></i>
			</div>
			<button type="submit">Signup</button>
		</form>
		<div class="extra-login">
			<span>Or</span>
			<div class="login-social">
				<a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
				<a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</div>
</div><!-- SIGNUP POPUP -->
@endsection
