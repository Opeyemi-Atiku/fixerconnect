<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\TechnicianInfo;


class TechnicianController extends Controller
{
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
    return view('source_file.Dashboard.Employee.profile');
  }
}
