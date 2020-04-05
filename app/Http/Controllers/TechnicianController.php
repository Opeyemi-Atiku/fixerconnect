<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\TechnicianInfo;
use App\ResidentialInfo;
use App\CommercialInfo;
use App\Job;
use App\JobLocation;
use App\JobApplicant;
use App\Balance;
use App\Transaction;
use App\TransactionType;
use App\Subscriber;
use App\SubscribePlan;
use Carbon\Carbon;
use App\TechnicianReview;
use App\TechnicianTradeList;

class TechnicianController extends Controller
{

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function register()
  {
    return view('source_file.Dashboard.Employee.Registration.registration');  
  }
  
  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function register_()
  {
    return view('source_file.Dashboard.Employee.Registration.registration');  
  }
  
  
  

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function list(Request $request)
  {
      $latitude = $request->input('latitude');
      $latitude = $request->input('longitude');
      $trade_id = $request->input('trade_');
  }





  /**
   * Display a listing of the resource.
   * technician dashboard
   *
   * @return \Illuminate\Http\Response
   */
  public function dashboard()
  {
    return view('source_file.Dashboard.Employee.dashboard');
  }

  /**
   * Display a listing of the resource.
   * technician profile
   *
   * @return \Illuminate\Http\Response
   */
  public function profile()
  {
    $review = TechnicianReview::where('user_id', '=', Auth::id())->orderBy('id', 'DESC')->paginate(10);
    $schedule = DB::table('schedule')->where('user_id', Auth::id())->first();
    if(count($review) > 0){
      foreach ($review as $view) {
        $job = Job::find($view->job_id);
        if($job){
          $view->title = $job->title;
          $user = User::find($job->user_id);
          $view->name = $user->name;
          $account = $user->account_type;
          $view->company_id = $job->user_id;

          $trade = TechnicianTradeList::find($job->trade_id);
          $view->trade_name = $trade->trade_name;
          $view->address = $job->address;

          switch ($account) {
            case 2:
              $residential_infos = ResidentialInfo::where('user_id', '=', $job->user_id)->first();
              $view->profile_image = $residential_infos->profile_image;
              break;
            case 3:
              $commercial_infos = CommercialInfo::where('user_id', '=', $job->user_id)->first();
              $view->profile_image = $commercial_infos->profile_image;
              break;
          }
        }
      }
    }
    return view('source_file.Dashboard.Employee.Personal_Details.profile')->with('review', $review)->with('schedule', $schedule);
  }

  /**
   * Display a listing of the resource.
   * technician edit
   *
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {
    return view('source_file.Dashboard.Employee.Personal_Details.edit_profile');
  }

  /**
   * Display a listing of the resource.
   * technician forgot password
   *
   * @return \Illuminate\Http\Response
   */
  public function forgot()
  {
    return view('source_file.Dashboard.Employee.Personal_Details.forget_password');
  }

  /**
   * Display a listing of the resource.
   * technician settings
   *
   * @return \Illuminate\Http\Response
   */
  public function settings()
  {
    return view('source_file.Dashboard.Employee.Personal_Details.settings');
  }

  /**
   * Display a listing of the resource.
   * technician invoices
   *
   * @return \Illuminate\Http\Response
   */
  public function invoices()
  {
    $transactions = Transaction::where('user_id', '=', Auth::id())->paginate(10);
    foreach($transactions as $transaction){
      if($transaction->customer_id != 0){
        $customer = User::find($transaction->customer_id);
        $transaction->customer_name = $customer->name;
      }else{
        $transaction->customer_name = "Fixer connect";
      }

      $transaction_type = TransactionType::find($transaction->transaction_id);
      $transaction->transaction_type = $transaction_type->transaction_type;
    }
    return view('source_file.Dashboard.Employee.Subscription.invoice')->with('transactions', $transactions);
  }

  /**
   * Display a listing of the resource.
   * technician upgrade
   *
   * @return \Illuminate\Http\Response
   */
  public function upgrade()
  {
    $checkLast = Carbon::now();
    $plan = Subscriber::where('user_id', '=', Auth::id())->orderBy('id', 'DESC')->first();
    if($plan){
      $check_updated = $plan->updated_at;
      $check_month = $checkLast->diffInMOnths($check_updated);
      if($check_month == 1){
        $plan_name = "No Active Subscription";
        $status__ = 1;
      }elseif($check_month == 0){
        $subscribe_plan = SubscribePlan::find($plan->plan);
        $plan_name = $subscribe_plan->name;
        $status__ = 2;
      }
    }else{
      $plan_name = "No Active Subscription";
      $status__ = 1;
    }
    return view('source_file.Dashboard.Employee.Subscription.upgrade')->with('plan_name', $plan_name)->with('status__', $status__);
  }

  /**
   * Display a listing of the resource.
   * technician search
   *
   * @return \Illuminate\Http\Response
   */
  public function search()
  {
    $id = Auth::id();
    $user = User::find($id);
    $technician = TechnicianInfo::where('user_id', '=', $id)->first();
    if($technician->trade_type != ''){
        $jobs = Job::where('trade_id', '=', $technician->trade_type)
    ->leftJoin('technician_trade_lists', 'technician_trade_lists.id', '=', 'jobs.trade_id')
    ->select('jobs.*', 'technician_trade_lists.trade_name')
    ->orderBy('id', 'DESC')
    ->paginate(10);
    }else{
        $jobs = Job::leftJoin('technician_trade_lists', 'technician_trade_lists.id', '=', 'jobs.trade_id')
    ->select('jobs.*', 'technician_trade_lists.trade_name')
    ->orderBy('id', 'DESC')
    ->paginate(10);
    }
    

    foreach ($jobs as $job) {
      $check_user = User::find($job->user_id);
      $job->name = $check_user->name;
      $check_user_type = $check_user->account_type;
      switch ($check_user_type) {
        case 2:
         $residential = ResidentialInfo::where('user_id', '=', $job->user_id)->first();
         if($residential){
           $job->profile_image = $residential->profile_image;
         }else{
           $job->profile_image = 'profile_image.png';
         }

         $job->account_type_name = 'residential';
          break;
        case 3:
         $commercial = CommercialInfo::where('user_id', '=', $job->user_id)->first();
         if($residential){
           $job->profile_image = $residential->profile_image;
         }else{
           $job->profile_image = 'profile_image.png';
         }
         $job->account_type_name = 'commercial';
          break;
      }
    }
    return view('source_file.Dashboard.Employee.search')->with('jobs', $jobs);
  }

  /**
   * Display a listing of the resource.
   * technician bidding
   *
   * @return \Illuminate\Http\Response
   */
  public function bidding()
  {
    $job_applicant = JobApplicant::where('user_id', '=', Auth::id())->paginate(10);
    foreach ($job_applicant as $applicant) {
      $job = Job::find($applicant->job_id);
      $applicant->title = $job->title;
      $user = User::find($job->user_id);
      $applicant->name = $user->name;
      $applicant->company_id = $user->id;
      //$job = JobApplicant::where('job_id', '=', $applicant->job_id)->where('status', '=', 2)->get();
      /*if(count($job) > 0){
        $applicant->status_ = 'Taken';
      }else{
        $applicant->status_ = 'Pending';
      }*/
      switch ($applicant->status) {
        case 1:
          $applicant->status_ = 'Pending';
          break;
        case 2:
          $applicant->status_ = 'Hired';
          break;
        case 3:
          $applicant->status_ = 'Waiting';
          break;
        case 4:
          $applicant->status_ = 'Paid';
          break;
        case 5:
          $applicant->status_ = 'Decline';
          break;
        case 6:
          $applicant->status_ = 'Invitation';
      }
    }

    return view('source_file.Dashboard.Employee.bidding')->with('job_applicant', $job_applicant);
  }

  /**
   * Display a listing of the resource.
   * technician bidding
   *
   * @return \Illuminate\Http\Response
   */
  public function bid(Request $request)
  {
    $price = $request->price;
    $job_id = $request->job_id;

    if($price != '' || $job_id != ''){
      $job_applicant = JobApplicant::where('user_id', '=', Auth::id())->where('job_id', '=', $job_id)->get();
      if(count($job_applicant) > 0 && count($job_applicant) == 1){
        $update_applicant = JobApplicant::where('job_id', '=', $job_id)->update([
          'bid_price' => $price
        ]);
        if($update_applicant){
          return 'save';
        }else{
          return 'error';
        }
      }elseif(count($job_applicant) == 0){
        $new_applicant = new JobApplicant;
        $new_applicant->user_id  = Auth::id();
        $new_applicant->job_id = $job_id;
        $new_applicant->bid_price = $price;
        $save = $new_applicant->save();
        if($save){
          return 'save';
        }else{
          return 'error';
        }
      }
    }else{
      return 'error';
    }
  }

  /**
   * Display a listing of the resource.
   * technician sent
   *
   * @return \Illuminate\Http\Response
   */
  public function acceptOffer($job_id)
  {
    $job = Job::where('id', '=', $job_id)->get();
    $user_id = Auth::id();

    if(count($job) == 1){
      Job::where('id', '=', $job_id)->update([
        'status' => 2
      ]);
      $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->get();

      if(count($job_applicants) == 1){
        if($job_applicants[0]->status == 6 || $job_applicants[0]->status == 2){
          JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->update([
            'status' => 3
          ]);
        }        
        return redirect()->back();
      }else{
        return redirect()->back();
      }
    }else{
      return redirect()->back();
    }
  }

  /**
   * Display a listing of the resource.
   * technician sent
   *
   * @return \Illuminate\Http\Response
   */
  public function declineOffer($job_id)
  {
    $job = Job::where('id', '=', $job_id)->get();
    $user_id = Auth::id();

    if(count($job) == 1){
      Job::where('id', '=', $job_id)->update([
        'status' => 1
      ]);
      $job_applicants = JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->where('status', '=', 2)->get();

      if(count($job_applicants) == 1){
        JobApplicant::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->where('status', '=', 2)->update([
          'status' => 5
        ]);
        return redirect()->back();
      }else{
        return redirect()->back();
      }
    }else{
      return redirect()->back();
    }
  }  

  /**
   * Display a listing of the resource.
   * technician accept
   *
   * @return \Illuminate\Http\Response
   */
  public function accept_invitation(Request $request)
  {
    $this->validate($request, [
      'id' => 'required',
      'price' => 'required'
    ]);

    $job_applicant_id = $request->input('id');
    $job_applicant__ = JobApplicant::find($job_applicant_id);
    $job_ = $job_applicant__->job_id;

    $price = $request->input('price');
    $job = Job::find($job_);
    $user_id = Auth::id();

    if($job){
      Job::where('id', '=', $job_)->update([
        'status' => 1
      ]);

      $job_applicants = JobApplicant::where('job_id', '=', $job_)->where('user_id', '=', $user_id)->where('status', '=', 6)->get();
      

      if(count($job_applicants) == 1){
        JobApplicant::where('job_id', '=', $job_)->where('user_id', '=', $user_id)->where('status', '=', 6)->update([
          'status' => 3,
          'bid_price' => $price
        ]);
        return redirect()->back();
      }else{
        return redirect()->back();
      }
    }else{
      return redirect()->back();
    }

    
  }

  /**
   * Display a listing of the resource.
   * technician inbox
   *
   * @return \Illuminate\Http\Response
   */
  /*public function inbox()
  {
    return view('source_file.Dashboard.Employee.Message.inbox');
  }*/

  /**
   * Display a listing of the resource.
   * technician sent
   *
   * @return \Illuminate\Http\Response
   */
  /*public function sent()
  {
    return view('source_file.Dashboard.Employee.Message.sent');
  }*/

  /**
   * Display a listing of the resource.
   * technician deleted
   *
   * @return \Illuminate\Http\Response
   */
  /*public function deleted()
  {
    return view('source_file.Dashboard.Employee.Message.deleted');
  }*/

  /**
   * Display a listing of the resource.
   * technician review
   *
   * @return \Illuminate\Http\Response
   */
  public function review()
  {
    $review = TechnicianReview::where('user_id', '=', Auth::id())->orderBy('id', 'DESC')->paginate(10);
    
    if(count($review) > 0){
      foreach ($review as $view) {
        $job = Job::find($view->job_id);
        if($job){
          $view->title = $job->title;
          $user = User::find($job->user_id);
          $view->name = $user->name;
          $account = $user->account_type;
          $view->company_id = $job->user_id;

          $trade = TechnicianTradeList::find($job->trade_id);
          $view->trade_name = $trade->trade_name;
          $view->address = $job->address;

          switch ($account) {
            case 2:
              $residential_infos = ResidentialInfo::where('user_id', '=', $job->user_id)->first();
              $view->profile_image = $residential_infos->profile_image;
              break;
            case 3:
              $commercial_infos = CommercialInfo::where('user_id', '=', $job->user_id)->first();
              $view->profile_image = $commercial_infos->profile_image;
              break;
          }
        }
      }
    }
    return view('source_file.Dashboard.Employee.reviews')->with('review', $review);
  }

  /**
   * Display a listing of the resource.
   * technician faq
   *
   * @return \Illuminate\Http\Response
   */
  public function faq()
  {
    return view('source_file.Dashboard.Employee.help_faq');
  }

}
