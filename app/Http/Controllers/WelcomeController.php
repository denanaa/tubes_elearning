<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show($type)
    {
        return view('welcome', ['type' => $type]);
    }
}