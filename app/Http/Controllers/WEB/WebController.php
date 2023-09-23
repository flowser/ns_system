<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function guest()
    {
       return view('layouts/guest');
    }
    public function auth()
    {
       return view('layouts/auth');
    }
}
