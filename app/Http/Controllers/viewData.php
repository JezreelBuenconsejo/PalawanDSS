<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class viewData extends Controller
{
    //
    //viewing what page in dashboard
    function whatToView(){
        $user = Auth::id();
        $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));

        //if no data available for the user
        if($dssData == []){
            $Page = "dssData";
            return view('dashboard',['Page' => $Page]);
        }
        else{
            $Page = "monitoringPage";
            return view('dashboard',['Page' => $Page]);
        }
    }

    function viewResults(){
        //retrieve data in database
        $user = Auth::id();
        $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));

        //if no data available for the user
        if($dssData == []){

            $Page = "NoData"; 
            return view('dashboard',['Page' => $Page]);
        }

        $bio = ''; $rec=''; $res = ''; $spe = ''; $total=''; $drw = ''; $rer = ''; $pop = ''; $gr = '';$date = '';$time = '';$SA='';$MC='';
        foreach($dssData as $data){
            $bio = $data->biodegradable;
            $rec = $data->recyclable;
            $res = $data->residual;
            $spe = $data->special;
            $total = $data->total_waste;
            $drw = $data->diverted_residual_waste;
            $rer = $data->reduction_efficiency_rating;
            $time = $data->years;
            $pop = $data->population;
            $gr = $data->growth_rate;
            $date = $data->date_created;
            $SA = $data->social_acceptability;
            $MC = $data->municipal_classification;
        }
        $currentData = array("bio"=>$bio,'rec'=>$rec,'res'=>$res,'spe'=>$spe,'total'=>$total,'gr'=>$gr,'pop'=>$pop,'drw'=>$drw,'date'=>$date);
        
        $dssResults = DB::select('SELECT * FROM `results` WHERE userID = :user ORDER by date_created DESC limit 1',array('user'=>$user));
        $mainRes = ''; $altRes = ''; $op1Bio = ''; $op1Rec = ''; $op2Bio = ''; $op2Rec = ''; $comment = ''; $dateCreated = '';
        foreach($dssResults as $data){
            $mainRes = $data->MainResult;
            $altRes = $data->AlternativeResult;
            $op1Bio = $data->Option1Bio;
            $op1Rec = $data->Option1Rec;
            $op2Bio = $data->Option2Bio;
            $op2Rec = $data->Option2Rec;
            $comment = $data->comment;
            $dateCreated = $data->date_created;
        }
        $mainResult = array("mainRes" => $mainRes, "altRes"=>$altRes,"op1Bio"=>$op1Bio,"op1Rec"=>$op1Rec,"op2Bio"=>$op2Bio,"op2Rec"=>$op2Rec,"comment"=>$comment,"dateCreated"=>$dateCreated,"time"=> $time);

        $dssProjections = DB::select('SELECT * FROM `projection` WHERE userID = :user ORDER by start_date DESC limit 1',array('user'=>$user));
        $projectedResult = '';$projectedPop = '';$projectedRes = '';$projectedDRW = '';$startDate = '';$finalDate = ''; $finalYear = ''; $projectedComments = '';
        foreach($dssProjections as $data){
            $projectedResult = $data->projected_result;
            $projectedPop = $data->projected_population;
            $projectedRes = $data->projected_residual_waste;
            $projectedDRW = $data->projected_DRW;
            $startDate = $data->start_date;
            $finalDate = $data->finalDate;
            $finalYear = $data->finalYear;
            $projectedComments = $data->comments;
        }
        $projections = array("projectedResult"=>$projectedResult,"projectedPop"=>$projectedPop,"projectedRes"=>$projectedRes,"projectedDRW"=>$projectedDRW,"startDate"=>$startDate,"finalDate"=>$finalDate,"finalYear"=>$finalYear,"projectedComments"=>$projectedComments);


        //estimation (for display purposes)
        $estimationTotal = $this->estimation($pop);
        $estimationPerCapita = $this->estimationPerCapita();

        $results = array("CurrentData" => $currentData, "DSSResults" => $mainResult,"projections"=>$projections,"estimationTotal"=>$estimationTotal,"estimationPerCapita"=>$estimationPerCapita);


        $resultsEncode = json_encode($results);
        $res = json_decode($resultsEncode);

        $Page = "result";
        return view('dashboard', ['Page' => $Page], ['res' => $res]);
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
}
