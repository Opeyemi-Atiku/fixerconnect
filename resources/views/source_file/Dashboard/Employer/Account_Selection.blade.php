@extends('layouts.layouts')

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
              <h3>Set Account</h3>
              <div class="change-password">
                <form class="needs-validation" method="Post" action="{{url('/set_account_type')}}">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-lg-6">
                      <span class="pf-title">Choose Account</span>
                      @if($errors->has('email'))
                        <span style="color: #B22222; float: right">
                          {{$errors->first('email')}}
                        </span>
                      @endif
                      @if(session('error'))
                        <span style="color: #B22222; float: right">
                          {{session('error')}}
                        </span>
                      @endif
                      <div class="pf-field">
                        <select data-placeholder="Please Select Specialism" class="chosen" name="account">
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
        </div>
        <!--App-->

       </div>
    </div>
  </div>
</section>
@endsection
