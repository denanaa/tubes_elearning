<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($type)
    {
        return view('video', ['type' => $type]);
    }
}