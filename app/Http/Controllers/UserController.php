<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\ResidentialInfo;
use App\TechnicianInfo;
use App\CommercialInfo;
use App\TechnicianTradeList;
use App\Location;
use App\Job;
use App\JobLocation;
use App\JobApplicant;
use App\TechnicianReview;
use Carbon\Carbon;
use App\Mail\UserNew;

class UserController extends Controller
{
  /**
   * Show the application dashboard.
   * Register user page
   *
   * @return \Illuminate\Http\Response
   */
  public function register()
  {
      return view('source_file.User.register');
  }

  /**
   * Show the application dashboard.
   * Login user page
   *
   * @return \Illuminate\Http\Response
   */
  public function login()
  {
    return view('source_file.User.login');
  }

  /**
   * Show the application dashboard.
   * registration request
   *
   * @return \Illuminate\Http\Response
   */
  public function registration(Request $request)
  {
    $this->validate($request, [
      'user_option_type' => 'required'
    ]);

    $account_type = $request->input('user_option_type');

    if($account_type == 'technician'){

      return $this->technician_validation($request);

    }elseif($account_type == 'residential'){

      return $this->residential_validation($request);

    }elseif($account_type == 'commercial'){

      return $this->commercial_validation($request);

    }else{
      return redirect('/user/register');//->with('');
    }
  }

  /**
   * Show the application dashboard.
   * residential validation
   *
   * @return \Illuminate\Http\Response
   */
  public function residential_validation($request)
  {
    $this->validate($request, [
      'name_residential' => 'required|max:255',
      'email_residential' => 'required|email|max:255',
      'password_residential' => 'required|min:6',
      'password_confirmation_residential' => 'required|min:6|same:password_residential',
      'address_residential' => 'required',
      'phone_residential' => 'required|digits:10',
    ]);



    $user_email = $request->input('email_residential');
    $account_type = 'residential';

    /*
    * check if email has been taken
    */
    return $this->checkEmail($user_email, $account_type, $request);
  }

  /**
   * Show the application dashboard.
   * residential validation
   *
   * @return \Illuminate\Http\Response
   */
  public function commercial_validation($request)
  {
    $this->validate($request, [
      'name_commercial' => 'required|max:255',
      'email_commercial' => 'required|email|max:255',
      'password_commercial' => 'required|min:6',
      'password_confirmation_commercial' => 'required|min:6|same:password_commercial',
      'address_commercial' => 'required',
      'phone_commercial' => 'required|digits:10',
    ]);



    $user_email = $request->input('email_commercial');
    $account_type = 'commercial';

    /*
    * check if email has been taken
    */
    return $this->checkEmail($user_email, $account_type, $request);
  }

  /**
   * Show the application dashboard.
   * technician validation
   *
   * @return \Illuminate\Http\Response
   */
  public function technician_validation($request)
  {
    $this->validate($request, [
      'fullname_technician' => 'required|max:255',
      'First_Name' => 'required|max:255',
      'Last_Name' => 'required|max:255',
      'email_technician' => 'required|email|max:255',
      'password_technician' => 'required|min:6',
      'password_confirmation_technician' => 'required|min:6|same:password_technician',
      'address_technician' => 'required',
      'license_technician' => 'required',
      'experience_technician' => 'required',
      'charges_technician' => 'required|numeric',
      'trade_technician' => 'numeric',
    ]);

    $user_email = $request->input('email_technician');
    $account_type = 'technician';

    /*
    *check if email has been taken
    */
    return $this->checkEmail($user_email, $account_type, $request);
  }

  /**
   * Show the application dashboard.
   * check if email has been taken
   *
   * @return \Illuminate\Http\Response
   */
  public function checkEmail($user_email, $account_type, $request)
  {
    $email = $user_email;
    $account = $account_type;

    $check_email_exist = User::where('email', '=', $email)->get();
    $count_check_email_exist = count($check_email_exist);

    if($count_check_email_exist > 0){
      /*
      * if email is been used
      */
      $error_email = 'email has been taken';
      return redirect()->back()->withInput()->with('error_email', $error_email);
    }else{
      /*
      * if not store into database
      */
      switch ($account) {
        case 'commercial':
        return $this->storeCommercial($request);
          break;
        case 'residential':
        return $this->storeResidential($request);
          break;
        case 'technician':
        return $this->storeTechnician($request);
          break;
      }
    }
  }

  /**
   * Show the application dashboard.
   * store residential info
   *
   * @return \Illuminate\Http\Response
   */
   public function storeResidential($request)
   {
     /*
     * store user
     */
     $user = new User;
     $user->name = $request->input('name_residential');
     $user->email = $request->input('email_residential');
     $user->password = bcrypt($request->input('password_residential'));
     $user->account_type = 2;

     /*
     * store residential
     */
     $residential = new ResidentialInfo;
     $residential->contact_number = $request->input('phone_residential');
     $residential->location = $request->input('address_residential');

     /*
     * store
     */
     $save_user = $user->save();
     $residential->user()->associate($user);
     $save_residential = $residential->save();

     if($save_user && $save_residential){
       $authenticate_mail = $request->input('email_residential');
       $authenticate_passowrd = $request->input('password_residential');
       $authenticate = Auth::guard()->attempt(['email' => $authenticate_mail, 'password' => $authenticate_passowrd]);

       /*
       * redirect after store
       */
       switch ($authenticate) {
         case false:
         $store_error = 'authentication error occured';
         return redirect('/user/login')->with('store_error', $store_error);
           break;
         case true:
             
            Mail::to(Auth::user()->email)->send(new UserNew());
           return redirect('/redirect_dashboard');
           break;
       }
     }
     $store_error = 'Unknown error occured';
     return redirect()->back()->withInput()->with('store_error', $store_error);

   }

   /**
    * Show the application dashboard.
    * store residential info
    *
    * @return \Illuminate\Http\Response
    */
    public function storeCommercial($request)
    {
      /*
      * store user
      */
      $user = new User;
      $user->name = $request->input('name_commercial');
      $user->email = $request->input('email_commercial');
      $user->password = bcrypt($request->input('password_commercial'));
      $user->account_type = 3;

      /*
      * store residential
      */
      $commercial = new CommercialInfo;
      $commercial->contact_number = $request->input('phone_commercial');
      $commercial->location = $request->input('address_commercial');

      /*
      * store
      */
      $save_user = $user->save();
      $commercial->user()->associate($user);
      $save_commercial = $commercial->save();

      if($save_user && $save_commercial){
        $authenticate_mail = $request->input('email_commercial');
        $authenticate_passowrd = $request->input('password_commercial');
        $authenticate = Auth::guard()->attempt(['email' => $authenticate_mail, 'password' => $authenticate_passowrd]);

        /*
        * redirect after store
        */
        switch ($authenticate) {
          case false:
          $store_error = 'authentication error occured';
          return redirect('/user/login')->with('store_error', $store_error);
            break;
          case true:
              Mail::to(Auth::user()->email)->send(new UserNew());
            return redirect('/redirect_dashboard');
            break;
        }
      }
      $store_error = 'Unknown error occured';
      return redirect()->back()->withInput()->with('store_error', $store_error);

    }

   /**
    * Show the application dashboard.
    * store technician info
    *
    * @return \Illuminate\Http\Response
    */
    public function storeTechnician($request)
    {
      /*
      * store user
      */

      $user = new User;
      $user->name = $request->input('fullname_technician');
      $user->email = $request->input('email_technician');
      $user->password = bcrypt($request->input('password_technician'));
      if($request->input('trade_technician')){
          $user->account_type = 1;
      }else{
          $user->account_type = 5;
      }
      

      /*
      * store technician
      */

      $technician = new TechnicianInfo;
      $technician->location = $request->input('address_technician');
      $technician->experience = $request->input('experience_technician');
      $technician->charges = $request->input('charges_technician');
      $technician->currency = $request->input('currency_technician');
      if($request->input('trade_technician')){
          $technician->trade_type = $request->input('trade_technician');
      }
      $technician->firstName = $request->input('First_Name');
      $technician->lastName = $request->input('Last_Name');

      /*
      * store license for verification
      */

      if($request->hasFile('license_technician')){
        $license = $request->file('license_technician');
        $fileName1 = $license->getClientOriginalName();
        $fileExt1 = $license->getClientOriginalExtension();
        $filePath1 = pathinfo($fileName1, PATHINFO_FILENAME);
        $saveAs1 = $filePath1.'_'.time().'.'.$fileExt1;
        $path1 = $license->move('storage/storage/', $saveAs1);
      }else{
        $saveAs1 = null;
      }
      
      if($request->hasFile('document_technician')){
        $document = $request->file('document_technician');
        $fileName2 = $document->getClientOriginalName();
        $fileExt2= $document->getClientOriginalExtension();
        $filePath2 = pathinfo($fileName2, PATHINFO_FILENAME);
        $saveAs2 = $filePath2.'_'.time().'.'.$fileExt2;
        $path2 = $document->move('storage/storage/', $saveAs2);
      }else{
        $saveAs2 = null;
      }

      $technician->license = $saveAs1;
      $technician->document = $saveAs2;

      /*
      * store
      */
      $save_user = $user->save();
      $technician->user()->associate($user);
      $save_technician = $technician->save();

      if($save_user && $save_technician){
        $authenticate_mail = $request->input('email_technician');
        $authenticate_passowrd = $request->input('password_technician');
        $authenticate = Auth::guard()->attempt(['email' => $authenticate_mail, 'password' => $authenticate_passowrd]);

        /*
        * redirect after store
        */
        switch ($authenticate) {
          case false:
          $store_error = 'authentication error occured';
          return redirect('/user/login')->with('store_error', $store_error);
            break;
          case true:
              Mail::to(Auth::user()->email)->send(new UserNew());
            return redirect('/redirect_dashboard');
            break;
        }
      }
      $store_error = 'Unknown error occured';
      return redirect()->back()->withInput()->with('store_error', $store_error);

    }

    /**
     * Display a listing of the resource.
     * redirect to dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
      $user = User::find(Auth::id());
      $user_account = $user->account_type;
      switch ($user_account) {
        case 1:
          return redirect('/dashboard/technician');
          break;
        case 2:
          return redirect('/dashboard/residential');
          break;
        case 3:
          return redirect('/dashboard/commercial');
          break;
        case 5: 
            return redirect('/dashboard/contractor');
            break;

        default:
          return redirect('/logout');
          break;
      }
    }

    /**
     * Display a listing of the resource.
     * set account page
     *
     * @return \Illuminate\Http\Response
     */
    public function setAccount()
    {
      return view('source_file.Dashboard.Employer.Account_Selection');
    }

    /**
     * Display a listing of the resource.
     * set account
     *
     * @return \Illuminate\Http\Response
     */
    public function accountSet(Request $request)
    {
      $this->validate($request, [
        'account' => 'required'
      ]);

      /*
      * check account selected
      * if valid and update user acccount type
      */
      $account = (int)$request->input('account');

      if($account === 2 || $account === 3){
        $update = User::where('id', '=', Auth::id())->update([
          'account_type' => $account
        ]);

        /*
        * redirect after update
        */
        switch ($update) {
          case true:
            return redirect('/redirect_dashboard')->with('status', 'Account set');
            break;
          case false:
            return redirect()->back()->with('error', 'Unknown error occured');
            break;
        }

      }
      return redirect()->back()->with('error', 'Invalid account selected');

    }

    /**
     * Display a listing of the resource.
     * upload profile picture
     * //$profile_image->getClientOriginalName();
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadProfile(Request $request)
    {
      if($request->hasFile('profile_image')){
        $profile_image = $request->file('profile_image');
        $fileName = Auth::id();
        $fileExt = $profile_image->getClientOriginalExtension();
        $filePath = pathinfo($fileName, PATHINFO_FILENAME);
        $saveAs = $filePath.'.'.$fileExt;
        $path1 = $profile_image->move('storage/storage/', $saveAs);
      }else{
        $saveAs = "profile_image.png";
      }
      $save_result = $this->save_profile($saveAs);

      if($save_result == 'save'){
        return 'save';
      }
    }

    /**
     * Display a listing of the resource.
     * save profile picture
     *
     * @return \Illuminate\Http\Response
     */
    public function save_profile($saveAs)
    {
      $id = Auth::id();
      $user_find = User::find($id);
      $user = (int)$user_find->account_type;

      switch ($user) {
        case 1:
          //
          $user_technician = TechnicianInfo::where('user_id', '=', $id)->get();
          $user_technician_count = count($user_technician);
          if($user_technician_count == 1){
            $update = TechnicianInfo::where('user_id', '=', $id)->update([
              'profile_image' => $saveAs
            ]);
            return 'save';
          }else if($user_technician_count == 0){
            $newProfile = new TechnicianInfo;
            $newProfile->user_id = $id;
            $newProfile->profile_image = $saveAs;
            $newProfile->save();
            return 'save';
          }
          break;
        case 2:
          //
          $user_residential = ResidentialInfo::where('user_id', '=', $id)->get();
          $user_residential_count = count($user_residential);
          if($user_residential_count == 1){
            $update = ResidentialInfo::where('user_id', '=', $id)->update([
              'profile_image' => $saveAs
            ]);
            return 'save';
          }else if($user_residential_count == 0){
            $newProfile = new ResidentialInfo;
            $newProfile->user_id = $id;
            $newProfile->profile_image = $saveAs;
            $newProfile->save();
            return 'save';
          }
          break;
        case 3:
          //
          $user_commercial = CommercialInfo::where('user_id', '=', $id)->get();
          $user_commercial_count = count($user_commercial);
          if($user_commercial_count == 1){
            $update = CommercialInfo::where('user_id', '=', $id)->update([
              'profile_image' => $saveAs
            ]);
            return 'save';
          }else if($user_commercial_count == 0){
            $newProfile = new CommercialInfo;
            $newProfile->user_id = $id;
            $newProfile->profile_image = $saveAs;
            $newProfile->save();
            return 'save';
          }
          break;
      }

    }
    
    /**
     * Display a listing of the resource.
     * upload loaction
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSchedule(Request $request)
    {
        $monday = $request->monday;
        $tuesday = $request->tuesday;
        $wednesday = $request->wednesday;
        $thursday = $request->thursday;
        $friday = $request->friday;
        
        $id = Auth::id();

        $checkSchedule = DB::table('schedule')->where('user_id', '=', $id)->get();
        $count_schedule = count($checkSchedule);


        if($count_schedule == 1){

          $update = DB::table('schedule')->where('user_id', '=', $id)->update([
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday
          ]);
          
          if($update){
            return 'save';
          }else{
            return 'error1';
          }



        }elseif($count_schedule == 0){

          $new = DB::table('schedule')->where('user_id', '=', $id)->insert([
            'user_id' => $id,  
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
          ]);
          
          if($new){
            return 'save';
          }else{
            return 'error2';
          }
        }
      
    }

    /**
     * Display a listing of the resource.
     * upload loaction
     *
     * @return \Illuminate\Http\Response
     */
    public function updateLocation(Request $request)
    {
      if($request->latitude != '' && $request->longitude != ''){
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $address = $request->address;
        
        

        $id = Auth::id();
        
        if($request->streetNumber){
            TechnicianInfo::where('user_id', '=', $id)->update([
                'city' => $request->streetNumber
                ]);
        }

        $checkLocation = Location::where('user_id', '=', $id)->get();
        $count_checkLocation = count($checkLocation);


        if($count_checkLocation == 1){

          $update = Location::where('user_id', '=', $id)->update([
            'latitude' => $latitude,
            'longitude' => $longitude
          ]);

          $save_address = $this->saveAddress($address);
          if($save_address){
            return 'save';
          }else{
            return 'error';
          }



        }elseif($count_checkLocation == 0){

          $newLocation = new Location;
          $newLocation->user_id = $id;
          $newLocation->latitude = $latitude;
          $newLocation->longitude = $longitude;
          $newLocation->save();

          $save_address = $this->saveAddress($address);
          if($save_address){
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
     * log out
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAddress($address)
    {
      $id = Auth::id();
      $user_find = User::find($id);
      $user = (int)$user_find->account_type;

      switch ($user) {
        case 1:
          //
          $user_technician = TechnicianInfo::where('user_id', '=', $id)->get();
          $user_technician_count = count($user_technician);
          if($user_technician_count == 1){
            $update = TechnicianInfo::where('user_id', '=', $id)->update([
              'location' => $address
            ]);
            return 'save';
          }else if($user_technician_count == 0){
            $newProfile = new TechnicianInfo;
            $newProfile->user_id = $id;
            $newProfile->location = $address;
            $newProfile->save();
            return 'save';
          }
          break;
        case 2:
          //
          $user_residential = ResidentialInfo::where('user_id', '=', $id)->get();
          $user_residential_count = count($user_residential);
          if($user_residential_count == 1){
            $update = ResidentialInfo::where('user_id', '=', $id)->update([
              'location' => $address
            ]);
            return 'save';
          }else if($user_residential_count == 0){
            $newProfile = new ResidentialInfo;
            $newProfile->user_id = $id;
            $newProfile->location = $address;
            $newProfile->save();
            return 'save';
          }
          break;
        case 3:
          //
          $user_commercial = CommercialInfo::where('user_id', '=', $id)->get();
          $user_commercial_count = count($user_commercial);
          if($user_commercial_count == 1){
            $update = CommercialInfo::where('user_id', '=', $id)->update([
              'location' => $address
            ]);
            return 'save';
          }else if($user_commercial_count == 0){
            $newProfile = new CommercialInfo;
            $newProfile->user_id = $id;
            $newProfile->location = $address;
            $newProfile->save();
            return 'save';
          }
          break;
      }
    }

    /**
     * Display a listing of the resource.
     * update profile
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
      $fullname = $request->fullname;
      $id = Auth::id();
      $user_find = User::find($id);
      $user = (int)$user_find->account_type;
      if($fullname != ''){
        $update_user = User::where('id', '=', $id)->update([
          'name' => $fullname,
        ]);
        if($update_user){
          return $this->saveExperience($request, $user, $id);
        }
      }
    }

    /**
     * Display a listing of the resource.
     * save experience
     *
     * @return \Illuminate\Http\Response
     */
    public function saveExperience($request, $user, $id)
    {
      switch ($user) {
        case 1:
          //
          $user_technician = TechnicianInfo::where('user_id', '=', $id)->get();
          $user_technician_count = count($user_technician);
          if($user_technician_count == 1){
            $update = TechnicianInfo::where('user_id', '=', $id)->update([
              'experience' => $request->experience,
              'trade_type' => $request->trade_type,
              'firstName' => $request->firstName,
              'lastName' => $request->lastName,
            ]);
            return 'save';
          }else if($user_technician_count == 0){
            $newProfile = new TechnicianInfo;
            $newProfile->user_id = $id;
            $newProfile->experience = $request->experience;
            $newProfile->trade_type = $request->trade_type;
            $newProfile->lastName = $request->lastName;
            $newProfile->firstName = $request->firstName;
            $newProfile->save();
            return 'save';
          }
          break;
        case 2:
          //
          $user_residential = ResidentialInfo::where('user_id', '=', $id)->get();
          $user_residential_count = count($user_residential);
          if($user_residential_count == 1){
            $update = ResidentialInfo::where('user_id', '=', $id)->update([
              'contact_number' => $request->phone,
              'description' => $request->description
            ]);
            return 'save';
          }else if($user_residential_count == 0){
            $newProfile = new ResidentialInfo;
            $newProfile->user_id = $id;
            $newProfile->contact_number = $request->phone;
            $newProfile->description = $request->description;
            $newProfile->save();
            return 'save';
          }
          break;
        case 3:
          //
          $user_commercial = CommercialInfo::where('user_id', '=', $id)->get();
          $user_commercial_count = count($user_commercial);
          if($user_commercial_count == 1){
            $update = CommercialInfo::where('user_id', '=', $id)->update([
              'contact_number' => $request->phone,
              'description' => $request->description
            ]);
            return 'save';
          }else if($user_commercial_count == 0){
            $newProfile = new CommercialInfo;
            $newProfile->user_id = $id;
            $newProfile->contact_number = $request->phone;
            $newProfile->description = $request->description;
            $newProfile->save();
            return 'save';
          }
          break;
          case 5:
          //
          $user_technician = TechnicianInfo::where('user_id', '=', $id)->get();
          $user_technician_count = count($user_technician);
          if($user_technician_count == 1){
            $update = TechnicianInfo::where('user_id', '=', $id)->update([
              'experience' => $request->experience,
              'firstName' => $request->firstName,
              'lastName' => $request->lastName,
            ]);
            return 'save';
          }else if($user_technician_count == 0){
            $newProfile = new TechnicianInfo;
            $newProfile->user_id = $id;
            $newProfile->experience = $request->experience;
            $newProfile->lastName = $request->lastName;
            $newProfile->firstName = $request->firstName;
            $newProfile->save();
            return 'save';
          }
          break;
      }
    }

    /**
     * Display a listing of the resource.
     * single job
     *
     * @return \Illuminate\Http\Response
     */
    public function singleJob($id)
    {
      /*
      *find job, locaion and trade type
      */
      $job = Job::find($id);

      if($job == false){
        return redirect('/');
      }
      if(Auth::user()->account_type != 1){
        if(Auth::id() != $job->user_id){
          return redirect('/redirect_dashboard');
        }
      }

      $job_location = JobLocation::where('job_id', '=', $id)->first();
      $job_trade = TechnicianTradeList::find($job->trade_id);

      $company = User::find($job->user_id);

      /*
      * add result to job
      */
      $job->latitude = $job_location->latitude;
      $job->longitude = $job_location->longitude;
      $job->trade_name = $job_trade->trade_name;
      $job->company_name = $company->name;

      /*
      * check applicant if technician
      */
      $applicant = JobApplicant::where('job_id', '=', $id)->orderBy('id', 'DESC')->paginate(10);

      foreach ($applicant as $app) {
        $job_applicant_info = TechnicianInfo::where('user_id', '=', $app->user_id)->first();
        $job_applicant_user = User::find($app->user_id);
        $app->profile_image = $job_applicant_info->profile_image;
        $app->name = $job_applicant_user->name;

      }
      if(Auth::user()->account_type == 1){
        $check_if_applied = JobApplicant::where('job_id', '=', $id)->where('user_id', '=', Auth::id())->get();
        if(count($check_if_applied)  > 0){
          $applied = 1;
          $price = $check_if_applied[0]->bid_price;
        }else{
          $applied = 2;
          $price = 0;
        }
      }else{
        $applied = 2;
        $price = 0;
      }

      $accept_applicant = JobApplicant::where('job_id', '=', $id)->where('status', '=', 4)->orderBy('id', 'DESC')->paginate(10);
      foreach ($accept_applicant as $applicant__) {
        $job_applicant_info = TechnicianInfo::where('user_id', '=', $applicant__->user_id)->first();
        $job_applicant_user = User::find($applicant__->user_id);
        $review__ = TechnicianReview::where('job_id', '=', $id)->where('user_id', '=', $applicant__->user_id)->first();
        if($review__){
          $applicant__->review = $review__->review;
          $applicant__->review_status = 1;
          $applicant__->rating = $review__->rating;
        }else{
          $applicant__->review = 'No review';
          $applicant__->review_status = 2;
          $applicant__->rating = 0;
          
        }
        $applicant__->profile_image = $job_applicant_info->profile_image;
        $applicant__->name = $job_applicant_user->name;
        $applicant__->address = $job_applicant_info->location;
      }
      return view('source_file.Dashboard.job_view')->with('job', $job)->with('applicant', $applicant)->with('applied', $applied)->with('price', $price)->with('accept_applicant', $accept_applicant);
    }

    /**
     * Display a listing of the resource.
     * log out
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
      $user = User::find($id);
      $user_type = $user->account_type;
      $schedule = DB::table('schedule')->where('user_id', $id)->first();
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
    
          
          return view('source_file.Dashboard.Employee.Personal_Details.profile')->with('account_', $account_)->with('auth_user', $auth_user)->with('review', $review)->with('schedule', $schedule);
          break;
        case 2:
          $account_ = 'Residential';
          $auth_user = User::find($id);
          $residential_infos = ResidentialInfo::where('user_id', '=', $id)->first();
          $location = Location::where('user_id', '=', $id)->first();
          if($location){
            $auth_user->latitude = $location->latitude;
            $auth_user->longitude = $location->longitude;
          }else{
            $auth_user->latitude = 0;
            $auth_user->longitude = 0;
          }
          if($residential_infos){
            $auth_user->description = $residential_infos->description;
            $auth_user->location = $residential_infos->location;
            $auth_user->profile_image = $residential_infos->profile_image;
            $auth_user->contact_number = $residential_infos->contact_number;
          }else{
            $auth_user->description = '';
            $auth_user->location = '';
            $auth_user->profile_image = '';
            $auth_user->contact_number = '';
          }
          $job = Job::where('user_id', '=', $id)->orderBy('id', 'DESC')->paginate(10);
          return view('source_file.Dashboard.Employer.Profile.profile')->with('account_', $account_)->with('auth_user', $auth_user)->with('job', $job);
          break;
        case 3:
          $account_ = 'Commercial';
          $auth_user = User::find($id);
          $commercial_infos = CommercialInfo::where('user_id', '=', $id)->first();
          $location = Location::where('user_id', '=', $id)->first();
          if($location){
            $auth_user->latitude = $location->latitude;
            $auth_user->longitude = $location->longitude;
          }else{
            $auth_user->latitude = 0;
            $auth_user->longitude = 0;
          }
          if($commercial_infos){
            $auth_user->description = $commercial_infos->description;
            $auth_user->location = $commercial_infos->location;
            $auth_user->profile_image = $commercial_infos->profile_image;
            $auth_user->contact_number = $commercial_infos->contact_number;
          }else{
            $auth_user->description = '';
            $auth_user->location = '';
            $auth_user->profile_image = '';
            $auth_user->contact_number = '';
          }
          $job = Job::where('user_id', '=', $id)->orderBy('id', 'DESC')->paginate(10);
          return view('source_file.Dashboard.Employer.Profile.profile')->with('account_', $account_)->with('auth_user', $auth_user)->with('job', $job);
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
            $auth_user->trade_id = $technician_infos->trade_type;
            $auth_user->trade_name = 'Local Contractor';
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
    
          
          return view('source_file.Dashboard.Employee.Personal_Details.profile')->with('account_', $account_)->with('auth_user', $auth_user)->with('review', $review)->with('schedule', $schedule);
          break;
      }
    }



    /**
     * Display a listing of the resource.
     * update password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
      $this->validate($request, [
        'Old_Password' => 'required|min:6',
        'New_Password' => 'required|min:6',
        'Confirm_Password' => 'required|min:6|same:New_Password',
      ]);

      $old_password = $request->input('Old_Password');
      $new_password = bcrypt($request->input('New_Password'));
      $user = User::find(Auth::id());
      $user_password = $user->password;
      if(\Hash::check($old_password, $user_password)){ 
        $update = User::where('id', '=', Auth::id())->update([
          'password' => $new_password
        ]);
        if($update){
          $password_status = "Password Change";
          return redirect()->back()->with('password_status', $password_status);
        }else{
          $password_status = "Unknown error occured";
          return redirect()->back()->with('password_status', $password_status);
        }
      }else{
        $old_password_error = "The old password is not correct";
        return redirect()->back()->with('old_password_error', $old_password_error);
      }
    }

    /**
     * Display a listing of the resource.
     * log out
     *
     * @return \Illuminate\Http\Response
     */
    public function addReview(Request $request)
    {
      $job_id = $request->job_id;
      $user_id = $request->user_id_review;
      $message = $request->message_review;
      $rating = $request->star_rating;

      $review = TechnicianReview::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->get();
      if(count($review) == 0){
        $new_review = new TechnicianReview;
        $new_review->user_id = $user_id;
        $new_review->job_id = $job_id;
        $new_review->review = $message;
        $new_review->rating = $rating;
        $new_review->save();
        return 'save';
      }else{
        TechnicianReview::where('job_id', '=', $job_id)->where('user_id', '=', $user_id)->update([
          'review' => $message,
          'rating' => $rating
        ]);
        return 'update';
      }
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
      $longitude = $request->input('longitude');
      $trade_id = $request->input('trade_');
      $task = $request->input('experience_technician');
      $time = '';
      
      $query_result = $this->search_technician($trade_id);
      
      if($longitude != '' && $latitude != ''){
        $query_result_location = $this->search_location_technician($query_result, $latitude, $longitude);
        $query_result = $query_result_location;
      }

      $technicians = $this->paginator($query_result, $request);
      $technician = $technicians[0];
      $lastPage = $technicians[1];
      
      
      foreach($technician as $tech){
          $tech_user = User::find($tech->user_id);
          $tech->name = $tech_user->name;
          $tech->email = $tech_user->email;
          $tech->rating = TechnicianReview::where('user_id', '=', $tech->user_id)->avg('rating');
      }
      switch ($trade_id) {
          case 1:
              $trade_type = "HVCA";
          break;
          case 2:
              $trade_type = "Electrical";
          break;
          case 3:
              $trade_type = "Plumbing";
          break;
          case 4:
              $trade_type = "Handy Pro";
          break;
          default:
              return redirect('/');
              break;
        
      }
      return view('source_file.Dashboard.Employer.Registration.techList')->with('technician', $technician)->with('trade_type', $trade_type)->with('lastPage', $lastPage);
  }
  
  /**
   * Display a listing of the resource.
   * residential and commercial profile
   *
   * @return \Illuminate\Http\Response
   */
  public function list_(Request $request)
  {
      $latitude = $request->input('latitude');
      $longitude = $request->input('longitude');
      $task = $request->input('experience_technician');
      $time = '';
      
      $query_result = $this->search_technician_();
      
      if($longitude != '' && $latitude != ''){
        $query_result_location = $this->search_location_technician($query_result, $latitude, $longitude);
        $query_result = $query_result_location;
      }

      $technicians = $this->paginator($query_result, $request);
      $technician = $technicians[0];
      $lastPage = $technicians[1];
      
      
      foreach($technician as $tech){
          $tech_user = User::find($tech->user_id);
          $tech->name = $tech_user->name;
          $tech->email = $tech_user->email;
          $tech->rating = TechnicianReview::where('user_id', '=', $tech->user_id)->avg('rating');
      }
      
      $trade_type = 'Local Contractor';
      
      return view('source_file.Dashboard.Employer.Registration.techList_')->with('technician', $technician)->with('trade_type', $trade_type)->with('lastPage', $lastPage);
  }
  
  
  /**
     * Display a listing of the resource.
     * search by title
     *
     * @return \Illuminate\Http\Response
     */
    public function search_technician($profession)
    {
      /* necessary
      * search title
      */
      $search_query = "SELECT * FROM technician_infos WHERE trade_type = $profession";

      $query = DB::SELECT($search_query);
      /*
      * search profession
      */

      return $query;
    }
    
    public function search_technician_()
    {
      /* necessary
      * search title
      */
      $query = TechnicianInfo::where('trade_type', '=', null)->get();
      /*
      * search profession
      */

      return $query;
    }
    
    
    public function search_location_technician($query_result, $latitude, $longitude)
    {

      $query_location_container = array();
      $nearJob_ = array();

        foreach ($query_result as $query_location__) {
          $query_location__id = $query_location__->user_id;
          $location_query = "SELECT *, (3956 * 2 * ASIN(SQRT(POWER(SIN(($latitude - latitude) * pi()/180/2), 2) + COS($latitude * pi() /180) * COS(latitude * pi()/180) *
          POWER(SIN(($longitude - longitude) * pi()/180 / 2), 2)))) AS 'distance' FROM locations WHERE user_id = $query_location__id  ORDER BY 'distance' ASC";
          $nearJob = DB::SELECT($location_query);
          if(count($nearJob) == 1){
            $query_location__->distance = $nearJob[0]->distance;
            array_push($nearJob_, $query_location__);
          }
        }
        return $nearJob_;
    }

    /**
     * Display a listing of the resource.
     * log out
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
      $this->validate($request, [
        'title' => 'required',
      ]);

      $title = $request->input('title');
      if($request->input('location')){
        $location = $request->input('location');
      }else{
        $location = '';
      }
      if($request->input('choose')){
        $time = $request->input('choose');
      }else{
        $time = '';
      }
      if($request->input('choosetype')){
        $profession = $request->input('choosetype');
      }else{
        $profession = [];
      }

      $results = array();

      $query_result = $this->search_title_profession($title, $profession);

      $query_result_time = $this->search_title_time($query_result, $time);

      $results = $query_result_time;


      $latitude = $request->input('latitude');
      $longitude = $request->input('longitude');

      if($longitude != '' && $latitude != ''){
        $query_result_location = $this->search_location($query_result_time, $latitude, $longitude);
        $results = $query_result_location;
      }

      $results = $this->find_profile($results);

      $job = $this->paginator($results, $request);
      $jobs = $job[0];
      $lastPage = $job[1];

      return view('source_file.Dashboard.Employee.search_result')->with('jobs', $jobs)->with('lastPage', $lastPage);
    }

    /**
     * Display a listing of the resource.
     * log out
     *
     * @return \Illuminate\Http\Response
     */
    public function find_profile($results)
    {
      foreach ($results as $results_) {
        $user_id_ = $results_->user_id;
        $results_user = User::find($user_id_);
        $results_->name = $results_user->name;
        $account_type = $results_user->account_type;
        switch ($account_type) {
          case 2:
           $residential = ResidentialInfo::where('user_id', '=', $user_id_)->first();
           if($residential){
             $results_->profile_image = $residential->profile_image;
           }else{
             $results_->profile_image = 'profile_image.png';
           }

           $results_->account_type_name = 'residential';
            break;
          case 3:
           $commercial = CommercialInfo::where('user_id', '=', $user_id_)->first();
           if($residential){
             $results_->profile_image = $commercial->profile_image;
           }else{
             $results_->profile_image = 'profile_image.png';
           }
           $results_->account_type_name = 'commercial';
            break;
        }
      }
      return $results;
    }




    /**
     * Display a listing of the resource.
     * search by title
     *
     * @return \Illuminate\Http\Response
     */
    public function search_title_profession($title, $profession)
    {
      /* necessary
      * search title
      */
      $search_query = "SELECT * FROM jobs";
      $clean_search = str_replace(',', ' ', $title);
      $search_words = explode(' ', $clean_search);
      $final_search_words = array();

      if(count($search_words) > 0){
        foreach ($search_words as $word) {
          if(!empty($word)){
            $final_search_words[] = $word;
          }
        }
      }

      $where_list = array();
      if(count($final_search_words) > 0){
        foreach ($final_search_words as $words) {
          $where_list[] = "title LIKE '%$words%'";
        }
      }

      $where_clause = implode(' OR ', $where_list);

      if(!empty($where_clause)){
        $search_query .= " WHERE $where_clause";
      }
      /*
      * search title
      */

      /*
      * search profession if added
      */
      $where_list_ = array();
      
      
      if(!empty($profession)){
        foreach ($profession as $prof) {
          $where_list_[] = "trade_id = '$prof'";
        }
      }

      $where_clause_ = implode(' OR ', $where_list_);

      if(!empty($where_clause_)){
          if(!empty($where_clause)){
              $search_query .= "  AND ($where_clause_)";
          }else{
              $search_query .= "  WHERE ($where_clause_)";
          }
        
      }

      $query = DB::SELECT($search_query);
      /*
      * search profession
      */

      return $query;
    }


    /**
     * Display a listing of the resource.
     * search by time
     *
     * @return \Illuminate\Http\Response
     */
    public function search_title_time($query_result, $time)
    {
      $query__result = array();

      $checkLast = Carbon::now();

      foreach ($query_result as $query_) {
        switch ($time) {
          case '1':
            $check_updated = $query_->updated_at;
            if($checkLast->diffInHours($check_updated) <= 1){
              array_push($query__result, $query_);
            }
            break;
          case '2':
            $check_updated = $query_->updated_at;
            if($checkLast->diffInHours($check_updated) <= 24){
              array_push($query__result, $query_);
            }
            break;
          case '3':
            $check_updated = $query_->updated_at;
            if($checkLast->diffInDays($check_updated) <= 7){
              array_push($query__result, $query_);
            }
            break;
          case '4':
            $check_updated = $query_->updated_at;
            if($checkLast->diffInDays($check_updated) <= 14){
              array_push($query__result, $query_);
            }
            break;
          case '5':
            $check_updated = $query_->updated_at;
            if($checkLast->diffInDays($check_updated) <= 30){
              array_push($query__result, $query_);
            }
          break;
            break;
          case '6':
            array_push($query__result, $query_);
            break;
          default:
            array_push($query__result, $query_);
            break;
        }
      }
      return $query__result;
    }


    /**
     * Display a listing of the resource.
     * location
     *
     * @return \Illuminate\Http\Response
     */
    public function search_location($query_result_time, $latitude, $longitude)
    {

      $query_location_container = array();
      $nearJob_ = array();
      if($latitude != '' && $longitude != ''){
        foreach ($query_result_time as $query_location) {
          $query_location_id = $query_location->id;
          $location = JobLocation::find($query_location_id);
          $query_location->latitude = $location->latitude;
          $query_location->longitude = $location->longitude;
          array_push($query_location_container, $query_location);
        }

        foreach ($query_location_container as $query_location__) {
          $query_location__id = $query_location__->id;
          $location_query = "SELECT *, (3956 * 2 * ASIN(SQRT(POWER(SIN(($latitude - latitude) * pi()/180/2), 2) + COS($latitude * pi() /180) * COS(latitude * pi()/180) *
          POWER(SIN(($longitude - longitude) * pi()/180 / 2), 2)))) AS 'distance' FROM job_locations WHERE job_id = $query_location__id Having 'distance' <= 30  ORDER BY 'distance' ASC";
          $nearJob = DB::SELECT($location_query);
          if(count($nearJob) == 1){
            $query_location__->distance = $nearJob[0]->distance;
            array_push($nearJob_, $query_location__);
          }
        }
        return $nearJob_;
      }else{
        return $nearJob_;
      }
    }


    /**
     * Display a listing of the resource.
     * paginator
     *
     * @return \Illuminate\Http\Response
     */
    public function paginator($results, $request)
    {
      $filterJob = array();

      foreach($results as $result){
        array_push($filterJob, $result);
      }

      $count = count($filterJob);
      if($request->current_page == null){
        $page = 1;
      }else{
        $page = $request->current_page;
      }
      $perPage = 10;
      $offset = ($page - 1) * $perPage;
      $lastPage = ceil($count/$perPage);
      $jobList = array_slice($filterJob, $offset, $perPage);

      $paginated = new Paginator($jobList, $perPage, $page);

      $paginated__ = [$paginated, $lastPage];

      return $paginated__;
    }


    /**
     * Display a listing of the resource.
     * log out
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
      Auth::guard()->logout();
      Session::flush();
      return redirect('/');
    }

}
