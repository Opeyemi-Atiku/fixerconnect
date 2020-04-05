<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SubscribePlan;
use App\User;
use App\Subscriber;
use App\Balance;
use App\Transaction as Transactions;
use App\TotalBalance;
use App\TransactionType;
use Stripe;
use Session;

class StripePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function top(Request $request)
    {
      $this->validate($request, [
        'payout_amount' => 'required',
        'action_' => 'required',
        'action' => 'required',
      ]);
      $amount = $request->input('payout_amount');
      $action = $request->input('action');
      return view('source_file.Dashboard.stripe')->with('action', $action)->with('amount', $amount);
    }

    public function index(Request $request)
    {
      $this->validate($request, [
        'amount' => 'required',
        'action' => 'required'
      ]);
      $amount = $request->input('amount');
      $action = $request->input('action');
      return view('source_file.Dashboard.stripe')->with('action', $action)->with('amount', $amount);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function top_(Request $request)
    {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      Stripe\Charge::create ([
              "amount" => $request->input('stripe_amount_') * 100,
              "currency" => "usd",
              "source" => $request->stripeToken,
              "description" => "Subscription."
      ]);

      $payer_id = Auth::id();
      $check_user = Auth::user()->account_type;
      $totalAmountPaid = $request->input('stripe_amount_');

      $balanceUpdate = Balance::where('user_id', '=', $payer_id)->get();

      if(count($balanceUpdate) != 0){
        $userBalance = $balanceUpdate[0]->balance;
        $newBalance = $userBalance + $totalAmountPaid;
        $balancePayment = Balance::where('user_id', '=', $payer_id)->update([
          'balance' => $newBalance
        ]);
      }else{
        $balance_user = new Balance;
        $balance_user->balance = $totalAmountPaid;
        $balance_user->user_id = $payer_id;
        $balance_user->account_type = $check_user->account_type;
        $balance_user->save();
      }


      $balanceAdmin = TotalBalance::first();
      $balance_admin = $balanceAdmin->total_balance;
      $amount_admin = $totalAmountPaid + $balance_admin;
      $balanceUpdate = TotalBalance::where('id', '=', $balanceAdmin->id)->update([
        'total_balance' => $amount_admin
      ]);

      $transaction_list = TransactionType::get();

      $transaction_update = new Transactions;
      $transaction_update->user_id = $payer_id;
      $transaction_update->customer_id = 0;
      $transaction_update->transaction_id = $transaction_list[0]->id;
      $transaction_update->amount = $totalAmountPaid;
      $transaction_update->save();

      Session::flash('status', 'Payment successful!');

      switch ($check_user) {
        case 2:
          return redirect('/transaction/residential');
          break;
        case 3:
          return redirect('/transaction/commercial');
          break;
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      Stripe\Charge::create ([
              "amount" => 10 * 100,
              "currency" => "usd",
              "source" => $request->stripeToken,
              "description" => "Subscription."
      ]);

      $payer_id = Auth::id();

      $plan = SubscribePlan::where('amount', '=', 10)->get();

      if(count($plan) == 1){
        $subscriber = new Subscriber;
        $subscriber->user_id = $payer_id;
        $subscriber->plan = $plan[0]->id;
        $subscriber->save();

        $transaction_list = TransactionType::get();

        $transaction_update = new Transactions;
        $transaction_update->user_id = $payer_id;
        $transaction_update->customer_id = 0;
        $transaction_update->transaction_id = $transaction_list[3]->id;
        $transaction_update->amount = 10;
        $transaction_update->save();
      }

      Session::flash('status', 'Payment successful!');

      return redirect('/upgrade/technician');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
