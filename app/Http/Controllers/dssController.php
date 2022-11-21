<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dssdata;
use App\Models\benchmark;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class dssController extends Controller
{
    //viewing what page in dashboard
    function dataInput(){
        $Page = "dssData";
        return view('dashboard',['Page' => $Page]);
    }

    //add data
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
        return redirect('/result');

    }

    //result
    public function result(){
        $user = Auth::id();
        $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));

        if($dssData == []){

            $Page = "NoData"; 
            return view('dashboard',['Page' => $Page]);
        }

        $bio = ''; $rec=''; $res = ''; $spe = ''; $total=''; $drw = ''; $rer = ''; $pop = ''; $gr = '';$date = '';
        foreach($dssData as $data){
            $bio = $data->biodegradable;
            $rec = $data->recyclable;
            $res = $data->residual;
            $spe = $data->special;
            $total = $data->total_waste;
            $drw = $data->diverted_residual_waste;
            $rer = $data->reduction_efficiency_rating;
            $pop = $data->population;
            $gr = $data->growth_rate;
            $time = $data->years;
            $date = $data->date_created;
        }
        $currentData = array("bio"=>$bio,'rec'=>$rec,'res'=>$res,'spe'=>$spe,'total'=>$total,'gr'=>$gr,'pop'=>$pop);
        
        $estimationTotal = $this->estimation($pop);
        $estimationPerCapita = $this->estimationPerCapita();
        
        $options = $this->options($bio,$rec,$estimationTotal['estimatedBio'],$estimationTotal['estimatedRec']);

        $decision = $this->decision($drw);
        
        $projection = $this->projection($total,$pop,$res,$date,$time,$gr,$rer);

        $results = array('Total'=>$estimationTotal,'PerCapita'=>$estimationPerCapita,'Options'=>$options,'Decision'=>$decision,'Projection'=>$projection,'CurrentData'=>$currentData);
        $resultsEncode = json_encode($results);
        $res = json_decode($resultsEncode);

        $Page = "result"; 
        return view('dashboard',['Page' => $Page],['res'=>$res]); 
    }
    public function decision($drw){
        $decision = '';
        if($drw <= 4999){
            $decision = "Ecology Center with Category 1A Special Containment Facility";
        }
        else if($drw >= 5000 && $drw <= 15000){
            $decision = "Ecology Center with Category 1B Sanitary Landfill";
        }
        else{
            $decision = "Ecology Center with Category 2B Sanitary Landfill";
        }
        return $decision;
    }
    public function projection($total,$totalPop,$totalRes,$currentDate,$years,$gr,$rer){
        $actualWastePerCapita = $total / $totalPop;
        $actualResidualPercentage = $totalRes / $total;
        $projectedPop = $totalPop; //initial Population
        $date = new Carbon($currentDate);
        $currentYear = $date->year;
        $finalYear = $currentYear + $years;

        $projectedRes = '';
        $projectedDRW = '';

        for($i = $currentYear; $i <= $finalYear;$i++){
            $projectedPop = $projectedPop + ($projectedPop * ($gr/100));
            $projectedRes = ($projectedPop * $actualWastePerCapita) * $actualResidualPercentage;
            $projectedDRW = $projectedRes - ($projectedRes * ($rer/100));
        }

        $projectedPop = round($projectedPop);
        $projectedRes = round($projectedRes,3);
        $projectedDRW = round($projectedDRW,3);

        $projectedResult = '';
        if($projectedDRW <= 4999){
            $projectedResult = "Ecology Center with Category 1A Special Containment Facility";
        }
        else if($projectedDRW >= 5000 && $projectedDRW <= 15000){
            $projectedResult = "Ecology Center with Category 1B Sanitary Landfill";
        }
        else{
            $projectedResult = "Ecology Center with Category 2B Sanitary Landfill";
        }

        $projection = array('projectedResult'=>$projectedResult,'finalYear'=>$finalYear,'years'=>$years,'projectedPopulation'=>$projectedPop,'projectedRes'=>$projectedRes,'projectedDRW'=>$projectedDRW);

        return $projection;
    }
    function estimation($pop){
        $benchmark = DB::select('SELECT * FROM `benchmark` ORDER by date_created DESC limit 1');
        $benchBio = ''; $benchRec = ''; $benchRes = ''; $benchSpe = ''; $benchTotal = '';
        foreach($benchmark as $data){
            $benchBio = $data->biodegradable;
            $benchRec = $data->recyclable;
            $benchRes = $data->residual;
            $benchSpe = $data->special;
            $benchTotal = $data->total;
        }
        $estBio = ''; $estRec = ''; $estRes = ''; $estSpe = ''; $estTotal = '';
        $estTotal = $pop * $benchTotal;
        $estBio = round($estTotal * ($benchBio/100),2);
        $estRec = round($estTotal * ($benchRec/100),2);
        $estRes = round($estTotal * ($benchRes/100),2);
        $estSpe = round($estTotal * ($benchSpe/100),2);
        $benchmarkArr = array('estimatedBio'=>$estBio,'estimatedRec'=>$estRec,'estimatedRes'=>$estRes,'estimatedSpe'=>$estSpe,'estimatedTotal'=>$estTotal);
        return $benchmarkArr;
    }
    function estimationPerCapita(){
        $benchmark = DB::select('SELECT * FROM `benchmark` ORDER by date_created DESC limit 1');
        $benchBio = ''; $benchRec = ''; $benchRes = ''; $benchSpe = ''; $benchTotal = '';
        foreach($benchmark as $data){
            $benchBio = $data->biodegradable;
            $benchRec = $data->recyclable;
            $benchRes = $data->residual;
            $benchSpe = $data->special;
            $benchTotal = $data->total;
        }
        $perCapitaBio = round($benchTotal * ($benchBio/100),3);
        $perCapitaRec = round($benchTotal * ($benchRec/100),3);
        $perCapitaRes = round($benchTotal * ($benchRes/100),3);
        $perCapitaSpe = round($benchTotal * ($benchSpe/100),3);

        $perCapita = array('perCapitaBio'=>$perCapitaBio,'percentBio'=>$benchBio,'perCapitaRec'=>$perCapitaRec,'percentRec'=>$benchRec,'perCapitaRes'=>$perCapitaRes,'percentRes'=>$benchRes,'perCapitaSpe'=>$perCapitaSpe,'percentSpe'=>$benchSpe,'perCapitaTotal'=>$benchTotal);
        return $perCapita;
    }
    public function options($aBio,$aRec,$eBio,$eRec){
        $option1Bio = $aBio * 0.5;
        $option1Rec = $aRec * 0.5;
        $option2Bio=''; $option2Rec='';
        if($aBio > $eBio){
            $option2Bio = $aBio - $eBio;
        }
        else{
            $option2Bio = "N/A";
        }
        
        if($aRec > $eRec){
            $option2Rec = $aRec - $eRec;
        }
        else{
            $option2Rec = "N/A";
        }

        $options = array('option1Bio'=>$option1Bio,'option1Rec'=>$option1Rec,'option2Bio'=>$option2Bio,'option2Rec'=>$option2Rec);

        return $options;
    }
    public function records(){
        $user = Auth::id();
        $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user',array('user'=>$user));
        $Page = "records";
        return view('dashboard',['Page' => $Page])->with(compact('dssData'));
    }

}

