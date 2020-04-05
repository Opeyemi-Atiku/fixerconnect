<aside class="col-lg-3 column border-right">
  @if(Request::is('dashboard/{{$account}}'))
  <h4><a id="dashboard"><i class="la la-sitemap"></i> Dashboard</a></h4>
  @else
  <h4><a href="/dashboard/{{$account}}" id="dashboard"><i class="la la-sitemap"></i> Dashboard</a></h4>
  @endif
  <div class="widget">
    <?php
    $business = "closed";
    $package = "closed";
    $message = "closed";
    if(Request::is("edit/$account") || Request::is("change_password/$account") || Request::is("settings/$account")){
      $business = "active";
    }
    if(Request::is("invoices/$account") || Request::is("upgrade/$account")){
      $package = "active";
    }
    if(Request::is("inbox/$account") || Request::is("sent/$account") || Request::is("deleted/$account")){
      $message = "active";
    }
    ?>
    <h5 id="business" class="sb-title {{$business}}"><i class="la la-briefcase"></i> Personal Details</h5>
    <div class="specialism_widget">
      <div class="simple-checkbox">
        <p><a href="/profile/{{$account}}"><i class="la la-user"></i> Profile Summary</a></p>
        <p><a href="/edit/{{$account}}"><i class="la la-user-plus"></i> Edit Profile</a></p>
        <p><a href="/change_password/{{$account}}"><i class="la la-plug"></i> Forgotten Password Retrieval</a></p>
        <!--<p><a href=""><i class="la la-cogs"></i> Settings</a></p>-->
      </div>
    </div>
  </div>
  <div class="widget">
    <h5 id="package" class="sb-title {{$package}}"><i class="la la-database"></i> Manage subscription Packages</h5>
    <div class="specialism_widget">
      <div class="simple-checkbox">
        <p><a href="/invoices/{{$account}}"><i class="la la-archive"></i> Payment invoices</a></p>
        <p><a href="/upgrade/{{$account}}"><i class="la la-credit-card"></i> Upgrade Package</a></p>
      </div>
    </div>
  </div>
  <div class="widget">
    <h6 id="search" class=""><a href="/search/{{$account}}"><i class="la la-search"></i> Search Jobs</a></h6>
  </div>
  <div class="widget">
    <h6 id="bidding" class=""><a href="/bidding/{{$account}}"><i class="la la-exchange"></i> Bid and Proposals</a><br/><i class="la la-bullhorn"></i> Inivitation {{$job_invite_count}}</h6>
  </div>
  <!--<div class="widget">
    <h5 id="message" class="sb-title {{$message}}"><i class="la la-comments"></i> Messages</h5>
    <div class="specialism_widget">
      <div class="simple-checkbox">
        <p><a href="/inbox/technician"><i class="la la-download"></i> Inbox</a></p>
        <p><a href="/sent/technician"><i class="la la-upload"></i> Sent</a></p>
        <p><a href="/deleted/technician"><i class="la la-close"></i> Deleted Items</a></p>
      </div>
    </div>
  </div>-->
  <div class="widget">
    <h6 class=""><a href="/review/{{$account}}"><i class="la la-comment"></i> Reviews</a></h6>
  </div>
  <div class="widget">
    <h6 class=""><a href="/faq/{{$account}}"><i class="la la-question"></i> Help & FAQ's</a></h6>
  </div>
</aside>
