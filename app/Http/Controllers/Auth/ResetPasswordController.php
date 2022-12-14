<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->guard()->logout();
        $this->middleware('guest');

    }

    public function showResetForm(Request $request, $token = null)
    {
        $records = DB::table('password_resets')->get();
        $email = "";
        foreach ($records as $record) {
            if (Hash::check($token, $record->token)) {
                $email = $record->email;
            }
        }
        if (empty($email)) {
            return redirect(config('app.site_url', '/home'));
        }
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]
        );
    }

}
