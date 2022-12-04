<?php

namespace App\Http\Controllers;

use App\Models\dssdata;
use App\Models\results;
use App\Models\projection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Param;
use App\Http\Controllers\dssController;
class postDataController extends Controller
{
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
        $dssdata ->reduction_efficiency_rating=$req->RER;
        $dssdata ->years=$req->years;
        $dssdata ->diverted_residual_waste=$req->DRW;

        $MunicipalClass = $req->municipalClass;
        $SocialAcceptability = $req->socialAcceptability;

        if($MunicipalClass != null || $MunicipalClass = ""){
            $dssdata ->municipal_classification=$MunicipalClass;
            $dssdata ->social_acceptability=$SocialAcceptability;
        }

        $dssdata ->save();
        return redirect('/decision');

    }

    public function addResults ($req)
    {
        $date = new Carbon($req->CurrentData->date);
        $date = date('Y-m-d H:i:s');
        $dssdata = new results();
        $dssdata->DataID = $req->DID;
        $dssdata->MainResult = $req->Decision->MainDecision[0];
        $dssdata->AlternativeResult = $req->Decision->AlternativeDecision;
        $dssdata->Option1Bio = $req->Options->option1Bio;
        $dssdata->Option1Rec = $req->Options->option1Rec;
        $dssdata->Option2Bio = $req->Options->option2Bio;
        $dssdata->Option2Rec = $req->Options->option2Rec;
        $dssdata->comment = $req->Decision->Comments[0];
        $dssdata->userID = $req->UID;
        $dssdata->date_created = $date;
        
        $dssdata ->save();

    }

    public function addProjections($req){
        $dssdata = new projection();
        $dssdata->DataID = $req->DID;
        $dssdata->userID = $req->UID;
        $dssdata->projected_result = $req->Projection->projectedResult;
        $dssdata->projected_population = $req->Projection->projectedPopulation;
        $dssdata->projected_residual_waste = $req->Projection->projectedRes;
        $dssdata->projected_DRW = $req->Projection->projectedDRW;
        $dssdata->finalDate = $req->Projection->finalDate;
        $dssdata->finalYear = $req->Projection->finalYear;
        $dssdata->comments = $req->Projection->projectedComment;

        $dssdata->save();
    }
}
