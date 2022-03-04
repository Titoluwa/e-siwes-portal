<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function schoolreg()
    {
        return view('auth.register2');
    }
    public function industryreg()
    {
        return view('auth.register3');
    }
}
