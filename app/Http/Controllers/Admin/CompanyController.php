<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthorizationController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends AuthorizationController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function showSettings(){
        if(Auth::user()->hasRole(1)) {
            return view('admin.settings');
        }
        return view('404');
    }
}
