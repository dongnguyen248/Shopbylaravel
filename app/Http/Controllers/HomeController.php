<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Product;

use Illuminate\Http\Request;
// use AuthenticatesUsers {
//     logout as performLogout;
// }

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.admin.homeAdmin');
    }
    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect('trangchu');
    }
    public function profile()
    {
        return view('layouts.profile');
    }
    public function gettypeproduct()
    {
        $productType = new Product();
        $productType = $productType->ProductType();
        return (compact('productType'));
    }
}