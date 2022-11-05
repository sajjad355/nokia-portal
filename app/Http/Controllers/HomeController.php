<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        if($user->hasRole('salescenter')){
            return redirect()->route('sales.create');
        }else if($user->hasRole(['servicepoint','callcenter'])){
            return redirect()->route('servicepoint.index');
        }else if($user->hasRole(['supadmin', 'admin' , 'subadmin'])){
            return redirect()->route('head');
        }else if($user->hasRole('insurance')){
            return redirect()->route('ins_sales');
        }else{
            return view('home');
        }
    }

}
