<?php

namespace App\Http\Controllers\Donor\Auth;

use App\Models\Donor;
use App\Models\DonorPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /*
        |--------------------------------------------------------------------------
        | Password Reset Controller
        |--------------------------------------------------------------------------
        |
        | This controller is responsible for handling password reset emails and
        | includes a trait which assists in sending these notifications from
        | your application to your users. Feel free to explore this trait.
        |
        */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('donor.guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm(): View
    {
        $pageTitle = 'Account Recovery';
        return view('donor.auth.passwords.email', compact('pageTitle'));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('donors');
    }

    public function sendResetCodeEmail(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ]);

        $user = Donor::where('phone', $request->phone)->first();
        if (!$user) {
            return back()->withErrors(['Phone Number Not Available']);
        }

        $code = verificationCode(6);
        $donorPasswordReset = new DonorPasswordReset();
        $donorPasswordReset->phone = $user->phone;
        $donorPasswordReset->token = $code;
        $donorPasswordReset->status = 0;
        $donorPasswordReset->created_at = date("Y-m-d h:i:s");
        $donorPasswordReset->save();

        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();

        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = env('BULKSMS_API');
        $senderid = "8809617612994";
        $number = "88" . $user->phone;

        $sendmess = "From, https://roktodin.com \nYour Verification Code is: " . $code . "";
        $message = "$sendmess";
        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        // sendEmail($user, 'PASS_RESET_CODE', [
        //     'code' => $code,
        //     'operating_system' => $userBrowser['os_platform'],
        //     'browser' => $userBrowser['browser'],
        //     'ip' => $userIpInfo['ip'],
        //     'time' => $userIpInfo['time'],
        //     'name' => $user->name,
        //     'username' => $user->username,
        //     'phone' => $user->phone,
        // ]);
        $pageTitle = 'Account Recovery';
        $notify[] = ['success', 'Password reset email sent successfully'];
        $notify[] = ['success', $response];
        return view('donor.auth.passwords.code_verify', compact('pageTitle', 'notify'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required']);
        $notify[] = ['success', 'You can change your password.'];
        $code = str_replace(' ', '', $request->code);
        return redirect()->route('donor.password.reset.form', $code)->withNotify($notify);
    }
}
