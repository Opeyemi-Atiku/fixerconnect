@extends('layouts.layouts')

@section('title', 'Transaction')
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
              <h3>Balance: ${{$check_balance->balance}}</h3>


                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <a class="post-job-btn" id="transaction_">History</a>
                      <a class="post-job-btn" id="withdraw_">Withdraw</a>
                      <a class="post-job-btn" id="top_up_">Top Up</a>
                    </div>
                    @if(session('status'))
                    <br/>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <a class="post-job-btn" id="status__">{{session('status')}} <i class="fa fa-thumbs-up"></i></a>
                    </div>
                    <br/>
                    @endif
              <table class="pkges-table" id="transaction">
                <thead>
                  <tr>
                    <td>Transaction</td>
                    <td>From</td>
                    <td>To</td>
                    <td>Amount</td>
                    <td>Time</td>
                  </tr>
                </thead>
                <tbody>
                  @if(count($transactions) > 0)
                  @foreach($transactions as $transaction)
                  <tr>
                    <td>
                      <div class="table-list-title">
                        <h3><a title="">{{$transaction->transaction_type}}</a></h3>
                      </div>
                    </td>
                    <td>
                      <span><a title="">{{Auth::user()->name}}</a></span>
                    </td>
                    <td>
                      <span><a title=""></a>{{$transaction->customer_name}}</span>
                    </td>
                    <td>
                      <span><a href="" title="">${{$transaction->amount}}</a></span>
                    </td>
                    <td>
                      <span><a href="" title="">{{$transaction->created_at->diffForHumans()}}</a></span>
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>
                      <div class="table-list-title">
                        <h3><a title="">No transaction</a></h3>
                      </div>
                    </td>
                    <td>
                      <span><a title=""></a></span>
                    </td>
                    <td>
                      <span><a title=""></a></span>
                    </td>
                    <td>
                      <span><a title=""></a></span>
                    </td>
                    <td>
                      <span><a title=""></a></span>
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
              .
              <div class="row" id="project_navigation">
                <div class="col-lg-6 col-sm-6 col-md-6">
                  @if($transactions->currentPage() > 1)
                  <a href="{{$transactions->previousPageUrl()}}">
                    <span class="transactions-is ft">previous</span>
                  </a>
                  @endif
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6">
                  @if($transactions->currentPage() != $transactions->lastPage() && $transactions->lastPage() != 0)
                  <a href="{{$transactions->nextPageUrl()}}">
                    <span class="transactions-is ft">next</span>
                  </a>
                  @endif
                </div>
              </div>

              <div id="top_up">
                <br/><br/>
                <div class="profile-form-edit">
                  <form method="post" id="payout_form" action="/transaction/pay_with_paypal">
                    {{ csrf_field() }}
                    <input type="hidden" name="action_" value='1' />
                    <div class="row">
                      <div class="col-lg-4 col-sm-4 col-md-4">
                        <select name="" id="" data-placeholder="Please Select Specialism" class="chosen">
                          <option>$</option>
                        </select>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="pf-field">
                          <input type="number" id="payout amount" name="payout amount" placeholder="Enter Amount" value=""/>
                          @if($errors->has('payout_amount'))
                            <span style="color: #B22222; float: right">
                              {{$errors->first('payout_amount')}}
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <a id="payout" class="post-job-btn" style="float: right;"><i class="la la-paypal"></i>Pay With Paypal</a>

                      </div>
                    </div>
                  </form>
                  .<hr/>
                  <form method="post" id="top_form" action="/transaction/top_stripe">
                    {{ csrf_field() }}
                    <input type="hidden" name="action_" value='1' />
                    <input type="hidden" name="action" value="Top Up" />
                    <div class="row">
                      <div class="col-lg-4 col-sm-4 col-md-4">
                        <select name="" id="" data-placeholder="Please Select Specialism" class="chosen">
                          <option>$</option>
                        </select>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="pf-field">
                          <input type="number" id="payout amount" name="payout amount" placeholder="Enter Amount" value=""/>
                          @if($errors->has('payout_amount_'))
                            <span style="color: #B22222; float: right">
                              {{$errors->first('payout_amount_')}}
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <a id="top_up__" class="post-job-btn" style="float: right;">Pay With Stripe</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div id="withdraw">
                <br/><br/>
                <div class="profile-form-edit">
                  <form method="post" id="withdraw_form" action="/transaction/withdraw">
                    {{ csrf_field() }}
                    <input type="hidden" name="action_" value='2' />
                    <div class="row">
                      <div class="col-lg-4 col-sm-4 col-md-4">
                        <select name="" id="" data-placeholder="Please Select Specialism" class="chosen">
                          <option>$</option>
                        </select>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="pf-field">
                          <input type="number" id="withdraw_amount" name="withdraw_amount" placeholder="Enter Amount"/>
                            @if($errors->has('withdraw_amount'))
                              <span style="color: #B22222; float: right">
                                {{$errors->first('withdraw_amount')}}
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="pf-field">
                          <input type="email" id="withdraw_email" name="withdraw_email" placeholder="Enter Receiver Paypal E-mail"/>
                          @if($errors->has('withdraw_email'))
                            <span style="color: #B22222; float: right">
                              {{$errors->first('withdraw_email')}}
                            </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <a id="withdrawout" class="post-job-btn" style="float: right;"><i class="la la-paypal"></i>Withdraw To Paypal</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
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
          </div>
        </div>
        <!--App-->

       </div>
    </div>
  </div>
</section>

<script>
var action = <?php if(old('action_') !== null){if(old('action_') == 1){ echo 1; }elseif(old('action_') == 2){echo 2;}}else{ echo 3; }?>;
$(function(){
  if(action == 1){
    $('#top_up').show();
    $('#withdraw').hide();
    $('#loading').hide();
    $('#transaction').hide();
  }else if(action == 2){
    $('#top_up').hide();
    $('#withdraw').show();
    $('#loading').hide();
    $('#transaction').hide();
  }else if(action == 3){
    $('#top_up').hide();
    $('#withdraw').hide();
    $('#loading').hide();
    $('#transaction').show();
  }


  $('#top_up_').click(function(){
    $('#top_up').hide();
    $('#withdraw').hide();
    $('#loading').show();
    $('#transaction').hide();

    setTimeout(function(){
      $('#top_up').show();
      $('#withdraw').hide();
      $('#loading').hide();
      $('#transaction').hide();
    }, 600);
  });

  $('#withdraw_').click(function(){
    $('#top_up').hide();
    $('#withdraw').hide();
    $('#loading').show();
    $('#transaction').hide();

    setTimeout(function(){
      $('#top_up').hide();
      $('#withdraw').show();
      $('#loading').hide();
      $('#transaction').hide();
    }, 600);
  });

  $('#transaction_').click(function(){
    $('#top_up').hide();
    $('#withdraw').hide();
    $('#loading').show();
    $('#transaction').hide();

    setTimeout(function(){
      $('#top_up').hide();
      $('#withdraw').hide();
      $('#loading').hide();
      $('#transaction').show();
    }, 600);
  });

  $('#withdrawout').click(function(){
    $('#withdraw_form').submit();
  });
  $('#payout').click(function(){
    $('#payout_form').submit();
  });

  $('#top_up__').click(function(){
    $('#top_form').submit();
  });

  setTimeout(function(){
    $('#status__').hide('slow');
  }, 5000);

});
</script>
@endsection
