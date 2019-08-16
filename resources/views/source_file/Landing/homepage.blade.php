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

<section>
  <div class="block gray double-gap-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading">
            <h2>Popular Categories</h2>
            <span>37 jobs live - 0 added today.</span>
          </div><!-- Heading -->
          <div class="cat-sec style2">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="p-category style2">
                  <a href="#" title="">
                    <i class="la la-bullhorn"></i>
                    <span>Design, Art & Multimedia</span>
                    <p>(22 open positions)</p>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="p-category style2">
                  <a href="#" title="">
                    <i class="la la-graduation-cap"></i>
                    <span>Education Training</span>
                    <p>(6 open positions)</p>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="p-category style2">
                  <a href="#" title="">
                    <i class="la la-line-chart "></i>
                    <span>Accounting / Finance</span>
                    <p>(3 open positions)</p>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="p-category style2">
                  <a href="#" title="">
                    <i class="la la-users"></i>
                    <span>Human Resource</span>
                    <p>(3 open positions)</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="browse-all-cat">
            <a href="#" title="" class="style2 noradius">Browse All Categories</a>
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
          <div class="tab-sec">
            <ul class="nav nav-tabs">
              <li><a class="current" data-tab="fjobs">Featured Jobs</a></li>
              <li><a data-tab="rjobs">Recent Jobs</a></li>
            </ul>
            <div id="fjobs" class="tab-content current">
              <div class="job-listings-tabs">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l1.png" alt="" /> </div>
                        <h3><a href="#" title="">Web Designer / Developer</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is ft fill">Full time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l2.png" alt="" /> </div>
                        <h3><a href="#" title="">C Developer (Senior) C .Net</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is pt fill">Part time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l3.png" alt="" /> </div>
                        <h3><a href="#" title="">Regional Sales Manager South</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is ft fill">Full time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                  </div>
                  <div class="col-lg-6">
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l4.png" alt="" /> </div>
                        <h3><a href="#" title="">Marketing Dairector</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is ft fill">Full time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l5.png" alt="" /> </div>
                        <h3><a href="#" title="">Application Developer</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is pt fill">Part time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l6.png" alt="" /> </div>
                        <h3><a href="#" title="">Social Media and Public</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is fl fill">Freelance</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                  </div>
                </div>
              </div>
            </div>
            <div id="rjobs" class="tab-content">
              <div class="job-listings-tabs">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l4.png" alt="" /> </div>
                        <h3><a href="#" title="">Marketing Dairector</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is ft fill">Full time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l5.png" alt="" /> </div>
                        <h3><a href="#" title="">Application Developer</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is pt fill">Part time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l6.png" alt="" /> </div>
                        <h3><a href="#" title="">Social Media and Public</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is fl fill">Freelance</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                  </div>
                  <div class="col-lg-6">
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l1.png" alt="" /> </div>
                        <h3><a href="#" title="">Web Designer / Developer</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is ft fill">Full time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l2.png" alt="" /> </div>
                        <h3><a href="#" title="">C Developer (Senior) C .Net</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is pt fill">Part time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                    <div class="job-listing wtabs">
                      <div class="job-title-sec">
                        <div class="c-logo"> <img src="images/resource/l3.png" alt="" /> </div>
                        <h3><a href="#" title="">Regional Sales Manager South</a></h3>
                        <span>Massimo Artemisis</span>
                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
                      </div>
                      <div class="job-style-bx">
                        <span class="job-is ft fill">Full time</span>
                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                      </div>
                    </div><!-- Job -->
                  </div>
                </div>
              </div>
            </div>
            <div class="browse-all-cat">
              <a href="#" title="" class="style2">Load more listings</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="block no-padding">
    <div data-velocity="-.2" style="background: url(images/resource/parallax7.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible"></div><!-- PARALLAX BACKGROUND IMAGE -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="download-sec">
            <div class="download-text">
              <h3>Download & Enjoy</h3>
              <p>Search, find and apply for jobs directly on your mobile device or desktop Manage all of the jobs you have applied to from a convenience secure dashboard.</p>
              <ul>
                <li>
                  <a href="#" title="">
                    <i class="la la-apple"></i>
                    <span>App Store</span>
                    <p>Available now on the</p>
                  </a>
                </li>
                <li>
                  <a href="#" title="">
                    <i class="la la-android"></i>
                    <span>Google Play</span>
                    <p>Get in on</p>
                  </a>
                </li>
              </ul>
            </div>
            <div class="download-img">
              <img src="images/resource/mockup3.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="block gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading">
            <h2>Featured Candidates</h2>
            <span>Every single one of our jobs has some kind of flexibility option</span>
          </div><!-- Heading -->
          <div class="team-sec">
            <div class="row" id="team-carousel">
              <div class="col-lg-3">
                <div class="team">
                  <div class="team-img"><img src="images/resource/t1.jpg" alt="" /></div>
                  <div class="team-detail">
                    <h3><a href="#" title="">Amanda Cook</a></h3>
                    <span>I Knew You Were Trouble</span>
                    <p>The Random Name Generator is a simple fiction writing tool…</p>
                    <a href="#" title="">View Resume <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div><!-- Team -->
              </div>
              <div class="col-lg-3">
                <div class="team">
                  <div class="team-img"><img src="images/resource/t2.jpg" alt="" /></div>
                  <div class="team-detail">
                    <h3><a href="#" title="">İbrahim Agay</a></h3>
                    <span>Developer</span>
                    <p>The Random Name Generator is a simple fiction writing tool…</p>
                    <a href="#" title="">View Resume <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div><!-- Team -->
              </div>
              <div class="col-lg-3">
                <div class="team">
                  <div class="team-img"><img src="images/resource/t3.jpg" alt="" /></div>
                  <div class="team-detail">
                    <h3><a href="#" title="">Ali Tufan</a></h3>
                    <span>Senior UI / UX Designer</span>
                    <p>The Random Name Generator is a simple fiction writing tool…</p>
                    <a href="#" title="">View Resume <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div><!-- Team -->
              </div>
              <div class="col-lg-3">
                <div class="team">
                  <div class="team-img"><img src="images/resource/t4.jpg" alt="" /></div>
                  <div class="team-detail">
                    <h3><a href="#" title="">Juan Suso</a></h3>
                    <span>IT Outsource Company</span>
                    <p>The Random Name Generator is a simple fiction writing tool…</p>
                    <a href="#" title="">View Resume <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div><!-- Team -->
              </div>
              <div class="col-lg-3">
                <div class="team">
                  <div class="team-img"><img src="images/resource/t2.jpg" alt="" /></div>
                  <div class="team-detail">
                    <h3><a href="#" title="">Senimae Zuis</a></h3>
                    <span>Web Designer</span>
                    <p>The Random Name Generator is a simple fiction writing tool…</p>
                    <a href="#" title="">View Resume <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div><!-- Team -->
              </div>
            </div>
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
            <h2>Companies We've Helped</h2>
            <span>Some of the companies we've helped recruit excellent applicants over the years.</span>
          </div><!-- Heading -->
          <div class="comp-sec">
            <div class="company-img">
              <a href="#" title=""><img src="images/resource/cc1.jpg" alt="" /></a>
            </div><!-- Client  -->
            <div class="company-img">
              <a href="#" title=""><img src="images/resource/cc2.jpg" alt="" /></a>
            </div><!-- Client  -->
            <div class="company-img">
              <a href="#" title=""><img src="images/resource/cc3.jpg" alt="" /></a>
            </div><!-- Client  -->
            <div class="company-img">
              <a href="#" title=""><img src="images/resource/cc4.jpg" alt="" /></a>
            </div><!-- Client  -->
            <div class="company-img">
              <a href="#" title=""><img src="images/resource/cc5.jpg" alt="" /></a>
            </div><!-- Client  -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="block gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading">
            <h2>Quick Career Tips</h2>
            <span>Found by employers communicate directly with hiring managers and recruiters.</span>
          </div><!-- Heading -->
          <div class="blog-sec">
            <div class="row">
              <div class="col-lg-4">
                <div class="my-blog">
                  <div class="blog-thumb">
                    <a href="#" title=""><img src="images/resource/b1.jpg" alt="" /></a>
                    <div class="blog-metas">
                      <a href="#" title="">March 29, 2017</a>
                      <a href="#" title="">0 Comments</a>
                    </div>
                  </div>
                  <div class="blog-details">
                    <h3><a href="#" title="">Attract More Attention Sales And Profits</a></h3>
                    <p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
                    <a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="my-blog">
                  <div class="blog-thumb">
                    <a href="#" title=""><img src="images/resource/b2.jpg" alt="" /></a>
                    <div class="blog-metas">
                      <a href="#" title="">March 29, 2017</a>
                      <a href="#" title="">0 Comments</a>
                    </div>
                  </div>
                  <div class="blog-details">
                    <h3><a href="#" title="">11 Tips to Help You Get New Clients</a></h3>
                    <p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
                    <a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="my-blog">
                  <div class="blog-thumb">
                    <a href="#" title=""><img src="images/resource/b3.jpg" alt="" /></a>
                    <div class="blog-metas">
                      <a href="#" title="">March 29, 2017</a>
                      <a href="#" title="">0 Comments</a>
                    </div>
                  </div>
                  <div class="blog-details">
                    <h3><a href="#" title="">An Overworked Newspaper Editor</a></h3>
                    <p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
                    <a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
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
            <h2>How It Works</h2>
            <span>Each month, more than 7 million Jobhunt turn to website in their search for work, making over <br />160,000 applications every day.
            </span>
          </div><!-- Heading -->
          <div class="how-to-sec style2 no-lines">
            <div class="how-to">
              <span class="how-icon"><i class="la la-user"></i></span>
              <h3>Register an account</h3>
              <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-file-archive-o"></i></span>
              <h3>Specify & search your job</h3>
              <p>Browse profiles, reviews, and proposals then interview top candidates. </p>
            </div>
            <div class="how-to">
              <span class="how-icon"><i class="la la-list"></i></span>
              <h3>Apply for job</h3>
              <p>Use the Upwork platform to chat, share files, and collaborate from your desktop or on the go.</p>
            </div>
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
