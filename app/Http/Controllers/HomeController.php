<?php

namespace App\Http\Controllers;

use App\EraYear;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

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
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        return redirect('standard');
    }


    public function postShow(Request $request)
    {
        $era_years = EraYear::all();

        $firstStart = $request->firstStart;
        $secondStart = $request->secondStart;
        $include = $request->include;
        $setting = $request->setting;
        return view('standard.index', compact('era_years', 'firstStart', 'secondStart', 'include', 'setting'));
    }
}
