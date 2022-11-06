<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dssController extends Controller
{
    function postData(Request $req){
        return $req->input();
    }
}
