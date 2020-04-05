<aside class="col-lg-3 column border-right">
  @if(Request::is('dashboard/residential') || Request::is('dashboard/commercial'))
  <h4><a id="dashboard"><i class="la la-sitemap"></i> Dashboard</a></h4>
  @else
  <h4><a href="/dashboard/{{lcfirst($account)}}" id="dashboard"><i class="la la-sitemap"></i> Dashboard</a></h4>
  @endif
  <div class="widget">
    <?php
    $business = "closed";
    $project = "closed";
    $message = "closed";
    $account = lcfirst($account);
    if(Request::is("edit/$account") || Request::is("change_password/$account") || Request::is("settings/$account")){
      $business = "active";
    }
    if(Request::is("accepted/$account") || Request::is("pending/$account") || Request::is("transaction/$account") || Request::is("browse_technician/$account")){
      $project = "active";
    }
    if(Request::is("inbox/$account") || Request::is("sent/$account") || Request::is("deleted/$account")){
      $message = "active";
    }
    ?>
    <h5 id="business" class="sb-title {{$business}}"><i class="la la-briefcase"></i> Business Details</h5>
    <div class="specialism_widget">
      <div class="simple-checkbox">
        <p><a href="/profile/{{lcfirst($account)}}"><i class="la la-user"></i> Profile Summary</a></p>
        <p><a href="/edit/{{lcfirst($account)}}"><i class="la la-user-plus"></i> Edit Profile</a></p>
        <p><a href="/change_password/{{lcfirst($account)}}"><i class="la la-plug"></i> Forgotten Password Retrieval</a></p>
        <!--<p><a href=""><i class="la la-cogs"></i> Settings</a></p>-->
      </div>
    </div>
  </div>
  <div class="widget">
    <h5 id="project" class="sb-title {{$project}}"><i class="la la-dashboard"></i> Projects</h5>
    <div class="specialism_widget">
      <div class="simple-checkbox">
        <p><a href="/accepted/{{lcfirst($account)}}"><i class="la la-toggle-on"></i> Accepted Projects</a></p>
        <p><a href="/pending/{{lcfirst($account)}}"><i class="la la-spinner"></i> Pending Projects</a></p>
        <p><a href="/transaction/{{lcfirst($account)}}"><i class="la la-money"></i> Transaction</a></p>
        <p><a href="/browse_technician/{{lcfirst($account)}}"><i class="la la-user"></i> Browswe Technician</a></p>
      </div>
    </div>
  </div>
  <!--<div class="widget">
    <h5 id="message" class="sb-title {{$message}}"><i class="la la-comments"></i> Messages</h5>
    <div class="specialism_widget">
      <div class="simple-checkbox">
        <p><a href="/inbox/{{lcfirst($account)}}"><i class="la la-download"></i> Inbox</a></p>
        <p><a href="/sent/{{lcfirst($account)}}"><i class="la la-upload"></i> Sent</a></p>
        <p><a href="/deleted/{{lcfirst($account)}}"><i class="la la-close"></i> Deleted Items</a></p>
      </div>
    </div>
  </div>-->
  <!--<div class="widget">
    <h6 class=""><a href="/review/{{lcfirst($account)}}"><i class="la la-comment"></i> Reviews</a></h6>
  </div>-->
  <div class="widget">
    <h6 class=""><a href="/faq/{{lcfirst($account)}}"><i class="la la-question"></i> Help & FAQ's</a></h6>
  </div>
</aside>
