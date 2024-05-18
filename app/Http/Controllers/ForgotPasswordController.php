<?php

namespace App\Http\Controllers;

use App\Models\PasswordResets;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function create($token) {

        $passwordReset = PasswordResets::where('token', $token)->first();

        if ($passwordReset) {
            if (Carbon::now()->gt($passwordReset->expires_at)) {
                // الـ token انتهى
                return redirect()->route('password.sendLink')
                    ->with([
                        "message" => [
                            "type" => "error",
                            "title" => "لقد انتهى الوقت المخصص لإعادة تعيين كلمة السر",
                            "text" => "يرجى المحاولة مرة اخرى"
                        ]
                    ]);
            } else {
                return view('site.auth.Reset Password.newPasswordView', compact('passwordReset'));
            }
        } else {
            return redirect()->route('password.sendLink');
        }

    }
    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('password.sendLink')
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "حدث خطأ ما",
                        "text" => "يرجى التأكد من بريدك الإلكتروني"
                    ]
                ]);
        }
        else {
            $passwordReset = PasswordResets::where("email", $user->email)->first();
            if($passwordReset) {
                if (Carbon::now()->gt($passwordReset->expires_at)) {
                    // الـ token انتهى
                    $passwordReset->destroy('email', $user->email);

                    $token = sha1(time().$user->email);
                    PasswordResets::create([
                        'email' => $user->email,
                        'token' => $token,
                        'expires_at' => Carbon::now()->addMinutes(2),
                    ]);;

                    // Send email
                    Mail::to($user->email)->send(new ResetPasswordEmail($user));
                    $msg = 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني';
                    return view('site.auth.Reset Password.mailSuccess', compact('msg'));
                }
                return redirect()->route('password.sendLink')
                    ->with([
                        "message" => [
                            "type" => "error",
                            "title" => "لقد تم ارسال رسالة الى برديك",
                            "text" => "يرجى التحقق من بريدك او المحاولة في وقت لاحق"
                        ]
                    ]);
            } else {
                $token = sha1(time().$user->email);
                PasswordResets::create([
                    'email' => $user->email,
                    'token' => $token,
                    'expires_at' => Carbon::now()->addMinutes(2),
                ]);;

                // Send email
                Mail::to($user->email)->send(new ResetPasswordEmail($user));
                $msg = 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني';
                return view('site.auth.Reset Password.mailSuccess', compact('msg'));
            }
        }


    }

    public function resetPassword(Request $request) {
        try {
            $validatedData = $request->validate([
                "token" => ['required'],
                'password' => ['required'],
                'confirm' => ['required'],
            ]);
            $passwordReset = PasswordResets::where('token', $request->token)->first();
            if($passwordReset) {
                $user = $passwordReset->getUser();
                $user->password = Hash::make($request->password);
                $user->save();

                Auth::login($user);
                return redirect(RouteServiceProvider::HOME);
            }
        } catch (ValidationException $e) {
            return redirect()->route('password.sendLink');
        }
    }

//    public function errorPage($msg) {
//        return view('site.Pages.error', compact('msg'));
//    }
}
