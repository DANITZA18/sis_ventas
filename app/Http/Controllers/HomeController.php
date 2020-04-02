<?php

namespace sis_ventas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use sis_ventas\Empresa;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresa = Empresa::first();
        return view('home',compact('empresa'));
    }
}
