<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function showAuth(){
        return view('auth');
    }

    public function sendAuth(Request $request){
    $user = User::where('email', $request->email)->firstOrFail();
    $token = Str::random(64);
    $user->email_token = $token;
    $user->save();
    Mail::to($request->email)->send(new AuthMail($user, $token));
        if(count(Mail::failures())>0){
            $message = 'メール送信に失敗しました';
            return back() ->withErrors($message);
        }
        else{
            $message = 'メールを送信しました';
            return redirect()->route('auth.show')->with(compact('message'));
        }
    }

    public function verify($token){
        $user = User::where('email_token', $token)->first();

        if($user){
            $user->email_verified_at = now();
            $user->email_token = null;
            $user->save();

            $message = 'メール認証が完了しました。プロフィールを登録してください。';
            return redirect()->route('profile.edit')->with(compact('message'));
        } else {
            $message = '無効な認証リンクです。もう一度認証メールを送信してください。';
            return redirect()->route('verification.notice')->withErrors($message);
        }
    }

    public function check(Request $request){
        $user = $request->user();
        if ($user->email_verified_at !== null){
            return redirect()->route('profile.edit');
        }else{
            return redirect()->route('verification.notice')->withErrors('メール認証が完了していません。認証メールをご確認ください。');
        }
    }

    public function resend(Request $request){
        $user = $request->user();
        if ($user->email_verified_at !== null) {
            return redirect()->route('profile.edit')->with('message', '既にメール認証は完了しています。');
        }
        $token = Str::random(64);
        $user->email_token = $token;
        $user->save();

        Mail::to($user->email)->send(
            new AuthMail($user, $token)
        );
        return redirect()->route('verification.notice')->with('message', '認証メールを再送しました。');
    }
}
