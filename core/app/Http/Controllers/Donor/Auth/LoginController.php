<?php

namespace App\Http\Controllers\Donor\Auth;

use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\Verifytoken;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = 'donor/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
        $this->middleware('donor.guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(): View
    {
        $pageTitle = "Donor Login";
        // if (!session()->has('url.intended')) {
        //     session(['url.intended' => url()->previous()]);
        // }
        return view('donor.auth.login', compact('pageTitle'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('donor');
    }

    public function phone()
    {
        return 'phone';
    }

    public function login(Request $request)
    {
        $get_user = Donor::where('phone', $request->phone)->first();

        if ($get_user) {
            $credentials = [
                'phone' => $request->phone,
                'password' => $request->password,
            ];


            if ($get_user->is_activated == 1) {
                if ($this->attemptLogin($request)) {
                } else {
                    $notify[] = ['warning', 'Phone No. and password not match! try forgot password'];
                    return redirect()->back()->withNotify($notify);
                }
            } else {
                $notify[] = ['error', 'Donar Not Found! Please Create an Account!'];
                return redirect()->back()->withNotify($notify);
            }

            $this->validateLogin($request);
            $lv = @getLatestVersion();
            $general = GeneralSetting::first();
            if (@systemDetails()['version'] < @json_decode($lv)->version) {
                $general->sys_version = $lv;
            } else {
                $general->sys_version = null;
            }
            $general->save();
        } else {

            dd('passhere');

            $pageTitle = "Phone Verification";
            $validToken = verificationCode(6);
            $get_token = new Verifytoken();
            $get_token->token = $validToken;
            $get_token->phone = $request->phone;
            $get_token->save();

            // Send SMS to Donor
            // $url = "http://bulksmsbd.net/api/smsapi";
            // $api_key = env('BULKSMS_API');
            // $senderid = "8809617612994";
            // $number = "88" . $request->phone;

            // $sendmess = "From, https://roktodin.com \nYour Verification Code is: " . $validToken . "";
            // $message = "$sendmess";
            // $data = [
            //     "api_key" => $api_key,
            //     "senderid" => $senderid,
            //     "number" => $number,
            //     "message" => $message
            // ];

            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // $response = curl_exec($ch);
            // curl_close($ch);

            $notify[] = ['success', 'Your Requested Submitted'];
            // $notify[] = ['success', $response];
            return view($this->activeTemplate . 'otp_verification', compact('pageTitle'));
        }

                // return redirect()->route('donor.dashboard');


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request)
    {
        $this->guard('donor')->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }

    public function resetPassword()
    {
        $pageTitle = 'Account Recovery';
        return view('donor.reset', compact('pageTitle'));
    }

    protected function credentials(Request $request)

    {
        return array_merge($request->only($this->phone(), 'password'));
    }
}
