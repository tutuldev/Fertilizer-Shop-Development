<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class chartController extends Controller
{
    public function chart()
    {
        return view('backend.charts');
    }
}
