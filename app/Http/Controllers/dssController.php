<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dssdata;
use Illuminate\Support\Facades\Auth;
class dssController extends Controller
{
    function dataInput(){
        $Page = "dssData";
        return view('dashboard',['Page' => $Page]);
    }

    function addData(Request $req){
        $userID = Auth::id();
        $dssdata = new dssdata;
        $dssdata ->email=$req->email;
        $dssdata ->user_id=$userID;
        $dssdata ->biodegradable=$req->biodegradable;
        $dssdata ->recyclable=$req->recyclable;
        $dssdata ->residual=$req->residual;
        $dssdata ->special=$req->special;
        $dssdata ->total_waste=$req->totalWaste;
        $dssdata ->population=$req->population;
        $dssdata ->growth_rate=$req->growthRate;
        $dssdata ->land_area=$req->landArea;
        $dssdata ->r1=$req->r1;
        $dssdata ->r2=$req->r2;
        $dssdata ->years=$req->years;
        $dssdata ->diverted_residual_waste=$req->DRW;

        $MunicipalClass = $req->municipalClass;
        $SocialAcceptability = $req->socialAcceptability;

        if($MunicipalClass != null || $MunicipalClass = ""){
            $dssdata ->municipal_classification=$MunicipalClass;
            $dssdata ->social_acceptability=$SocialAcceptability;
        }

        $dssdata ->save();
        return $req->input();

    }


}
