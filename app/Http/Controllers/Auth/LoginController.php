<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        $user = $this->guard()->attempt($credentials, $request->filled('remember'));

        if ($user) {
            $user = $this->guard()->user();
            if ($user->status === 'blocked') {
                $this->guard()->logout();
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login was unsuccessful, we need to determine if the user is blocked
        $credentials = $this->credentials($request);
        $user = User::where($credentials)->first();

        if ($user && $user->status === 'blocked') {
            return redirect()->back()
                ->withErrors(['status' => 'Your account has been blocked. Please contact the administrator.']);
        }

        // If the login failed and the user is not blocked, we send the default failed response
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended($this->redirectPath());
    }
}