@extends('layouts.layouts')

@section('title', 'Bidding')
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
              <h3>Bidding and Proposal</h3>
              <table>
                <thead>
                  <tr>
                    <td>Company</td>
                    <td>Title</td>
                    <td>Amount</td>
                    <td>Status</td>
                    <td>Bid At</td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
                  @if(count($job_applicant) > 0)
                  @foreach($job_applicant as $applicant)
                  <tr>
                    <td>
                      <a href="/view_profile/{{$applicant->company_id}}"><span>{{$applicant->name}}</span>
                    </td>
                    <td>
                      <div class="table-list-title">
                        <h3><a href="/job/technician/{{$applicant->job_id}}" title="">{{$applicant->title}}</a></h3>
                      </div>
                    </td>
                    <td>
                      @if($applicant->status != 6)
                      <span>${{$applicant->bid_price}}</span>
                      @endif
                    </td>
                    <td>
                      <span>{{$applicant->status_}}</span>
                    </td>
                    <td>
                      <span>{{$applicant->created_at->diffForHumans()}}</span>
                    </td>
                    <td>
                      @if($applicant->status_ == 'Hired')
                      <a class="post-job-btn" href="/accept_offer_{{$applicant->job_id}}/technician">Accept</a>
                      <a class="post-job-btn" href="/decline_offer_{{$applicant->job_id}}/technician">Decline</a>
                      @elseif($applicant->status_ == 'Pending')
                      <a class="">Pending</a>
                      @elseif($applicant->status_ == 'Waiting')
                      <a class="">Waiting For Payment</a>
                      @elseif($applicant->status_ == 'Paid')
                      <a class="">Paid</a>
                      @elseif($applicant->status_ == 'Decline')
                      <a>Decline</a>
                      @elseif($applicant->status_ == 'Invitation')
                      <a class="post-job-btn signin-popup" id="accept_invitation_" bid_id="{{$applicant->id}}">Accept Invitation</a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>
                      No Bid Yet
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                  </tr>
                  @endif
                </tbody>
                <div class="account-popup-area signin-popup-box" style="position : absolute !important;">
                    <div class="account-popup">
                      <h3 id="name_review"></h3>
                      <span id="review_validation"></span>
                      <span class="close-popup"><a><i class="la la-close"></a></i></span>
                      <form method="post" id="accept_invite" action="/accept_invitation">
                        {{ csrf_field() }}
                        <div class="cfield">
                          <input type="text" id="price_bid" name="price" placeholder="Enter Price" />
                          <input type="hidden" id="bid_id" name="id">        
                        </div>
                        <a class="post-job-btn" id="invite__"><i class="la la-money"></i>Submit Price</a>
                      </form>
                      <script>
                        $(function(){
                          $('#invite__').click(function(){
                            var price = $('input#price_bid').val();
                            if(isNaN(price)){
                              alert("Invalid input");
                            }else{
                              $('#accept_invite').submit();
                            }                            
                          });
                          $('a#accept_invitation_').click(function(){
                            var bid_id = $(this).attr('bid_id');
                            $('input#bid_id').val(bid_id);
                          });
                        });
                      </script>
                    </div>
                  </div>
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
