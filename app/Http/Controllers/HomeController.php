<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {

         /*dd(Auth::id(),Auth::user()->email);*/
             /*dd(Auth::check());*/
        return view('home');
    }

    public function about()
    {

         /*dd(Auth::id(),Auth::user()->email);*/
             /*dd(Auth::check());*/
        return view('about');
    }
}
