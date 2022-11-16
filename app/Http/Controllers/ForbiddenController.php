<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForbiddenController extends Controller
{
    public function index()
    {
        return view('forbidden');
    }
}
