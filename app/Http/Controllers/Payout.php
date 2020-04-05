<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Location;
use App\Book;
use App\ShopCart;
use App\Categories;
use App\Balance;

class Payout extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function CreateSinglePayout(Request $request) {
       if(Auth::guard()->check()->type == 'user'){
         $this->validate($request, [
           'amount' => 'required|numeric',
           'email' => 'required|email'
         ]);
         $id= Auth::id();
         $amount = $request->input('amount');
         $email = $request->input('email');
         $bal = Balance::where('user_id', '=', $id)->get();

         if(count($bal) == 1){
           $balance = $bal[0]->balance;
           $status ='insufficient balance';
           if($amount > $balance){
             return redirect('/withdraw')->with('status', $status);
           }
         }else{
           $status ='insufficient balance';
           return redirect('/withdraw')->with('status', $status);
         }
         // Create a new instance of Payout object
      		$payouts = new \PayPal\Api\Payout();
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
      		$senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();

      		$redirect_urls = new RedirectUrls();
              $redirect_urls->setReturnUrl(URL::route('payout')) /* Specify return URL */
              // $redirect_urls->setReturnUrl(URL::route('status', ['id' => $id])) /* Specify return URL */
                  ->setCancelUrl(URL::route('payout'));

      		// ### NOTE:
      		// You can prevent duplicate batches from being processed. If you specify a `sender_batch_id` that was used in the last 30 days, the batch will not be processed. For items, you can specify a `sender_item_id`. If the value for the `sender_item_id` is a duplicate of a payout item that was processed in the last 30 days, the item will not be processed.
      		// #### Batch Header Instance
      		$senderBatchHeader->setSenderBatchId(uniqid())
      		    ->setEmailSubject("You have a Payout!");
      		// #### Sender Item
      		// Please note that if you are using single payout with sync mode, you can only pass one Item in the request
      		$amount = $request->input('amount');
      		$senderItem = new \PayPal\Api\PayoutItem();
      		$senderItem->setRecipientType('Email')
      		    ->setNote('Thanks for your patronage!')
      		    ->setReceiver($request->input('email'))
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

      			$result = curl_e?xec($s);
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
                  // failed
                  $transaction = [
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
                  Tran::create($transaction);
                  // $this->Transaction->set($transaction);
                  // $this->Transaction->save($transaction);

                  //TODO: send mail to user

                  $email = new Report(new User(['email_token' =>'Sorry, an unexpected error occurred while processing your withdrawal. Your transaction ref is #'.$result["debug_id"].', please try again later.', 'first_name' => Auth::User()->first_name, 'last_name' => Auth::User()->last_name,'img' => 'red', 'role' => 'Error']));
              	$mail = Mail::to(Auth::User()->email)->send($email);

                  // $result = ["errors"=> true, "message"=> "Sorry, an unexpected error occurred while processing your withdrawal. Your transaction ref is #".$result["debug_id"].", please try again later."];
                  return "Sorry, an unexpected error occurred while processing your withdrawal. Your transaction ref is #".$result["debug_id"].", please try again later.";
              }else if(array_key_exists("batch_header", $result)){
                  //success
                  $transaction = [
                      "ref"=> $result["batch_header"]["payout_batch_id"],
                      'user_id' => Auth::User()->id,
                      'amount' => $amount,
                      'total' => $amount,
                      'charge'=> "0",
                      'transaction_type'=> "Withdrawal",
                      'transaction_method'=> "paypal",
                      'status'=> $result["batch_header"]["batch_status"],
                      'description'=> "Submitted for acknowledgement",
                  ];
                  // $balance = floatval($user["wallet"]) - floatval($_POST["amount"]);
                  // $this->User->id = $user["id"];
                  // $this->User->saveField("wallet", $balance);
                  // $this->Transaction->set($transaction);
                  // $this->Transaction->save($transaction);
                  Tran::create($transaction);
                  $pro = User::find(Auth::User()->id);
                  User::where('id', Auth::User()->id)->update([
      	            'wallet' => $pro->wallet - $amount
      	        ]);
                  //TODO: send mail to user
                  $email = new Report(new User(['email_token' =>'Your withdrawal is being processed, you"d receive a mail once fund has been moved into your account.', 'first_name' => Auth::User()->first_name, 'last_name' => Auth::User()->last_name,'img' => 'green', 'role' => 'Suceess']));
              	$mail = Mail::to(Auth::User()->email)->send($email);

                  $result = ["success"=> true, "message"=> "Your withdrawal is being processed, you'd receive a mail once fund has been moved into your account."];
                  return "Your withdrawal is being processed, you'd receive a mail once fund has been moved into your account.";
              }else{
              	$email = new Report(new User(['email_token' =>'Sorry, an unexpected error occurred while processing your withdrawal, please try again later.', 'first_name' => Auth::User()->first_name, 'last_name' => Auth::User()->last_name,'img' => 'green', 'role' => 'Suceess']));
              	$mail = Mail::to(Auth::User()->email)->send($email);

                  $result = ["errors"=> true, "message"=> "Sorry, an unexpected error occurred while processing your withdrawal, please try again later."];
                  return "Sorry, an unexpected error occurred while processing your withdrawal, please try again later.";
              }
       }else{
         return redirect('/login');
       }
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
