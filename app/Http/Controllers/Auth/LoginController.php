<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer as BaconQrCodeWriter;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use App\Http\Controllers\Auth\toastr;

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

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // $remember_me = $request->has('remember_me') ? true : false;
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
        //     $user = Auth::user();
        // }

        $user = User::where($this->username(), '=', $request->email)->first();

        if (password_verify($request->password, optional($user)->password)) {
            $this->clearLoginAttempts($request);

            // $user->update(['google2fa_secret' => (new Google2FA)->generateSecretKey()]);

            $urlQR = $this->createUserUrlQR($user);
            return view("auth.2fa", compact('urlQR', 'user'));
        }

        $this->incrementLoginAttempts($request);
        toastr()->success('Success Message');
        return $this->sendFailedLoginResponse($request);
    }

    public function createUserUrlQR($user)
    {
        $google2fa = app('pragmarx.google2fa');

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );


        return $QR_Image;
    }

    public function login2FA(Request $request, User $user)
    {
        $request->validate(['code_verification' => 'required']);

        if ((new Google2FA())->verifyKey($user->google2fa_secret, $request->code_verification)) {
            $request->session()->regenerate();

            Auth::login($user);

            return redirect()->intended($this->redirectPath());
        }

        return redirect()->back()->withErrors(['error' => 'Código de verificación incorrecto']);
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('/login');
    }
}
