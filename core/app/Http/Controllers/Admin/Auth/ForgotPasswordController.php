<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use App\Models\AdminPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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
        $this->middleware('admin.guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $pageTitle = 'Account Recovery';
        return view('admin.auth.passwords.email', compact('pageTitle'));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    public function sendResetCodeEmail(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ]);

        $user = Admin::where('phone', $request->phone)->first();
        if (!$user) {
            return back()->withErrors(['Phone Not Available']);
        }

        $code = verificationCode(6);
        $adminPasswordReset = new AdminPasswordReset();
        $adminPasswordReset->phone = $user->phone;
        $adminPasswordReset->token = $code;
        $adminPasswordReset->status = 0;
        $adminPasswordReset->created_at = date("Y-m-d h:i:s");
        $adminPasswordReset->save();

        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();

        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = env('BULKSMS_API');
        $senderid = "8809617612994";
        $number = "88" . $user->phone;

        $sendmess = "From, https://roktodin.com \nAdmin Verification Code is: " . $code . "";
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

        $pageTitle = 'Account Recovery';
        $notify[] = ['success', 'Password reset email sent successfully'];
        $notify[] = ['success', $response];
        return view('admin.auth.passwords.code_verify', compact('pageTitle', 'notify'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required']);
        $notify[] = ['success', 'You can change your password.'];
        $code = str_replace(' ', '', $request->code);
        return redirect()->route('admin.password.reset.form', $code)->withNotify($notify);
    }
}
