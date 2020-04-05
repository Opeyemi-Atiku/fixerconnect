<?php

namespace App\Http\Controllers;

use App\CommercialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\ResidentialInfo;
use App\Job;
use App\JobApplicant;
use App\JobLocation;
use App\Transaction;
use App\TransactionType;
use App\Location;

use App\Mail\EmployerMail;
use App\TechnicianInfo;
use App\TechnicianTradeList;
use App\TechnicianReview;

class EmployerController extends Controller
{

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function registerResidential()
  {
    $technician = User::where('account_type', '=', 1)->paginate(10);
    foreach ($technician as $technician_) {
      $technician__ = TechnicianInfo::where('user_id', '=', $technician_->id)->first();
      $technician_->rating = TechnicianReview::where('user_id', '=', $technician_->id)->avg('rating');
      $technician_->profile_image = $technician__->profile_image;
      $technician_->location = $technician__->location;
      $technician_trade_type = TechnicianTradeList::find($technician__->trade_type);
      $technician_->trade_type = $technician_trade_type->trade_name;
      $technician_->city = $technician__->city;
      $technician_->firstName = $technician__->firstName;
      $technician_->lastName = $technician__->lastName;
    }
    return view('source_file.Dashboard.Employer.Registration.registration_residential', compact('technician'));
  }
  
  /**
     * Display a listing of the resource.
     * log out
     *
     * @return \Illuminate\Http\Response
     */
    public function profileTechnicianResidential($id)
    {
      $user = User::find($id);
      if($user){
        $user_type = $user->account_type;

        switch ($user_type) {
          case 1:
            $account_ = 'Technician';
            $auth_user = User::find($id);
            $technician_infos = TechnicianInfo::where('user_id', '=', $id)->first();
            $location = Location::where('user_id', '=', $id)->first();
            $technicianTrade = TechnicianTradeList::find($technician_infos->trade_type);
            if($location){
              $auth_user->latitude = $location->latitude;
              $auth_user->longitude = $location->longitude;
            }else{
              $auth_user->latitude = 0;
              $auth_user->longitude = 0;
            }
            if($technician_infos){
              $auth_user->experience = $technician_infos->experience;
              $auth_user->location = $technician_infos->location;
              $auth_user->profile_image = $technician_infos->profile_image;
              $auth_user->contact_number = $technician_infos->contact_number;
              $auth_user->license = $technician_infos->license;
              $auth_user->charges = $technician_infos->charges;
              $auth_user->currency = $technician_infos->currency;
              $auth_user->trade_id = $technician_infos->trade_type;
              $auth_user->trade_name = $technicianTrade->trade_name;
              $auth_user->city = $technician_infos->city;
            }else{
              $auth_user->experience = '';
              $auth_user->location = '';
              $auth_user->profile_image = '';
              $auth_user->contact_number = '';
              $auth_user->license = '';
              $auth_user->charges = '';
              $auth_user->currency = '';
              $auth_user->trade_id = '';
            }


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
    
            return view('source_file.Dashboard.Employee.Personal_Details.profile')->with('account_', $account_)->with('auth_user', $auth_user)->with('review', $review)->with('link', 'residential');
            break;
            
            case 5:
            $account_ = 'Local Contractor';
            $auth_user = User::find($id);
            $technician_infos = TechnicianInfo::where('user_id', '=', $id)->first();
            $location = Location::where('user_id', '=', $id)->first();
            $technicianTrade = 'Local Contractor';
            if($location){
              $auth_user->latitude = $location->latitude;
              $auth_user->longitude = $location->longitude;
            }else{
              $auth_user->latitude = 0;
              $auth_user->longitude = 0;
            }
            if($technician_infos){
              $auth_user->experience = $technician_infos->experience;
              $auth_user->location = $technician_infos->location;
              $auth_user->profile_image = $technician_infos->profile_image;
              $auth_user->contact_number = $technician_infos->contact_number;
              $auth_user->license = $technician_infos->license;
              $auth_user->charges = $technician_infos->charges;
              $auth_user->currency = $technician_infos->currency;
              $auth_user->trade_id = '5';
              $auth_user->trade_name = 'Local Contractor';
              $auth_user->city = $technician_infos->city;
            }else{
              $auth_user->experience = '';
              $auth_user->location = '';
              $auth_user->profile_image = '';
              $auth_user->contact_number = '';
              $auth_user->license = '';
              $auth_user->charges = '';
              $auth_user->currency = '';
              $auth_user->trade_id = '';
            }


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
    
            return view('source_file.Dashboard.Employee.Personal_Details.profile')->with('account_', $account_)->with('auth_user', $auth_user)->with('review', $review)->with('link', 'residential');
            break;

            default:
            return redirect()->back();
        }
              
      }else{
        return redirect()->back();
      }
      
    }

  /**
     * Display a listing of the resource.
     * log out
     *
     * @return \Illuminate\Http\Response
     */
    public function profileTechnicianCommercial($id)
    {
      $user = User::find($id);
      if($user){
        $user_type = $user->account_type;

        switch ($user_type) {
          case 1:
            $account_ = 'Technician';
            $auth_user = User::find($id);
            $technician_infos = TechnicianInfo::where('user_id', '=', $id)->first();
            $location = Location::where('user_id', '=', $id)->first();
            $technicianTrade = TechnicianTradeList::find($technician_infos->trade_type);
            if($location){
              $auth_user->latitude = $location->latitude;
              $auth_user->longitude = $location->longitude;
            }else{
              $auth_user->latitude = 0;
              $auth_user->longitude = 0;
            }
            if($technician_infos){
              $auth_user->experience = $technician_infos->experience;
              $auth_user->location = $technician_infos->location;
              $auth_user->profile_image = $technician_infos->profile_image;
              $auth_user->contact_number = $technician_infos->contact_number;
              $auth_user->license = $technician_infos->license;
              $auth_user->charges = $technician_infos->charges;
              $auth_user->currency = $technician_infos->currency;
              $auth_user->trade_id = $technician_infos->trade_type;
              $auth_user->trade_name = $technicianTrade->trade_name;
              $auth_user->city = $technician_infos->city;
            }else{
              $auth_user->experience = '';
              $auth_user->location = '';
              $auth_user->profile_image = '';
              $auth_user->contact_number = '';
              $auth_user->license = '';
              $auth_user->charges = '';
              $auth_user->currency = '';
              $auth_user->trade_id = '';
            }


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
    
            return view('source_file.Dashboard.Employee.Personal_Details.profile')->with('account_', $account_)->with('auth_user', $auth_user)->with('review', $review)->with('link', 'commercial');
            break;
            case 5:
            $account_ = 'Local Contractor';
            $auth_user = User::find($id);
            $technician_infos = TechnicianInfo::where('user_id', '=', $id)->first();
            $location = Location::where('user_id', '=', $id)->first();
            $technicianTrade = 'Local Contractor';
            if($location){
              $auth_user->latitude = $location->latitude;
              $auth_user->longitude = $location->longitude;
            }else{
              $auth_user->latitude = 0;
              $auth_user->longitude = 0;
            }
            if($technician_infos){
              $auth_user->experience = $technician_infos->experience;
              $auth_user->location = $technician_infos->location;
              $auth_user->profile_image = $technician_infos->profile_image;
              $auth_user->contact_number = $technician_infos->contact_number;
              $auth_user->license = $technician_infos->license;
              $auth_user->charges = $technician_infos->charges;
              $auth_user->currency = $technician_infos->currency;
              $auth_user->trade_id = '5';
              $auth_user->trade_name = 'Local Contractor';
              $auth_user->city = $technician_infos->city;
            }else{
              $auth_user->experience = '';
              $auth_user->location = '';
              $auth_user->profile_image = '';
              $auth_user->contact_number = '';
              $auth_user->license = '';
              $auth_user->charges = '';
              $auth_user->currency = '';
              $auth_user->trade_id = '';
            }


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
    
            return view('source_file.Dashboard.Employee.Personal_Details.profile')->with('account_', $account_)->with('auth_user', $auth_user)->with('review', $review)->with('link', 'commercial');
            break;

            default:
            return redirect()->back();
        }
              
      }else{
        return redirect()->back();
      }
      
    }

    /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function registrationViewR(Request $request)
  {    
    return view('source_file.Dashboard.Employer.Registration.registration_residential_view');
  }
  

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function registrationViewC(Request $request)
  {    
    return view('source_file.Dashboard.Employer.Registration.registration_commercial_view');
  }

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function registerCommercial()
  {
    $technician = User::where('account_type', '=', 1)->paginate(10);
    
    foreach ($technician as $technician_) {
      $technician__ = TechnicianInfo::where('user_id', '=', $technician_->id)->first();
      $technician_->rating = TechnicianReview::where('user_id', '=', $technician_->id)->avg('rating');
      $technician_->profile_image = $technician__->profile_image;
      $technician_->location = $technician__->location;
      $technician_trade_type = TechnicianTradeList::find($technician__->trade_type);
      $technician_->trade_type = $technician_trade_type->trade_name;
      $technician_->city = $technician__->city;
      $technician_->firstName = $technician__->firstName;
      $technician_->lastName = $technician__->lastName;
    }
    return view('source_file.Dashboard.Employer.Registration.registration_commercial', compact('technician'));
  }


  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function commercial_view_customised()
  {    
    return view('source_file.Dashboard.Employer.Registration.commercial_request');
  }

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function commercial_customised(Request $request)
  {    
    $this->validate($request, [
      'name' => 'required|max:255',
      'email' => 'required|email|max:255',
      'phone' => 'required|digits:10',
    ]);

    $name = $request->input('name');
    $email = $request->input('email');
    $phone = $request->input('phone');

    $custom = new CommercialRequest;
    $custom->name = $name;
    $custom->email = $email;
    $custom->phone = $phone;
    $custom->save();

    return redirect()->back()->with('status', 'Request Submitted');

  }


  /**
   * Display a listing of the resource.
   * residential and commercial dashboard
   *
   * @return \Illuminate\Http\Response
   */
  public function dashboard()
  {
    return view('source_file.Dashboard.Employer.dashboard');
  }

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function technicianList()
  {    
    $technician = User::where('account_type', '=', 1)->paginate(10);
    foreach ($technician as $technician_) {
      $technician__ = TechnicianInfo::where('user_id', '=', $technician_->id)->first();
      $technician_->profile_image = $technician__->profile_image;
      $technician_->location = $technician__->location;
      $technician_trade_type = TechnicianTradeList::find($technician__->trade_type);
      $technician_->trade_type = $technician_trade_type->trade_name;
    }
    return view('source_file.Dashboard.Employer.Projects.technician_list', compact('technician'));
  }

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function invitation($id)
  {    
    $auth_user_ = User::find($id);

    if($auth_user_ == false){
      return redirect('/redirect_dashboard');
    }

    $job_type_ = TechnicianInfo::where('user_id', '=', $id)->first();

    $job = Job::where('user_id', '=', Auth::id())->where('trade_id', '=', $job_type_->trade_type)->orderBy('id', 'DESC')->paginate(10);
    
    if($auth_user_->account_type == 1){
      $technician_infos = TechnicianInfo::where('user_id', '=', $id)->first();
      $location = Location::where('user_id', '=', $id)->first();
            if($technician_infos){
              $technicianTrade = TechnicianTradeList::find($technician_infos->trade_type);
            }else{
              $technicianTrade = '';
            }
            if($location){
              $auth_user_->latitude = $location->latitude;
              $auth_user_->longitude = $location->longitude;
            }else{
              $auth_user_->latitude = 0;
              $auth_user_->longitude = 0;
            }
            if($technician_infos){
              $auth_user_->experience = $technician_infos->experience;
              $auth_user_->location = $technician_infos->location;
              $auth_user_->profile_image = $technician_infos->profile_image;
              $auth_user_->contact_number = $technician_infos->contact_number;
              $auth_user_->license = $technician_infos->license;
              $auth_user_->gender = $technician_infos->gender;
              $auth_user_->charges = $technician_infos->charges;
              $auth_user_->currency = $technician_infos->currency;
              $auth_user_->trade_id = $technician_infos->trade_type;
              $auth_user_->trade_name = $technicianTrade->trade_name;
            }else{
              $auth_user_->experience = '';
              $auth_user_->location = '';
              $auth_user_->profile_image = '';
              $auth_user_->contact_number = '';
              $auth_user_->license = '';
              $auth_user_->gender = '';
              $auth_user_->charges = '';
              $auth_user_->currency = '';
              $auth_user_->trade_id = '';
            }
            
    }else{
      return redirect('/redirect_dashboard');
    }

            
    return view('source_file.Dashboard.Employer.invitation', compact('job', 'auth_user_'));
  }

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function invite_($id, $user_id)
  {
    $auth_id = Auth::id();
    $invite_id = $user_id;

    $job = Job::find($id);

    if($job == false){
      return redirect('/redirect_dashboard');
    }

    if($auth_id == $job->user_id){
      $check_applicant = JobApplicant::where('user_id', '=', $invite_id)->where('job_id', '=', $id)->get();

      if(count($check_applicant) == 0){
      $new_applicant = new JobApplicant;
      $new_applicant->user_id  = $invite_id;
      $new_applicant->job_id = $id;
      $new_applicant->bid_price = 0;
      $new_applicant->status = 6;
      $save = $new_applicant->save();
      }     

      if(Auth::user()->account_type == 2){
        return redirect("/job/residential/$id");
      }elseif(Auth::user()->account_type == 3){
        return redirect("/job/commercial/$id");
      }
      
    }else{
      return redirect('/redirect_dashboard');
    }

    

    
  }

  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function profile()
  {
    $job = Job::where('user_id', '=', Auth::id())->orderBy('id', 'DESC')->paginate(10);
    return view('source_file.Dashboard.Employer.Profile.profile')->with('job', $job);
  }

  /**
   * Display a listing of the resource.
   * residential and commercial edit profile
   *
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {
    return view('source_file.Dashboard.Employer.Profile.edit_profile');
  }

  /**
   * Display a listing of the resource.
   * residential and commercial accepted project
   *
   * @return \Illuminate\Http\Response
   */
  public function accepted()
  {
    $check = 2;
    $job = $this->projectList($check);
    return view('source_file.Dashboard.Employer.Projects.accepted')->with('job', $job);
  }

  /**
   * Display a listing of the resource.
   * residential and commercial decline project
   *
   * @return \Illuminate\Http\Response
   */
  public function pending()
  {
    $check = 1;
    $job = $this->projectList($check);
    return view('source_file.Dashboard.Employer.Projects.pending')->with('job', $job);
  }

  /**
   * Display a listing of the resource.
   * project list
   *
   * @return \Illuminate\Http\Response
   */
  public function projectList($check)
  {
    $id = Auth::id();
    $job = Job::where('user_id', '=', $id)
    ->where('status', '=', $check)
    ->join('technician_trade_lists', 'technician_trade_lists.id', '=', 'jobs.trade_id')
    ->select('jobs.*', 'technician_trade_lists.trade_name')
    ->orderBy('id', 'DESC')
    ->paginate(10);
    return $job;
  }

  /**
   * Display a listing of the resource.
   * residential and commercial forgot password
   *
   * @return \Illuminate\Http\Response
   */
  public function forgot()
  {
    return view('source_file.Dashboard.Employer.Profile.forget_password');
  }

  /**
   * Display a listing of the resource.
   * residential and commercial settings
   *
   * @return \Illuminate\Http\Response
   */
  public function settings()
  {
    return view('source_file.Dashboard.Employer.Profile.settings');
  }

  /**
   * Display a listing of the resource.
   * residential and commercial inbox
   *
   * @return \Illuminate\Http\Response
   */
  /*public function inbox()
  {
    return view('source_file.Dashboard.Employer.Messages.inbox');
  }*/

  /**
   * Display a listing of the resource.
   * residential and commercial sent
   *
   * @return \Illuminate\Http\Response
   */
  /*public function sent()
  {
    return view('source_file.Dashboard.Employer.Messages.sent');
  }*/

  /**
   * Display a listing of the resource.
   * residential and commercial deleted
   *
   * @return \Illuminate\Http\Response
   */
  /*public function deleted()
  {
    return view('source_file.Dashboard.Employer.Messages.deleted');
  }*/

  /**
   * Display a listing of the resource.
   * residential and commercial review
   *
   * @return \Illuminate\Http\Response
   */
  public function review()
  {
    return view('source_file.Dashboard.Employer.reviews');
  }

  /**
   * Display a listing of the resource.
   * residential and commercial post job
   *
   * @return \Illuminate\Http\Response
   */
  public function post(Request $request)
  {
    $job_title = $request->job_title;
    $trade_type = $request->trade_type;
    $budget_to = $request->budget_to;
    $budget_from = $request->budget_from;
    $job_description = $request->job_description;
    $job_media = $request->job_media;
    $job_address = $request->job_address;
    $job_latitude = $request->job_latitude;
    $job_longitude = $request->job_longitude;
    $id = Auth::id();

    if($request->hasFile('job_media')){
      $job_media = $request->file('job_media');
      $fileName = $job_media->getClientOriginalName();
      $fileExt = $job_media->getClientOriginalExtension();
      $filePath = pathinfo($fileName, PATHINFO_FILENAME);
      $saveAs = $filePath.'_'.time().'.'.$fileExt;
      $path = $job_media->move('storage/storage/', $saveAs);
    }else{
      return 'error';
    }

    $job = new Job;
    $job->user_id = $id;
    $job->title = $job_title;
    $job->trade_id = $trade_type;
    $job->description = $job_description;
    $job->media = $saveAs;
    $job->address = $job_address;
    $job->budget_to = $budget_to;
    $job->budget_from = $budget_from;

    $job_location = new JobLocation;
    $job_location->latitude = $job_latitude;
    $job_location->longitude = $job_longitude;

    $save_job = $job->save();
    $job_location->job()->associate($job);
    $save_job_location = $job_location->save();

    return 'save';
  }

  /**
   * Display a listing of the resource.
   * residential and commercial faq
   *
   * @return \Illuminate\Http\Response
   */
  public function faq()
  {
    return view('source_file.Dashboard.Employer.help_faq');
  }

  /**
   * Display a listing of the resource.
   * residential and commercial faq
   *
   * @return \Illuminate\Http\Response
   */
  public function verify($token)
  {
    $id = Auth::id();
    $user = User::find($id);
    if($user){
      if($user->remember_token == $token){
        User::where('id', '=', $id)->update([
          'verfication' => 2
        ]);
        switch ($user->account_type) {
          case 2:
            return redirect('/dashboard/residential')->with('status', 'Account has been verified');
            break;
          case 3:
            return redirect('/dashboard/commercial')->with('status', 'Account has been verified');
            break;
        }
      }else{
        switch ($user->account_type) {
          case 2:
            Mail::to(Auth::user()->email)->send(new EmployerMail());
            return redirect('/dashboard/residential')->with('status', 'Verification token has expired, new verification link has been sent to your mail');
            break;
          case 3:
            Mail::to(Auth::user()->email)->send(new EmployerMail());
            return redirect('/dashboard/commercial')->with('status', 'Verification token has expired, new verification link has been sent to your mail');
            break;
        }
      }
    }
  }

  /**
   * Display a listing of the resource.
   * residential and commercial faq
   *
   * @return \Illuminate\Http\Response
   */
  public function transaction()
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
    return view('source_file.Dashboard.Employer.Projects.transaction')->with('transactions', $transactions);
  }
}
