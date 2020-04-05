@extends('layouts.layouts')

@section('title', 'Project List')
@section('content')
<section>
  <div class="block no-padding  gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner2">
            <div class="inner-title2">
            </div>
            <div class="page-breacrumbs">
              <ul class="breadcrumbs">
                <li><a href="#" title="">Home</a></li>
                <li><a href="#" title="">Project Listing</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="wow bounceInDown" id="signup_how_it_work">
  <div class="block remove-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="account-popup-area signup-popup-box static">
            <div class="account-popup">
              <h3>Project Listing</h3>

              <div class="select-user">
                

                @if(session('status'))
                  <span style="">
                    {{session('status')}}
                  </span>
                @endif
              </div>
              <form role="form" method="post" action="{{url('/project_listing')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!--Residential input-->
                <div class="residential">
                  <!--residential name-->
                  @if($errors->has('name'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('name')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="" name="name" type="text" value="{{old('name')}}" placeholder="Name"  required/>
                    <i class="la la-user"></i>
                  </div>
                  
                  @if($errors->has('description'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('desription')}}
                    </span>
                  @endif
                  <div class="pf-field" style="margin-top: 20px;">
                     <textarea name="description" id="description" placeholder="Describe Project">{{old('description')}}</textarea>
                   </div>
                   
                   @if($errors->has('location'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('location')}}
                    </span>
                  @endif
                   <div class="cfield">
                    <input id="location" name="location" value="{{old('location')}}" type="text" placeholder="Enter Address"  required/>
                    <i class="la la-map-marker"></i>
                  </div>

                  <!--residential email-->
                  @if($errors->has('email'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('email')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="" name="email" type="email" value="{{old('email')}}" placeholder="Email"  required/>
                    <i class="la la-envelope-o"></i>
                  </div>

                  <!--residential phone-->
                  @if($errors->has('contact'))
                    <span style="color: #B22222; float: right">
                      {{$errors->first('contact')}}
                    </span>
                  @endif
                  <div class="cfield">
                    <input id="" name="contact"  value="{{old('contact')}}" type="text" placeholder="Phone Number" required/>
                    <i class="la la-phone"></i>
                  </div>
                  
                  @if($errors->has('attachement'))
                        <span style="color: #B22222; float: right">
                            {{$errors->first('attachement')}}
                        </span>
                @endif
                        
                <div class="uploadbox">
                  <label for="file-upload" class="custom-file-upload">
                    <i class="la la-cloud-upload"></i> <span id="job_media_">Upload Type of Sevice and License</span>
                  </label>
                <input name="attachement" id="file-upload" type="file" style="display: none;" />
                </div>
                </div>
                <!--Residential Input-->
                <button type="submit">Submit</button>
              </form>
            </div>
          </div><!-- SIGNUP POPUP -->
        </div>
      </div>
    </div>
  </div>
</section>


<script src="{{URL::asset('js/apps/update_file_names.js')}}" type="text/javascript"></script>
@endsection
