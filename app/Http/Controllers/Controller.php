<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $a=Auth::user()->updated_at;
            $date1 = Carbon::now();
            $days = $date1->diffInDays($a);
            if($days>180){
                return redirect('/changed_password')->with('Password Expired!', 'Please change your password!');
            }
            else{
               return $next($request);
            }
        });
    }
}
