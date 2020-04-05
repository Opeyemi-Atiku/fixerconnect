@extends('layouts.layouts')

@section('title', 'Reset Password')
@section('content')

<!--Title-->
@include('source_file.Dashboard.Employee.inc.title_bar')
<!--Title-->

<section>
  <div class="block no-padding">
    <div class="container">
       <div class="row no-gape">
         <!--Menu-->
        @include('source_file.Dashboard.Employee.inc.menu_tab')
        <!--Menu-->

        <!--App-->
        <div class="col-lg-9 column">
          <div class="padding-left">
            <div class="manage-jobs-sec">
              <h3>Change Password</h3>
              <div class="change-password">
                <form method="post" action="/update_password">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-lg-6">
                      @if(session('password_status'))
                        <div style="color: #4BB543;">
                          {{session('password_status')}} <i class="fa fa-thumbs-up"></i>
                        </div>
                      @endif
                      <span class="pf-title">Old Password</span>
                      <div class="pf-field">
                        <input type="password" name="Old Password" />
                        @if($errors->has('Old_Password'))
                          <span style="color: #B22222; float: right">
                            {{$errors->first('Old_Password')}}
                          </span>
                        @endif
                        @if(session('old_password_error'))
                          <span style="color: #B22222; float: right">
                            {{session('old_password_error')}}
                          </span>
                        @endif
                      </div>
                      <span class="pf-title">New Password</span>
                      <div class="pf-field">
                        <input type="password" name="New Password" />
                        @if($errors->has('New_Password'))
                          <span style="color: #B22222; float: right">
                            {{$errors->first('New_Password')}}
                          </span>
                        @endif
                      </div>
                      <span class="pf-title">Confirm Password</span>
                      <div class="pf-field">
                        <input type="password" name="Confirm Password" />
                        @if($errors->has('Confirm_Password'))
                          <span style="color: #B22222; float: right">
                            {{$errors->first('Confirm_Password')}}
                          </span>
                        @endif
                      </div>
                      <button type="submit">Update</button>
                    </div>
                    <div class="col-lg-6">
                      <i class="la la-key big-icon"></i>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--App-->

       </div>
    </div>
  </div>
</section>
@endsection
