<div class="responsive-header">
  <div class="responsive-menubar">
    <div class="res-logo"><a href="#" title=""><img src="" alt="" /></a></div>
    <div class="menu-resaction">
      <div class="res-openmenu">
        <img src="{{URL::asset('images/icon.png')}}" alt="" /> Menu
      </div>
      <div class="res-closemenu">
        <img src="{{URL::asset('images/icon2.png')}}" alt="" /> Close
      </div>
    </div>
  </div>
  <div class="responsive-opensec">
    <div class="btn-extars">
      @if(Auth::guard()->check() == false)
      <a href="/user/login" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
      @else
      @if(Auth::user()->account_type == 1)
      <div class="my-profiles-sec" style="float:left;">
					<span id="mobile_profile"><img src="{{URL::asset('images/resource/mp1.jpg')}}" alt="" /></span>
			</div>

      @else
      <a href="/" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
      @endif
      @endif
      <ul class="account-btns">
        @if(Auth::guard()->check() == false)
        <li><a href="/user/register" title=""><i class="la la-key"></i> Sign Up</a></li>
        <li><a href="/user/login" title=""><i class="la la-external-link-square"></i> Login</a></li>
        @else
        <li><a href="/logout"><i class="la la-unlink"></i>Logout</a></li>
        @endif
      </ul>
    </div><!-- Btn Extras -->
    <div class="responsivemenu">
      <ul>
          <li class="menu-item">
            <a href="/" title="">Home</a>
          </li>
          @if(Auth::guard()->check() == true)
          <li class="menu-item">
            <a href="/redirect_dashboard" title="">Dashboard</a>
          </li>
          @endif
          <li class="menu-item">
            <a href="/about" title="">About Us</a>
          </li>
          <li class="menu-item">
            <a href="/contact" title="">Contact Us</a>
          </li>
        </ul>
    </div>
  </div>
</div>

<header class="white">
  <div class="topbar">
    <div class="container">
      <ul class="h-social">
        <li><a href="#" title=""><i class="fa fa-facebook"></i></a></li>
        <li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>
        <li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>
        <li><a href="#" title=""><i class="fa fa-pinterest"></i></a></li>
        <li><a href="#" title=""><i class="fa fa-behance"></i></a></li>
      </ul>
      <div class="h-contact">
        <span><i class="la la-phone"></i>Call us 0850 3256 98 65 </span>
        <span><i class="la la-envelope-o"></i><a href="https://grandetest.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="aec7c0c8c1eec4c1ccc6dbc0da80cdc1c3">[email&#160;protected]</a> </span>
      </div>
    </div>
  </div>
  <div class="menu-sec">
    <div class="container">
      <div class="logo">
        <a href="index.html" title=""><img class="hidesticky" src="" alt="" /><img class="showsticky" src="" alt="" /></a>
      </div><!-- Logo -->
      <div class="btn-extars">
        @if(Auth::guard()->check() == false)
        <a href="/user/login" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
        @else
        @if(Auth::user()->account_type == 1)
        <div class="my-profiles-sec" style="float:left;">
  					<span id="desktop_profile"><img style="margin-right: 10px;" src="{{URL::asset('images/resource/mp1.jpg')}}" alt="" /></span>
  			</div>
        @else
        <a href="/" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
        @endif
        @endif
        <ul class="account-btns">
          @if(Auth::guard()->check() == false)
          <li><a href="/user/register" title=""><i class="la la-key"></i> Sign Up</a></li>
          <li><a href="/user/login"><i class="la la-external-link-square"></i> Login</a></li>
          @else
          <li><a href="/logout"><i class="la la-unlink"></i>Logout</a></li>
          @endif
        </ul>
      </div><!-- Btn Extras -->
      <nav>
        <ul>
          <li class="menu-item">
            <a href="/" title="">Home</a>
          </li>
          @if(Auth::guard()->check() == true)
          <li class="menu-item-has">
            <a href="/redirect_dashboard" title="">Dashboard</a>
          </li>
          @endif
          <li class="menu-item">
            <a href="/about" title="">About Us</a>
          </li>
          <li class="menu-item">
            <a href="/contact" title="">Contact Us</a>
          </li>
        </ul>
      </nav><!-- Menus -->
    </div>
  </div>
</header>
<script src="{{URL::asset('js/apps/header.js')}}" type="text/javascript"></script>
