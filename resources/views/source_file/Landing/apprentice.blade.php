@extends('layouts.layouts')

@section('title', 'Commercial Request Service')
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



<section class="wow bounceInDown" id="signup_how_it_work">
  <div class="block remove-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="account-popup-area signup-popup-box static">
            <div class="account-popup">
              <h3>Apprenticeship Program</h3>

              <div class="select-user">
                

                @if(session('status'))
                  <span style="">
                    {{session('status')}}
                  </span>
                @endif
              </div>
            <form role="form" method="post" action="{{url('/apprentice')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="profile-form-edit">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="pf-field">
                                @if($errors->has('firstname'))
                                    <span style="color: #B22222; float: right">
                                      required
                                    </span>
                                    @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                                <input type="text" name="firstname" value="{{old('firstname')}}" id="firstname" placeholder="First Name" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="pf-field">
                                @if($errors->has('lastname'))
                                    <span style="color: #B22222; float: right">
                                       required
                                    </span>
                                @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                                <input type="text" value="{{old('lastname')}}" name="lastname" id="lastname" placeholder="Last Name" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                                @if($errors->has('initialname'))
                                    <span style="color: #B22222; float: right">
                                       required
                                    </span>
                                @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                            <div class="pf-field">
                                <input type="text" value="{{old('initialname')}}" name="initialname" id="initialname" placeholder="Initial Name" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                                @if($errors->has('address'))
                                    <span style="color: #B22222; float: right">
                                       required
                                    </span>
                                @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                            <div class="pf-field">
                                <input type="text" value="{{old('address')}}" name="address" id="address" placeholder="Mailing Address" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                                @if($errors->has('city'))
                                    <span style="color: #B22222; float: right">
                                       required
                                    </span>
                                @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                            <div class="pf-field">
                                <input type="text" name="city" value="{{old('city')}}" id="city" placeholder="City" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                                @if($errors->has('zip'))
                                    <span style="color: #B22222; float: right">
                                       required
                                    </span>
                                @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                            <div class="pf-field">
                                <input type="text" value="{{old('city')}}" name="zip" id="zip" placeholder="Zip" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                                @if($errors->has('phone'))
                                    <span style="color: #B22222; float: right">
                                       required
                                    </span>
                                @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                            <div class="pf-field">
                                <input type="text" value="{{old('phone')}}" name="phone" id="phone" placeholder="Phone" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                                @if($errors->has('email'))
                                    <span style="color: #B22222; float: right">
                                       required
                                    </span>
                                @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                            <div class="pf-field">
                                <input type="text" value="{{old('email')}}" name="email" id="email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                                @if($errors->has('studentId'))
                                    <span style="color: #B22222; float: right">
                                       required
                                    </span>
                                @else
                                    <span style="color: #B22222; float: right">
                                        *
                                    </span>
                                @endif
                            <div class="pf-field">
                                <input type="text" value="{{old('studentId')}}" name="studentId" id="studentID" placeholder="Student ID" />
                            </div>
                        </div>
                        <div class="contact-edit">
                            <h3>Education</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if($errors->has('highSchool'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input name="highSchool" value="{{old('highSchool')}}" type="text" id="highSchool" placeholder="High School Name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($errors->has('cityHighSchool'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input name="cityHighSchool" value="{{old('cityHighSchool')}}" type="text" id="city" placeholder="City" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($errors->has('yearHighSchool'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input name="yearHighSchool" value="{{old('yearHighSchool')}}" type="number" id="year" placeholder="Year" />
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        @if($errors->has('institute'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input type="text" value="{{old('institute')}}" name="institute" id="Institution_" placeholder="Name Of Institution" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($errors->has('city_'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input type="text" value="{{old('city_')}}" name="city_" id="city_" placeholder="City/State" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($errors->has('year_'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input type="number" value="{{old('year_')}}" name="year_" id="year_" placeholder="Attendance Dates" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($errors->has('certificate'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="dropdown-field">
                                                <select name="certificate" value="{{old('certificate')}}" data-placeholder="Please Select Gender" class="chosen">
                                                    <option disabled>Gender</option>
                                                    <option value="degree">Degree</option>
                                                    <option value="certificate">Certificate</option>
                                                </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-lg-12">
                                        @if($errors->has('institution'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input type="text" value="{{old('institution')}}" name="institution" id="Institution" placeholder="Name Of Institution 2" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($errors->has('city__'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input type="text" value="{{old('city__')}}" name="city__" id="city__" placeholder="City/State" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($errors->has('year__'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <input type="number" value="{{old('year__')}}" name="year__" id="year__" placeholder="Attendance Dates" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($errors->has('certificates'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                            <div class="dropdown-field">
                                                <select id="gender" name="certificates" value="{{old('certificates')}}" data-placeholder="Please Select Gender" class="chosen">
                                                    <option disabled>Certificate</option>
                                                    <option value="degree">Degree</option>
                                                    <option value="certificate">Certificate</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @if($errors->has('experience'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                          <textarea name="experience" placeholder="Did you participate in any clubs, organization, or other activities that may be pertinent to the committee?">{{old('experience')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="contact-edit">
                                <h3>Career Objective</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if($errors->has('objective'))
                                            <span style="color: #B22222; float: right">
                                               required
                                            </span>
                                        @else
                                            <span style="color: #B22222; float: right">
                                                *
                                            </span>
                                        @endif
                                        <div class="pf-field">
                                            <textarea name="objective" placeholder="What are you plans/goals upon completion of this program?">{{old('objective')}}</textarea>
                                        </div>
                                    </div>                                    
                                </div>
                        </div>
                    </div>
                </div>
                <button type="submit">Submit</button>
            </form>
            </div>
          </div><!-- SIGNUP POPUP -->
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
