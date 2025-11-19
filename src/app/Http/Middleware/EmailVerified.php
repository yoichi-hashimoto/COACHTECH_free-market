<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        $user = Auth::user();
        if (!$user){
            return redirect()->route('login');
        }
        if ($user->email_verified_at === null) {
            $message = 'メール認証が完了していません。認証メールをご確認ください。';
            return redirect()->route('auth')->withErrors($message);
        }
        return $next($request);
    }
}
