<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function index()
    {
        return view('includes.sidebar', [
            "data" => "anhari"
        ]);
    }
}
