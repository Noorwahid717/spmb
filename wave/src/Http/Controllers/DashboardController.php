<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SpmbConfig;
// use Wave\SpmbConfig;


class DashboardController extends Controller
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
        $spmb_config = SpmbConfig::where('id',1)->first();
        // dd($spmb_config);
        return view('theme::dashboard.index',array(
            "spmb_config"=>$spmb_config
        ));
    }
}
