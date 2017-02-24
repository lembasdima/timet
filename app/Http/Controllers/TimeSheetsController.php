<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

class TimeSheetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTimeSheets()
    {
        return view('/time/timesheets');
    }
}
