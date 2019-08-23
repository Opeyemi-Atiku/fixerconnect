<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\ResidentialInfo;

class EmployerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   *
   * @return \Illuminate\Http\Response
   */
  public function __construct()
  {
    $this->middleware(function($request, $next){
      $user_type = Auth::user()->account_type;
      switch ($user_type) {
        case 2:
          $account = 'Resedential';
          break;
        case 3:
          $account = 'Commercial';
          break;
      }
      \View::share('account', $account);
      return $next($request);
    });
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
  public function profile()
  {
    return view('source_file.Dashboard.Employer.profile');
  }
}
