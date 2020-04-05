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
use App\User;
use App\Balance;
use App\Transaction as Transactions;
use App\TotalBalance;
use App\TransactionType;

class PaymentController extends Controller
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
          'action_' => 'required',
          'payout_amount' => 'required|numeric',
        ]);

        $input = array_except($request->all(), array('_token'));
        // dd($request->get('amount'))

        //payment method
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        //item to be paid for
        $item_1 = new Item();
        $item_1->setName('item')->setCurrency('USD')->setQuantity(1)->setPrice($request->input('payout_amount'));
        //item list to be paid
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        //amount to be paid for
        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($request->input('payout_amount'));
        //transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($item_list)->setDescription('Account Top Up');
        //after payment where to redirect to
        $redirect_urls = new RedirectUrls();
        //return after payment
        $redirect_urls->setReturnUrl(URL::route("status"))->setCancelUrl(URL::route("status"));
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

          return redirect()->back()->with('status', 'Transaction successful');
        }
        //Session::put('error', 'Payment Failed');
        return redirect()->back()->with('status', 'Transaction Failed');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function CreateSinglePayout(Request $request) {

       $this->validate($request, [
         'action_' => 'required',
         'withdraw_amount' => 'required|numeric',
         'withdraw_email' => 'required|email'
       ]);
       $id= Auth::id();
       $amount = $request->input('withdraw_amount');
       $email = $request->input('withdraw_email');


       $bal = Balance::where('user_id', '=', $id)->get();

       if(count($bal) == 1){
         $balance = $bal[0]->balance;
         $status ='insufficient balance';
         if($amount > $balance){
           return redirect()->back()->with('status', $status);
         }
       }else{
         $status ='insufficient balance';
         return redirect()->back()->with('status', $status);
       }
       // Create a new instance of Payout object
        $payouts = new Payout();
        // This is how our body should look like:
        /*
         * {
                    "sender_batch_header":{
                        "sender_batch_id":"2014021801",
                        "email_subject":"You have a Payout!"
                    },
                    "items":[
                        {
                            "recipient_type":"EMAIL",
                            "amount":{
                                "value":"1.0",
                                "currency":"USD"
                            },
                            "note":"Thanks for your patronage!",
                            "sender_item_id":"2014031400023",
                            "receiver":"shirt-supplier-one@mail.com"
                        }
                    ]
                }
         */
        $senderBatchHeader = new PayoutSenderBatchHeader();

        $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::previous()) /* Specify return URL */
            // $redirect_urls->setReturnUrl(URL::route('status', ['id' => $id])) /* Specify return URL */
                ->setCancelUrl(URL::previous());

        // ### NOTE:
        // You can prevent duplicate batches from being processed. If you specify a `sender_batch_id` that was used in the last 30 days, the batch will not be processed. For items, you can specify a `sender_item_id`. If the value for the `sender_item_id` is a duplicate of a payout item that was processed in the last 30 days, the item will not be processed.
        // #### Batch Header Instance
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");
        // #### Sender Item
        // Please note that if you are using single payout with sync mode, you can only pass one Item in the request
        $amount = $request->input('withdraw_amount');
        $senderItem = new \PayPal\Api\PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver($request->input('withdraw_email'))
            ->setSenderItemId(uniqid())
            ->setAmount(new \PayPal\Api\Currency('{
                                "value":'.$amount.',
                                "currency":"USD"
                            }'));
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);
        // For Sample Purposes Only.
        $request = clone $payouts;
        // ### Create Payout
        try {
           // $output = $payouts->create(null, $this->_api_context);
            $s = curl_init("https://api.sandbox.paypal.com/v1/payments/payouts");

          curl_setopt($s, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payouts");
          curl_setopt($s, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $this->_api_context->getCredential()->getAccessToken(array())));
          curl_setopt($s,CURLOPT_POST,true);
          curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($s, CURLOPT_POSTFIELDS, $payouts->toJSON());

          $result = curl_exec($s);
          $result = json_decode($result,true);
          curl_close($s);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            // ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
            // exit(1);
            return "PayPal Payout GetData:<br>". $ex->getData() . "<br><br>";
            die($ex);
        } catch (Exception $ex) {
          echo "<pre> xxxxxx";
            die($ex);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
         // ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);
        // Session::put('payoutBatch', $output);
        // return Redirect::away(URL::route('payoutStatus'));
        // $pro = User::where('id', $request->id)->first();
        // User::where('id', $request->id2)->update([
      //           'wallet' => $request->amount +
      //       ]);
        // $res = $output->getBatchHeader()->getBatchStatus();
        // if($res == 'PENDING' || $res == 'PROCESSING' || $res == 'SUCCESS') {
        // 	return 'Payment Successful';
        // }
        // else {
        // 	return 'Contact Admin for details.';
        // }
        // return $output->getBatchHeader()->getBatchStatus();
        if (array_key_exists("name", $result)){
                return redirect()->back()->with('status', 'UnKnown error occured');
                /*$transaction = [
                    "ref"=> $result["debug_id"],
                    'user_id' => Auth::User()->id,
                    'amount' => $amount,
                    'total' => $amount,
                    'charge'=> "0",
                    'transaction_type'=> "Withdrawal",
                    'transaction_method'=> "paypal",
                    'status'=> $result["name"],
                    'description'=> $result["message"],
                ];
                Tran::create($transaction);*/
                // $this->Transaction->set($transaction);
                // $this->Transaction->save($transaction);

                //TODO: send mail to user
                //mailing

                //$email = new Report(new User(['email_token' =>'Sorry, an unexpected error occurred while processing your withdrawal. Your transaction ref is #'.$result["debug_id"].', please try again later.', 'first_name' => Auth::User()->first_name, 'last_name' => Auth::User()->last_name,'img' => 'red', 'role' => 'Error']));
              //$mail = Mail::to(Auth::User()->email)->send($email);
              //redirect
                // $result = ["errors"=> true, "message"=> "Sorry, an unexpected error occurred while processing your withdrawal. Your transaction ref is #".$result["debug_id"].", please try again later."];
                //return "Sorry, an unexpected error occurred while processing your withdrawal. Your transaction ref is #".$result["debug_id"].", please try again later.";
            }else if(array_key_exists("batch_header", $result)){

                $transaction_list = TransactionType::get();

                $payer_id = Auth::id();

                //success
                $transaction_update = new Transactions;
                $transaction_update->user_id = $payer_id;
                $transaction_update->customer_id = $payer_id;
                $transaction_update->transaction_id = $transaction_list[1]->id;
                $transaction_update->amount = $amount;
                $transaction_update->save();

                $deduct = Balance::where('user_id', '=', Auth::id())->first();

                $balance = $deduct->balance;
                $bal = $balance - $amount;

                $deduct = Balance::where('user_id', '=', Auth::id())->update([
                  'balance' => $bal
                ]);

                $balanceAdmin = TotalBalance::first();
                $balance = $balanceAdmin->total_balance;
                $bal = $balance - $amount;
                $balanceUpdate = TotalBalance::where('id', '=', $balanceAdmin->id)->update([
                  'total_balance' => $bal
                ]);

                return redirect()->back()->with('status', 'Withdrawal was successful');


                /*$transaction = [
                    "ref"=> $result["batch_header"]["payout_batch_id"],
                    'user_id' => Auth::User()->id,
                    'amount' => $amount,
                    'total' => $amount,
                    'charge'=> "0",
                    'transaction_type'=> "Withdrawal",
                    'transaction_method'=> "paypal",
                    'status'=> $result["batch_header"]["batch_status"],
                    'description'=> "Submitted for acknowledgement",
                ];*/
                // $balance = floatval($user["wallet"]) - floatval($_POST["amount"]);
                // $this->User->id = $user["id"];
                // $this->User->saveField("wallet", $balance);
                // $this->Transaction->set($transaction);
                // $this->Transaction->save($transaction);
                /*Tran::create($transaction);
                $pro = User::where('id', Auth::User()->id)->first();
                User::where('id', Auth::User()->id)->update([
                  'wallet' => $pro->wallet - $amount
              ]);
                //TODO: send mail to user
                $email = new Report(new User(['email_token' =>'Your withdrawal is being processed, you"d receive a mail once fund has been moved into your account.', 'first_name' => Auth::User()->first_name, 'last_name' => Auth::User()->last_name,'img' => 'green', 'role' => 'Suceess']));
              $mail = Mail::to(Auth::User()->email)->send($email);

                $result = ["success"=> true, "message"=> "Your withdrawal is being processed, you'd receive a mail once fund has been moved into your account."];
                return "Your withdrawal is being processed, you'd receive a mail once fund has been moved into your account.";*/
            }else{

              return redirect()->back()->with('status', 'Unknow error occured');
              //unesxpected error occur
              /*$email = new Report(new User(['email_token' =>'Sorry, an unexpected error occurred while processing your withdrawal, please try again later.', 'first_name' => Auth::User()->first_name, 'last_name' => Auth::User()->last_name,'img' => 'green', 'role' => 'Suceess']));
              $mail = Mail::to(Auth::User()->email)->send($email);

                $result = ["errors"=> true, "message"=> "Sorry, an unexpected error occurred while processing your withdrawal, please try again later."];
                return "Sorry, an unexpected error occurred while processing your withdrawal, please try again later.";*/
            }
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
