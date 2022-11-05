<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SslWireless\SslWirelessSms;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Captcha;

class PasswordResetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = [
            'title' => 'Reset Password'
        ];

        return view('reset_password/index')->with($params);
    }

    public function search_user(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'g-recaptcha-response'=> new Captcha(),

        ]);

        $username = $request->username;

        $get_user_info = DB::table('users')
            ->select('users.*','outlets.contact_details')
            ->join('outlets', 'outlets.id', '=', 'users.store_id')
            ->where('users.username', '=', $username)
            ->get();

        // echo '<pre>'; print_r($get_user_info);die;
        if ($get_user_info->count() > 0) {
            $data = array();
            foreach ($get_user_info as $info) {
                $data['user_id'] = $info->id;
                $data['username'] = $info->username;
                $data['contact_number'] = $info->contact_details;
            }

            $params = [
                'title' => 'Reset Password',
                'userInfo' => $data
            ];

            return view('reset_password/reset')->with($params);
        } else {
            $params = [
                'title' => 'Reset Password'
            ];
            return redirect()->back()->with('msg', 'You can not reset password. Please contact to your administrator');   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //generate random password
        function generate_password($length)
        {
            $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' .
                '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';

            $str = '';
            $max = strlen($chars) - 1;

            for ($i = 0; $i < $length; $i++)
                $str .= $chars[random_int(0, $max)];

            return $str;
        }

        // echo Hash::make(generate_password(8));die;

        try {

            $mobile_number = $request->mobile_number;
            // echo $mobile_number;die;

            $new_password = generate_password(8);
            // echo '<pre>';print_r($new_password);die;

            // $user_id = $request->username;
            // echo '<pre>';print_r($user_id);die;
            $obj_user = $request->username;
            // echo '<pre>';print_r($obj_user);die;
            // $obj_user->password = Hash::make($new_password);
            User::where('username', $obj_user)->update(array('password' => Hash::make($new_password)));
            // echo '<pre>';print_r($obj_user);die;
            // $obj_user->save();

            if (isset($mobile_number)) {
                // username, password, sid provided by sslwireless
                $username = env("SMS_USERNAME", null);
                $password = env("SMS_PASSWORD", null);
                $sid = env("SMS_SID", null);
                $SslWirelessSms = new SslWirelessSms($username, $password, $sid);
                // // You can change the api url if needed. i.e.
                // $SslWirelessSms->setUrl('new_url');
                $SslWirelessSms->send($mobile_number, 'Password has been changed successfully for User ID: ' . $obj_user . '. Your new password is: ' . $new_password . ' . Please login with new password.');

                // dd($output);
            }

            // Auth::logout();
            // Session::flush();
            // return redirect()->route('login');
            return back()->with('msg', 'A new password has sent to your mobile number.');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
