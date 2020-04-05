<?php
if(Auth::guard()->check() == true){
  $link = '/redirect_dashboard';
}else{
  $link = '/user/register';
}
?>
<div class="responsive-header">
  <div class="responsive-menubar">
    <div class="res-logo"><a href="/" title=""><img class="logo" src="{{URL::asset('images/resource/logo.png')}}" alt="" /></a></div>
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
      @if(Auth::guard()->check() == true)
      @if(Auth::user()->account_type == 1)
      <!--<div class="my-profiles-sec" style="float:left;">
					<span id="mobile_profile"><img src="{{URL::asset('images/resource/mp1.jpg')}}" style="" alt="" /></span>
			</div>-->
      @endif
      @endif
      <ul class="account-btns">
        @if(Auth::guard()->check() == false)
        <li><a href="/user/register" title="" class="post-job-btn">Sign Up</a></li>
        <li><a href="/user/login" title="" class="post-job-btn">Login</a></li>
        @else
        <li><a href="/redirect_dashboard" class="post-job-btn">Dashboard</a></li>
        <li><a href="/logout" class="post-job-btn">Logout</a></li>
        @endif
      </ul>
    </div><!-- Btn Extras -->
    <div class="responsivemenu">
      <ul>
          <li class="menu-item">
            <a href="/" title="">Home</a>
          </li>
          @if(Auth::guard()->check() == false)
          <li class="menu-item">
            <a href="/register/residential" title="">Residential</a>
          </li>
          <li class="menu-item">
            <a href="/register/commercial" title="">Commercial</a>
          </li>
          <li class="menu-item">
            <a href="/register/technician" title="">Technician</a>
          </li>
          <li class="menu-item">
            <a href="/register/contractor" title="">Local Contractor</a>
          </li>
          @endif
          <li class="menu-item">
            <a href="/apprentice" title="">Apprenticeship Program</a>
          </li>
          <li class="menu-item">
            <a href="/blog" title="">Blog</a>
          </li>
        </ul>
    </div>
  </div>
</div>
<header class="white">
  <div class="menu-sec">
    <div class="container">
      <div class="logo">
        <a href="/" title=""><img class="hidesticky" src="" alt="" /><img class="logo" src="{{URL::asset('images/resource/logo.png')}}" alt="" /></a>
      </div><!-- Logo -->
      <div class="btn-extars">
        @if(Auth::guard()->check() == true)
        @if(Auth::user()->account_type == 1)
        <!-- <div class="my-profiles-sec" style="float:left;">
  					<span id="desktop_profile"><img style="margin-right: 10px;" src="{{URL::asset('images/resource/mp1.jpg')}}" alt="" /></span>
  			</div> -->
        @endif
        @endif
        <ul class="account-btns">
          @if(Auth::guard()->check() == false)
          <li><a href="/user/login" class="post-job-btn">Login</a></li>
          <li><a href="/user/register" class="post-job-btn" title="">Sign Up</a></li>
          @else
          <li><a href="/redirect_dashboard" class="post-job-btn">Dashboard</a></li>
          <li><a href="/logout" class="post-job-btn">Logout</a></li>
          @endif
        </ul>
      </div><!-- Btn Extras -->
      <nav>
        <ul>
          <li class="menu-item">
            <a href="/" title="">Home</a>
          </li>  
          @if(Auth::guard()->check() == false)
          <li class="menu-item">
            <a href="/register/residential" title="">Residential</a>
          </li>
          <li class="menu-item">
            <a href="/register/commercial" title="">Commercial</a>
          </li>
          <li class="menu-item">
            <a href="/register/technician" title="">Technician</a>
          </li>
          <li class="menu-item">
            <a href="/register/contractor" title="">Local Contractor</a>
          </li>
          @endif
          <li class="menu-item">
            <a href="/apprentice" title="">Apprenticeship Program</a>
          </li>
          <li class="menu-item">
            <a href="/blog" title="">Blog</a>
          </li>
        </ul>
      </nav><!-- Menus -->
    </div>
  </div>
</header>
<script src="{{URL::asset('js/apps/header.js')}}" type="text/javascript"></script>
