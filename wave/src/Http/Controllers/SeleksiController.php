<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Models\SpmbStep;


class SeleksiController extends Controller
{
    public function index()
    {
        if(!auth()->guest() && auth()->user()->role_id==3){
            return view('theme::seleksi.index',array(
                
            ));
        }else{
            return abort(404);
        }
    }
}
