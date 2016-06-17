<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
      return view('index');
    }

    public function welcome()
    {
      return view('welcome');
    }

    public function about()
    {
      return view('about');
    }

    public function contact()
    {
      return view('contact');
    }

}