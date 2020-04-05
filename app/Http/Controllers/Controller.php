<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\ResidentialInfo;
use App\TechnicianInfo;
use App\CommercialInfo;
use App\TechnicianTradeList;
use App\Location;
use App\Balance;
use App\JobApplicant;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     * Set account type to general variable $account
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware(function($request, $next){
        /*
        * trade List
        */
        $tradeList = TechnicianTradeList::all();

        \View::share('tradeList', $tradeList);

        if(Auth::check() == false){
          return $next($request);
        }
        $user_type = Auth::user()->account_type;
        $id = Auth::id();
        
        $job_invite = JobApplicant::where('user_id', '=', $id)->where('status', '=', 6)->get();
        
        $job_invite_count = count($job_invite);
        \View::share('job_invite_count', $job_invite_count);

        /*
        * location share if updated
        */
        $user_location_views = Location::where('user_id', '=', $id)->get();
        $user_location_view_count = count($user_location_views);
        if($user_location_view_count == 1){
          $user_location_view = $user_location_views[0];
          \View::share('user_location_view', $user_location_view);
        }

        $check_balance = Balance::where('user_id', '=', $id)->get();

        if(count($check_balance) == 1){
          $check_balance = $check_balance[0];
          \View::share('check_balance', $check_balance);
        }else{
          $check_balance = [];
          \View::share('check_balance', $check_balance);
        }


        switch ($user_type) {
          case 1:
            $account = 'technician';
            $auth_user = User::find($id);
            $technician_infos = TechnicianInfo::where('user_id', '=', $id)->first();
            $location = Location::where('user_id', '=', $id)->first();
            if($technician_infos){
              $technicianTrade = TechnicianTradeList::find($technician_infos->trade_type);
            }else{
              $technicianTrade = '';
            }
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
              $auth_user->gender = $technician_infos->gender;
              $auth_user->charges = $technician_infos->charges;
              $auth_user->currency = $technician_infos->currency;
              $auth_user->trade_id = $technician_infos->trade_type;
              $auth_user->trade_name = $technicianTrade->trade_name;
              $auth_user->city = $technician_infos->city;
              $auth_user->firstName = $technician_infos->firstName;
              $auth_user->lastName = $technician_infos->lastName;
            }else{
              $auth_user->experience = '';
              $auth_user->location = '';
              $auth_user->profile_image = '';
              $auth_user->contact_number = '';
              $auth_user->license = '';
              $auth_user->gender = '';
              $auth_user->charges = '';
              $auth_user->currency = '';
              $auth_user->trade_id = '';
              $auth_user->city = '';
              $auth_user->firstName = '';
              $auth_user->lastName = '';
            }
            break;
          case 2:
            $account = 'Residential';
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
            break;
          case 3:
            $account = 'Commercial';
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
            break;
            case 5:
            $account = 'contractor';
            $auth_user = User::find($id);
            $technician_infos = TechnicianInfo::where('user_id', '=', $id)->first();
            $location = Location::where('user_id', '=', $id)->first();
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
              $auth_user->gender = $technician_infos->gender;
              $auth_user->charges = $technician_infos->charges;
              $auth_user->currency = $technician_infos->currency;
              $auth_user->city = $technician_infos->city;
              $auth_user->firstName = $technician_infos->firstName;
              $auth_user->lastName = $technician_infos->lastName;
            }else{
              $auth_user->experience = '';
              $auth_user->location = '';
              $auth_user->profile_image = '';
              $auth_user->contact_number = '';
              $auth_user->license = '';
              $auth_user->gender = '';
              $auth_user->charges = '';
              $auth_user->currency = '';
              $auth_user->city = '';
              $auth_user->firstName = '';
              $auth_user->lastName = '';
            }
            break;

          default:
            $account = 'Unset';
            $auth_user = User::find($id);
            break;
            }

        \View::share('auth_user', $auth_user);
        \View::share('account', $account);

        return $next($request);
      });
    }
}
