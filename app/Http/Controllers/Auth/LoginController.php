<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\SellerCompany;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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

    public function username()
    {
        $request = request();
        // return 'email';
        if ($request->input('phone_number', '')) {
            $usernameField = 'phone_number';
        } else {
            $usernameField = 'email';
        }
        return $usernameField;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
    */
    protected function credentials(Request $request)
    {
        $username = $request->input($this->username());
        if ($this->username() == 'phone_number') {
            $username = Helper::reformatPhone($username);
            $isActive = SellerCompany::where('phone_number', $username)->first();
            if($isActive->status != 1)
            {
                $username = "99999999";
            }
            $token = $this->getBearer($request);
            Session::put('bearerToken', $token);
            Session::save();
        }



        return [$this->username() => $username, 'password' => $request->input('password')];
    }

    public function getBearer(Request $request)
    {
        $headersBearer = [
            'Accept' => 'application/json',
        ];

        $username = $request->input($this->username());
        $reformattedPhone = Helper::reformatPhone($username);

        $bodyBearer = [
            'phone_number' => $reformattedPhone,
            'password' => $request->input('password'),
            'device_name' => 'Device name'
        ];

        $responseBearer = Http::withHeaders($headersBearer)->post('https://allgood.uz/api/merchant/sanctum/token', $bodyBearer);
        $responseBearer = $responseBearer->json();

        $token = $responseBearer['access_token'];

        return $token;
    }
}
