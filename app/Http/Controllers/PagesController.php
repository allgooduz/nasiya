<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function shops()
    {
        return view('front.shops');
    }

    public function myclients()
    {
        return view('merchant.myclients');
    }

    public function clientorderPhone()
    {
        return view('clientorder.phone');
    }

    public function clientorderShow()
    {
        return view('clientorder.show');
    }

    public function scoring()
    {
        return view('merchant.scoring');
    }
}
