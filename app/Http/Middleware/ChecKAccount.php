<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Closure;
use App\User;
use App\Balance;
use App\Mail\EmployerMail;

class ChecKAccount
{
    /**
     * Handle an incoming request.
     * validate url segment
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = Auth::id();
        $check_user = User::find($id);
        $check_balance = Balance::where('user_id', '=', $id)->get();

        if(count($check_balance) == 0){
          $balance = new Balance;
          $balance->balance = 0;
          $balance->user_id = $id;
          $balance->account_type = $check_user->account_type;
          $balance->save();
        }

        if($check_user->account_type == 1){

          /*
          * technician check
          */
          if(request()->segments(1)[1] != 'technician'){
            return redirect('/redirect_dashboard');
          }
          if($check_user->verfication == 1){
            if(request()->segments(1)[0] != 'dashboard'){
              return redirect('/dashboard/technician')->with('status', 'Account has not been verify, Hold for admin to verify your license');
            }
          }
          /*
          * technician check
          */

        }else if($check_user->account_type == 2){

          /*
          * residential check
          */
          if(request()->segments(1)[1] != 'residential'){
            return redirect('/redirect_dashboard');
          }
          /*if($check_user->verfication == 1){
            Mail::to(Auth::user()->email)->send(new EmployerMail());
            if(request()->segments(1)[0] != 'dashboard'){
              return redirect('/dashboard/residential')->with('status', 'Account has not been verify, Check your email to verify');
            }
          }*/
          /*
          * residential check
          */

        }else if($check_user->account_type == 3){

          /*
          * commercial check
          */
          if(request()->segments(1)[1] != 'commercial'){
            return redirect('/redirect_dashboard');
          }
          /*if($check_user->verfication == 1){
            Mail::to(Auth::user()->email)->send(new EmployerMail());
            if(request()->segments(1)[0] != 'dashboard'){
              return redirect('/dashboard/commercial')->with('status', 'Account has not been verify');
            }
          }*/
          /*
          * commercial check
          */

        }else if($check_user->account_type == 5){
            /*
          * technician check
          */
          if(request()->segments(1)[1] != 'contractor'){
            return redirect('/redirect_dashboard');
          }
          if($check_user->verfication == 1){
            if(request()->segments(1)[0] != 'dashboard'){
              return redirect('/dashboard/contractor')->with('status', 'Account has not been verify, Hold for admin to verify your license');
            }
          }
          /*
          * technician check
          */
        }
        return $next($request);

    }
}
