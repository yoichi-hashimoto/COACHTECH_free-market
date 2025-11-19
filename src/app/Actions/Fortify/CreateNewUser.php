<?php

namespace App\Actions\Fortify;

use App\Http\Requests\RegisterRequest;
use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $request = app(RegisterRequest::class);
        
        Validator::make(
            $input,
            $request->rules(),
            $request->messages(),
            $request->attributes()
        )->validate();

        $token = Str::random(64);
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'email_token' => $token,
        ]);

        Mail::to($user->email)->send(
        new AuthMail($user, $token)
        );


        return $user;    
    }  
}
