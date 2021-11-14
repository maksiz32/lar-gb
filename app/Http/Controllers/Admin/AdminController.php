<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }
    public function index()
    {
        return view('admin.index');
    }
}
