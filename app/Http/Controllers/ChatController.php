<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\ResidentialInfo;
use App\TechnicianInfo;
use App\CommercialInfo;
use App\TechnicianTradeList;
use App\Job;
use App\JobLocation;
use App\JobApplicant;
use App\Chat;
use App\ChatList;
use App\NewChat;
use App\Balance;
use App\Transaction;
use App\TransactionType;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     * view new message
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $job_id = $request->job_id;

        return $this->findMessage($user_id, $job_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inboxMessage(Request $request)
    {
        $user_id = $request->user_id;

        return $this->findInboxMessage($user_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = $request->message;
        $job_id = $request->job_id;
        $receiver_id = $request->user_id;

        $chat = new Chat;
        $chat->sender_id = Auth::id();
        $chat->receiver_id = $receiver_id;
        $chat->message =$message;
        $chat->job_id = $job_id;
        $chat->read = 1;
        $save_chat = $chat->save();

        $contact_list_check = ChatList::where('contact_id', '=', $receiver_id)->where('owner_id', '=', Auth::id())->get();
        $auth_user = Auth::id();

        if(count($contact_list_check) > 0 || count($contact_list_check) == 1){
          ChatList::where('contact_id', '=', $receiver_id)->where('owner_id', '=', Auth::id())->update([
            'message' => $message
          ]);
          ChatList::where('owner_id', '=', $receiver_id)->where('contact_id', '=', Auth::id())->update([
            'message' => $message
          ]);
        }else if(count($contact_list_check) == 0){
          $recent_contact = new ChatList;
          $recent_contact->owner_id = Auth::id();
          $recent_contact->contact_id = $receiver_id;
          $recent_contact->message = $message;
          $recent_contact->job_id = $job_id;
          $recent_contact->save();
        }

        if($save_chat){
          return $this->findMessage($receiver_id, $job_id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findMessage($user_id, $job_id)
    {
      $find_receiver = User::find($user_id);
      $auth_user = Auth::id();

      switch ($find_receiver->account_type) {
        case 2:
          $find_receiver_ = ResidentialInfo::where('user_id', '=', $user_id)->first();
          $find_receiver->profile_image = $find_receiver_->profile_image;
          $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $auth_user)->get();
          if(count($job_applicants) == 1){
            $job_applicant = $job_applicants[0];
            $find_receiver->price = $job_applicant->bid_price;
            $find_receiver->status = -1;
          }else{
            $find_receiver->price = 0;
            $find_receiver->status = -1;
          }
          break;
        case 3:
          $find_receiver_ = CommercialInfo::where('user_id', '=', $user_id)->first();
          $find_receiver->profile_image = $find_receiver_->profile_image;
          $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $auth_user)->get();
          if(count($job_applicants) == 1){
            $job_applicant = $job_applicants[0];
            $find_receiver->price = $job_applicant->bid_price;
            $find_receiver->status = -1;
          }else{
            $find_receiver->price = 0;
            $find_receiver->status = -1;
          }
          break;
        case 1:
          $find_receiver_ = TechnicianInfo::where('user_id', '=', $user_id)->first();
          $find_receiver->profile_image = $find_receiver_->profile_image;
          $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->get();
          if(count($job_applicants) == 1){
            $job_applicant = $job_applicants[0];
            $find_receiver->price = $job_applicant->bid_price;
            $find_receiver->status = $job_applicant->status;
          }else{
            $find_receiver->price = 0;
            $find_receiver->status = 1;
          }
          break;
      }


      $find_messages = Chat::where(function ($query) use($auth_user, $user_id){
        $query->where('receiver_id', '=', $auth_user)->orWhere('receiver_id', '=', $user_id);
      })->where(function ($query) use($auth_user, $user_id){
        $query->where('sender_id', '=', $auth_user)->orWhere('sender_id', '=', $user_id);
      })->where('job_id', '=', $job_id)->orderBy('updated_at', 'DESC')->get();

      foreach ($find_messages as $find_message) {
        $find_message->last_seen = $find_message->created_at->diffForHumans();
      }


      $result = [$find_receiver, $find_messages];

      return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findInboxMessage($user_id)
    {
      $find_receiver = User::find($user_id);
      $auth_user = Auth::id();

      switch ($find_receiver->account_type) {
        case 2:
          $find_receiver_ = ResidentialInfo::where('user_id', '=', $user_id)->first();
          $find_receiver->profile_image = $find_receiver_->profile_image;
          break;
        case 3:
          $find_receiver_ = CommercialInfo::where('user_id', '=', $user_id)->first();
          $find_receiver->profile_image = $find_receiver_->profile_image;
          break;
      }

      $find_messages = Chat::where(function ($query) use($auth_user, $user_id){
        $query->where('receiver_id', '=', $auth_user)->orWhere('receiver_id', '=', $user_id);
      })->where(function ($query) use($auth_user, $user_id){
        $query->where('sender_id', '=', $auth_user)->orWhere('sender_id', '=', $user_id);
      })->orderBy('updated_at', 'DESC')->get();

      foreach ($find_messages as $find_message) {
        $find_message->last_seen = $find_message->created_at->diffForHumans();
      }


      $result = [$find_receiver, $find_messages];

      return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      $contacts = ChatList::where('owner_id', Auth::id())->orderBy('updated_at', 'DESC')->get();
      $job_id = $request->job_id;

      if(count($contacts) >= 1){
        foreach ($contacts as $contact){
          $id = $contact->contact_id;
          $user = User::find($id);
          $contact->name = $user->name;


          switch ($user->account_type) {
            case 3:

            $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', Auth::id())->get();
            if(count($job_applicants) == 1){
              $job_applicant = $job_applicants[0];
              $contact->price = $job_applicant->bid_price;
            }else{
              $contact->price = 0;
            }

              $find_contact_ = CommercialInfo::where('user_id', '=', $id)->first();
              if($find_contact_){
                $contact->profile_image = $find_contact_->profile_image;
              }else{
                $contact->profile_image = "profile_image.png";
              }
              break;
            case 2:

            $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', Auth::id())->get();
            if(count($job_applicants) == 1){
              $job_applicant = $job_applicants[0];
              $contact->price = $job_applicant->bid_price;
            }else{
              $contact->price = 0;
            }

              $find_contact_ = ResidentialInfo::where('user_id', '=', $id)->first();
              if($find_contact_){
                $contact->profile_image = $find_contact_->profile_image;
              }else{
                $contact->profile_image = "profile_image.png";
              }
              break;
            case 1:

            $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $contact->contact_id)->get();
            if(count($job_applicants) == 1){
              $job_applicant = $job_applicants[0];
              $contact->price = $job_applicant->bid_price;
            }else{
              $contact->price = 0;
            }

              $find_contact_ = TechnicianInfo::where('user_id', '=', $id)->first();
              if($find_contact_){
                $contact->profile_image = $find_contact_->profile_image;
              }else{
                $contact->profile_image = "profile_image.png";
              }
              break;
          }
        }
      }

      return $contacts;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showInbox()
    {
      $contacts = ChatList::where('contact_id', Auth::id())->orderBy('updated_at', 'DESC')->get();

      if(count($contacts) >= 1){
        foreach ($contacts as $contact){
          $id = $contact->contact_id;
          if($id == Auth::id()){
            $id = $contact->owner_id;
          }
          $user = User::find($id);
          $contact->name = $user->name;

          switch ($user->account_type) {
            case 2:
              $find_contact_ = ResidentialInfo::where('user_id', '=', $id)->first();
              if($find_contact_){
                $contact->profile_image = $find_contact_->profile_image;
              }else{
                $contact->profile_image = "profile_image.png";
              }
              $contact->contact_user_id = $id;
              break;
            case 3:
              $find_contact_ = CommercialInfo::where('user_id', '=', $id)->first();
              if($find_contact_){
                $contact->profile_image = $find_contact_->profile_image;
              }else{
                $contact->profile_image = "profile_image.png";
              }
              $contact->contact_user_id = $id;
              break;
          }
        }
      }

      return $contacts;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $message = $request->message;
      $job_id = $request->job_id;
      $receiver_id = $request->user_id;

      $chat = new Chat;
      $chat->sender_id = Auth::id();
      $chat->receiver_id = $receiver_id;
      $chat->message =$message;
      $chat->job_id = $job_id;
      $chat->read = 1;
      $save_chat = $chat->save();

      $contact_list_check = ChatList::where('contact_id', '=', $receiver_id)->where('owner_id', '=', Auth::id())->get();

      if(count($contact_list_check) > 0 && count($contact_list_check) == 1){
        ChatList::where('contact_id', '=', $receiver_id)->where('owner_id', '=', Auth::id())->update([
          'message' => $message
        ]);
      }else if(count($contact_list_check) == 0){
        $recent_contact = new ChatList;
        $recent_contact->owner_id = Auth::id();
        $recent_contact->contact_id = $receiver_id;
        $recent_contact->message = $message;
        $recent_contact->job_id = $job_id;
        $recent_contact->save();
      }

      if($save_chat){
        return $this->findInboxMessage($receiver_id);
      }
    }

    /**
     * Display a listing of the resource.
     * view new message
     *
     * @return \Illuminate\Http\Response
     */
    public function hired(Request $request)
    {
        $user_id = $request->user_id;
        $job_id = $request->job_id;

        $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->get();
        if(count($job_applicants) == 1){
          $job_applicant = $job_applicants[0];
          $status = $job_applicant->status;
          if($status == 2){
            return 2;
          }
          switch ($status) {
            case 1:
            JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->update([
              'status' => 2
            ]);
            return 2;
              break;
            case 3:
            $release_payment = $this->release_payment($job_id, $user_id);

            if($release_payment == 'sent'){
              JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->update([
                'status' => 4
              ]);
              return 4;
            }else{
              return $release_payment;
            }
              break;
            case 4:
            JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->update([
              'status' => 4
            ]);
            return 4;
              break;
            case 5:
            JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->update([
              'status' => 5
            ]);
            return 5;
            break;
          }
        }else{
          return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function release_payment($job_id, $user_id)
    {
        $job_applicant = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->first();
        $amount = $job_applicant->bid_price;
        $from_user = Auth::id();
        $to_user = $user_id;

        $balanceUpdate = Balance::where('user_id', '=', $from_user)->first();
        if($balanceUpdate->balance == $amount || $balanceUpdate->balance > $amount){
          DB::beginTransaction();
          try{
            $balanceUpdate_from = Balance::where('user_id', '=', $from_user)->first();
            $balanceUpdate_to = Balance::where('user_id', '=', $to_user)->first();

            $balance_from = $balanceUpdate_from->balance - $amount;
            $balance_to = $balanceUpdate_to->balance + $amount;

            DB::table('balances')->where('user_id', '=', $from_user)->update([
              'balance' => $balance_from
            ]);

            DB::table('balances')->where('user_id', '=', $to_user)->update([
              'balance' => $balance_to
            ]);

            $transaction_list = TransactionType::get();

            $transaction_update_from = new Transaction;
            $transaction_update_from->user_id = $from_user;
            $transaction_update_from->customer_id = $to_user;
            $transaction_update_from->transaction_id = $transaction_list[2]->id;
            $transaction_update_from->amount = $amount;
            $transaction_update_from->save();

            $transaction_update_to = new Transaction;
            $transaction_update_to->user_id = $to_user;
            $transaction_update_to->customer_id = $from_user;
            $transaction_update_to->transaction_id = $transaction_list[0]->id;
            $transaction_update_to->amount = $amount;
            $transaction_update_to->save();

            DB::commit();
            return 'sent';

          }catch(\Throwable $e){
            DB::rollback();
            return 'error';
        }
      }else{
        return 'low';
      }
    }
}
