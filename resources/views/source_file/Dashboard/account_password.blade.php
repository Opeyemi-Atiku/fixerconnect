@extends('layouts.layouts')


@section('title', 'Set Password')
@section('content')

<!--Title-->
@include('source_file.Dashboard.Employer.inc.title_bar')
<!--Title-->

<section>
  <div class="block no-padding">
    <div class="container">
      <!--App-->
      <div class="padding-left">
        <div class="manage-jobs-sec">
          <h3>Set Account</h3>
          <div class="change-password">
            <form class="needs-validation" method="Post" action="{{url('/set_account_password')}}">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-lg-6">
                  <span class="pf-title">
                    Enter Password
                    @if($errors->has('password'))
                      <span style="color: #B22222; float: right">
                        {{$errors->first('password')}}
                      </span>
                    @endif
                  </span>
                  <div class="pf-field">
                    <input id="passowrd" type="password" name="password" placeholder="******" required/>
                  </div>
                  <span class="pf-title">Confirm Password</span>
                  <div class="pf-field">
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="******" required/>
                  </div>
                  <span class="pf-title">
                    Choose Account
                    @if(session('error'))
                      <span style="color: #B22222; float: right">
                        {{session('error')}}
                      </span>
                    @endif
                  </span>
                  <div class="pf-field">
                    <select data-placeholder="Please Select Specialism" class="chosen" name="account">
                      <option value="1">Technician</option>
                      <option value="2">Residential</option>
                      <option value="3">Commercial</option>
                    </select>
                  </div>
                  <button type="submit">Update</button>
                </div>
                <div class="col-lg-6">
                  <i class="la la-user big-icon"></i>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--App-->
    </div>
  </div>
</section>
@endsection
