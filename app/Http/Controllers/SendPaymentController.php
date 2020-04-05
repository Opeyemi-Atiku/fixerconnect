<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;
use App\SubscribePlan;
use App\User;
use App\Subscriber;
use App\Transaction as Transactions;
use App\TransactionType;

class SendPaymentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function __construct()
  {
      /* PayPal api context */
      $paypal_conf = \Config::get('paypal');
      $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
      $this->_api_context->setConfig($paypal_conf['settings']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal(Request $request)
      {

        $this->validate($request, [
          'amount' => 'required|numeric',
        ]);

        $input = array_except($request->all(), array('_token'));
        // dd($request->get('amount'))

        //payment method
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        //item to be paid for
        $item_1 = new Item();
        $item_1->setName('item')->setCurrency('USD')->setQuantity(1)->setPrice($request->input('amount'));
        //item list to be paid
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        //amount to be paid for
        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($request->input('amount'));
        //transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($item_list)->setDescription('Account Top Up');
        //after payment where to redirect to
        $redirect_urls = new RedirectUrls();
        //return after payment
        $redirect_urls->setReturnUrl(URL::route("status_subscribe"))->setCancelUrl(URL::route("status_subscribe"));
        //after payment
        $payment = new Payment();
        $payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions(array($transaction));
        // dd($payment->create($this->api_context));exit
        //after payment
        try{
          $payment->create($this->_api_context);
        }catch(\PayPal\Exception\PayPalConnectionException $ex){
          if(\Config::get('app.debug')){

            \Session::put('error', 'connection timeout');
            return redirect()->back()->with('status', 'connection time out');
          }
          else
          {
            Session::put('error', 'Some error occured');
            return redirect()->back()->with('status', 'some error occured');
          }
        }

        foreach($payment->getLinks() as $link){
          if($link->getRel() == 'approval_url')
          {
            $redirect_url = $link->getHref();
            break;
          }

          //Session::put('error', 'UnKnown Error Occured');
          //return Redirect::route('Payment')->with('status', 'UnKnown Error Occureds');
        }
        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)){
          return Redirect::away($redirect_url);
        }
        Session::put('error', 'UnKnown Error Occured');
        return redirect()->back()->with('status', 'UnKnown Error Occured');
      }

    //payment status
    public function getPaymentStatus()
    {
        //where to return to
        $payment_id = Session::get('paypal_payment_id');
        //where to redirect after payment
        Session::forget('paypal_payment_id');
        if(empty(Input::get('PayerID')) || empty(Input::get('token')))
        {
          //notificationMsg('error', 'Payment Failed');
          return redirect()->back()->with('status', 'Payment failed');
        }
        $payment =Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);

        if($result->getState() == 'approved')
        {

          $paypalTransaction = $result->getTransactions()[0];
          $paypalAmountObj = $paypalTransaction->getAmount();
          $totalAmountPaid = $paypalAmountObj->getTotal();

          $payer_id = Auth::id();

          $plan = SubscribePlan::where('amount', '=', $totalAmountPaid)->get();

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
            $transaction_update->amount = $totalAmountPaid;
            $transaction_update->save();

          }else{
            return redirect()->back()->with('status', 'Internal Server Error');
          }



          return redirect()->back()->with('status', 'Subscription Successful');
        }
        //Session::put('error', 'Payment Failed');
        return redirect()->back()->with('status', 'Transaction Failed');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
