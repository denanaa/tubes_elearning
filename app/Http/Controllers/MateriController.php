<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function show($type)
    {
        return view('materi', ['type' => $type]);
    }
}