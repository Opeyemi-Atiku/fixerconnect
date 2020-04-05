<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite as Socialite;
use Illuminate\Support\Facades\Auth;

use App\User;

class SocialAUthController extends Controller
{
  /**
   * facebook social login.
   *
   * @return \Illuminate\Http\Response
   */
  public function facebook()
  {
      return Socialite::driver('facebook')->redirect();
  }

  /**
   * google social login.
   *
   * @return \Illuminate\Http\Response
   */
  public function google()
  {
    /*
    * redirect main homepage with google session to return google login
    */
      return redirect('/')->with('session', 'google');
  }

  /**
   * facebook callback.
   *
   * @return \Illuminate\Http\Response
   */
  public function facebookCallback()
  {
    try{
      $facebook = Socialite::driver('facebook')->stateless()->user();
    }catch(Exception $e){
      return redirect('/');
    }
    $email = $facebook->getEmail();
    if($email == ''){
      return redirect('/user/register')->with('error_email', 'no email is link to your account');
    }
    $checkIfEmailExist = $this->checkIfEmailExist($email);
    if($checkIfEmailExist == 0){
      $store = $this->storeCredentials($facebook);
      if($store != false){
        Auth::login($store);
        return redirect('/set_account_password');
      }
      return redirect('/user/register')->with('error', 'Unknown error occured');
    }
    return redirect('/user/register')->with('error_email', 'email has been taken');
  }

  /**
   * google callback.
   *
   * @return \Illuminate\Http\Response
   */
  public function googleCallback()
  {
    try{
      $google = Socialite::driver('google')->stateless()->user();
    }catch(Exception $e){
      return redirect('/');
    }
    $email = $google->getEmail();
    $checkIfEmailExist = $this->checkIfEmailExist($email);

    if($checkIfEmailExist == 0){
      $store = $this->storeCredentials($google);
      if($store != false){
        Auth::login($store);
        return redirect('/set_account_password');
      }
      return redirect('/user/register')->with('error', 'Unknown error occured');
    }
    return redirect('/user/register')->with('error_email', 'email has been taken');
  }

  /**
   * check email
   *
   * @return \Illuminate\Http\Response
   */
  public function checkIfEmailExist($email)
  {
    $user = User::where('email', '=', $email)->get();
    return count($user);
  }

  /**
   * store credential
   *
   * @return \Illuminate\Http\Response
   */
  public function storeCredentials($user)
  {
    $user = User::create([
      'name' => $user->getName(),
      'email' => $user->getEmail(),
    ]);
    if($user){
      return $user;
    }
    return false;
  }

  /**
   * set passowrd and account type
   *
   * @return \Illuminate\Http\Response
   */
  public function setAccountPassword()
  {
    return view('source_file.Dashboard.account_password');
  }

  /**
   * set passowrd and account type
   *
   * @return \Illuminate\Http\Response
   */
  public function saveAccountPassword(Request $request)
  {
    $this->validate($request, [
      'account' => 'required',
      'password' => 'required|min:6|confirmed',
    ]);

    /*
    * check account selected
    * if valid and update user acccount type
    */
    $account = (int)$request->input('account');
    $password = bcrypt($request->input('password'));

    if($account === 1 || $account === 2 || $account === 3){
      $update = User::where('id', '=', Auth::id())->update([
        'account_type' => $account,
        'password' => $password
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
}
