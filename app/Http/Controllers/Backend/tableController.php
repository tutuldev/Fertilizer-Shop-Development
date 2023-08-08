<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class tableController extends Controller
{
    public function table()
    {
        return view('backend.tables');
    }
}
