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
              <h3>Transactions</h3>
              <table>
                <thead>
                  <tr>
                    <td>lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <span>221319456</span>
                    </td>
                    <td>
                      <div class="table-list-title">
                        <h3><a href="#" title="">Advertise job - Supper Jobs</a></h3>
                      </div>
                    </td>
                    <td>
                      <span>April 04, 2017</span>
                    </td>
                    <td>
                      <span>Pre Bank Transfer</span>
                    </td>
                    <td>
                      <span class="status active">$99</span>
                    </td>
                    <td>
                      <span>Pending</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!--App-->

       </div>
    </div>
  </div>
</section>
@endsection
