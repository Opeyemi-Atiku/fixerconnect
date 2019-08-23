<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\ResidentialInfo;
use App\TechnicianInfo;

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
   * technician validation
   *
   * @return \Illuminate\Http\Response
   */
  public function technician_validation($request)
  {
    $this->validate($request, [
      'fullname_technician' => 'required|max:255',
      'email_technician' => 'required|email|max:255',
      'password_technician' => 'required|min:6',
      'password_confirmation_technician' => 'required|min:6|same:password_technician',
      'address_technician' => 'required',
      'gender_technician' => 'required|max:255',
      'license_technician' => 'required|mimes:pdf',
      'experience_technician' => 'required',
      'charges_technician' => 'required|numeric',
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
           return redirect('/redirect_dashboard');
           break;
       }
     }else{
       $store_error = 'Unknown error occured';
       return redirect()->back()->withInput()->with('store_error', $store_error);
     }

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
      $user->account_type = 1;

      /*
      * store technician
      */

      $technician = new TechnicianInfo;
      $technician->location = $request->input('address_technician');
      $technician->gender = $request->input('gender_technician');
      $technician->experience = $request->input('experience_technician');
      $technician->charges = $request->input('charges_technician');
      $technician->currency = $request->input('currency_technician');

      /*
      * store license for verification
      */

      if($request->hasFile('license_technician')){
        $license = $request->file('license_technician');
        $fileName1 = $license->getClientOriginalName();
        $fileExt1 = $license->getClientOriginalExtension();
        $filePath1 = pathinfo($fileName1, PATHINFO_FILENAME);
        $saveAs1 = 'storage\\storage\\'.$filePath1.'_'.time().'.'.$fileExt1;
        $saveAss1 = $filePath1.'_'.time().'.'.$fileExt1;
        $path1 = $license->move('storage\\storage\\', $saveAss1);
      }else{
        $saveAs1 = null;
      }

      $technician->license = $saveAs1;

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
            return redirect('/redirect_dashboard');
            break;
        }
      }else{
        $store_error = 'Unknown error occured';
        return redirect()->back()->withInput()->with('store_error', $store_error);
      }

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

      }else{
        return redirect()->back()->with('error', 'Invalid account selected');
      }

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
