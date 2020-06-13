<?php

namespace App\Http\Controllers;

use App\Traits\FunctionTraits;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use FunctionTraits;
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
    public function index(Request $request)
    {
        return view('home');
        //$parameters =   $this->generalFunctions($request);
        //return view('home');
        //return view('dashboard', $parameters);
    }
}
