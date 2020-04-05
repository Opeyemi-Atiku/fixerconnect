@extends('layouts.layouts')


@section('title', 'Accepted Projects')
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
        <div class="col-lg-9 column">
          <div class="padding-left">
            <div class="manage-jobs-sec">
                <h3>
                      <a><div class="post-job-btn" id="post_job">Post Job</div></a>
                </h3>
              <table class="pkges-table" id="project">
                <thead>
                  <tr>
                    <td>Accepted Project</td>
                    <td>Trade Type</td>
                    <td>Budget Range</td>
                    <td>Address</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $account = lcfirst($account);
                  ?>
                  @if(count($job) > 0)
                  @foreach($job as $jb)
                  <tr>
                    <td>
                      <div class="table-list-title">
                        <h3><a href="/job/{{$account}}/{{$jb->id}}" title=""><i class="la la-paper-plane"></i>{{$jb->title}}</a></h3>
                      </div>
                    </td>
                    <td>
                      <span><a href="/job/{{$account}}/{{$jb->id}}" title="">{{$jb->trade_name}}</a></span>
                    </td>
                    <td>
                      <span><a href="/job/{{$account}}/{{$jb->id}}" title="">${{$jb->budget_from}} - ${{$jb->budget_to}}</a></span>
                    </td>
                    <td>
                      <span><a href="/job/{{$account}}/{{$jb->id}}" title="">{{$jb->address}}</a></span>
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>
                      <span>No Job Found</span>
                    </td>
                    <td>
                      <div class="table-list-title">
                        <h3><a href="#" title=""></a></h3>
                      </div>
                    </td>
                    <td>
                      <span></span>
                    </td>
                    <td>
                      <span></span>
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
              <div class="row" id="project_navigation">
                <div class="col-lg-6 col-sm-6 col-md-6">
                  @if($job->currentPage() > 1)
                  <a href="{{$job->previousPageUrl()}}">
                    <span class="job-is ft">previous</span>
                  </a>
                  @endif
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6">
                  @if($job->currentPage() != $job->lastPage() && $job->lastPage() != 0)
                  <a href="{{$job->nextPageUrl()}}">
                    <span class="job-is ft">next</span>
                  </a>
                  @endif
                </div>
              </div>
            </div>
                <div id="post_step" class="profile-title">
  					 			<div class="steps-sec">
  					 				<div id="information_step" class="step active">
  					 					<p><i class="la la-info"></i></p>
  					 					<span>Information</span>
  					 				</div>
  					 				<div id="processing_step" class="step">
  					 					<p><i class="la la-upload"></i></p>
  					 					<span>Processing</span>
  					 				</div>
  					 				<div id="done_step" class="step">
  					 					<p><i class="la  la-check-circle"></i></p>
  					 					<span>Done</span>
  					 				</div>
  					 			</div>
  					 		</div>
                <div id="post">
  					 		<div class="profile-form-edit">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6">
                      <span class="pf-title" id="job_title_">Job Title</span>
                      <div class="pf-field">
                        <input type="text" id="job_title" name="job_title" placeholder="Title" />
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6">
                      <div class="dropdown-field">
                        <span class="pf-title" id="trade_type_">Trade</span>
                        <div class="pf-field">
                          <select id="trade_type" name="trade_type" data-placeholder="Please Select Trade Type" class="chosen">
                            <option selected disabled>Type Of Business</option>
                            @foreach($tradeList as $trade)
                            <option value={{$trade->id}}>{{$trade->trade_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                        <div class="col-lg-4 col-sm-4 col-md-4">
                          <span class="pf-title" id="budget_from_">Budget Range</span>
                          <div class="pf-field">
                            <input type="number" id="budget_from" name="budget_from" placeholder="From" required/>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4">
                          <span class="pf-title" id="budget_to_"></span>
                          <div class="pf-field">
                            <input type="number" id="budget_to" name="budget_to" placeholder="To" required/>
                          </div>
                        </div>
                    <div class="col-lg-12">
                      <span class="pf-title" id="job_description_">Description</span>
                      <div class="pf-field">
                        <textarea name="job_description" id="job_description"></textarea>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="uploadbox">
                        <label for="file-upload" class="custom-file-upload">
                            <i class="la la-cloud-upload"></i> <span id="job_media_">Upload Media</span>
                        </label>
                        <input id="file-upload" name="job_media" type="file" style="display: none;" />
                      </div>
                    </div>
                  </div>
  					 		</div>
  					 		<div class="contact-edit">
                  <div class="row">
                    <div class="col-lg-6  col-sm-6 col-md-6">
                      <span class="pf-title" id="job_address_">Find On Map</span>
                      <div class="pf-field">
                        <input type="text" name="job_address"  id="job_address" placeholder="Enter address" />
                      </div>
                    </div>
                    <div class="col-lg-6  col-sm-6 col-md-6">
                      <span class="pf-title">Street Number</span>
                      <div class="pf-field">
                        <input type="text" placeholder="Enter street number" />
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <a id="search_location" title="" class="srch-lctn">Search Location</a>
                    </div>
                    <div class="col-lg-12">
                      <span class="pf-title">Maps</span>
                      <div class="pf-map" id="map">
                        <div id="googleMap" style="width: 100%; height: 250px;"></div>
                      </div>
                      </div>
                      <div class="col-lg-12">
                      <div class="container" id="loading_map">
                        <div class="row" id="loadings1">
                          <div class="col-md-2"></div>
                          <div class="col-md-6">
                            <img src="{{URL::asset('images/loaders.gif')}}" alt="" />
                          </div>
                          <div class="col-md-4"></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <button id="upload" type="submit">Upload</button>
                    </div>
                  </div>
  					 		</div>
                </div>
            </div>
          </div>
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
        <!--App-->

       </div>
    </div>
  </div>
</section>
<script>
var showMap = 1;
var latitude, longitude, addressFound;
var account = "<?php echo lcfirst($account);?>";
var location_redirect ="/pending/"+account;
</script>
<script src="{{URL::asset('js/apps/upload_project.js')}}"></script>
<script src="{{URL::asset('js/apps/map.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/apps/update_file_name.js')}}" type="text/javascript"></script>
@endsection
