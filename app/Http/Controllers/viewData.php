<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\checkUpdateData;
use App\Models\updateData;
    use Dompdf\Dompdf;
    use Barryvdh\DomPDF\Facade as PDF;

class viewData extends Controller
{
    //
    //viewing what page in dashboard
    function whatToView(){
        $user = Auth::id();
        $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));
        /*$Page = "dssData";
        return view('dashboard',['Page' => $Page]);*/
        //if no data available for the user
        if($dssData == []){
            $Page = "dssData";
            return view('dashboard',['Page' => $Page]);
        }
        else{
            return redirect('/monitoringPage');
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
        $currentData = array("bio"=>$bio,'rec'=>$rec,'res'=>$res,'spe'=>$spe,'total'=>$total,'gr'=>$gr,'pop'=>$pop,'drw'=>$drw,'date'=>$date,'time'=>$time);
        
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
        $estBio = round($estTotal * ($benchBio/100),3);
        $estRec = round($estTotal * ($benchRec/100),3);
        $estRes = round($estTotal * ($benchRes/100),3);
        $estSpe = round($estTotal * ($benchSpe/100),3);
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

    //view and calculate data to be shown in Monitoring Page
    function viewMonitoringPage(){
        $user = Auth::id();

        //check update data
        $check = new checkUpdateData();
        $check->checkDB();
        $updateData = $check->checkUpdateDate();

        $UData = $check->retrieveData();
        
        //initial data
        $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));
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
        $initialInput = array("bio"=>$bio,'rec'=>$rec,'res'=>$res,'spe'=>$spe,'total'=>$total,'gr'=>$gr,'pop'=>$pop,'drw'=>$drw,'date'=>$date,'time'=>$time);
        

        //inital results
        $dssResults = DB::select('SELECT * FROM `results` WHERE userID = :user ORDER by date_created DESC limit 1',array('user'=>$user));
        $mainRes = ''; $altRes = ''; $op1Bio = ''; $op1Rec = ''; $op2Bio = ''; $op2Rec = ''; $comment = ''; $dateCreated = '';
        foreach($dssResults as $data){
            $mainRes = $data->MainResult;
            $dateCreated = $data->date_created;
            $altRes = $data->AlternativeResult;

        }
        $dateCreated = new Carbon($dateCreated);
        $startYear = $dateCreated->year;
        $showAltRes = false;
        if($altRes == " " || $altRes == null){
            $showAltRes = false;
        }
        else{
            $showAltRes = true;
        }
        $initialResult = array("mainRes" =>"Category ". $mainRes, "altRes"=>$altRes,"startYear" => $startYear, "showAltRes"=>$showAltRes);

        //projected results
        $dssProjections = DB::select('SELECT * FROM `projection` WHERE userID = :user ORDER by start_date DESC limit 1',array('user'=>$user));
        $projectedResult = '';$projectedPop = '';$projectedRes = '';$projectedDRW = '';$startDate = '';$finalDate = ''; $finalYear = ''; $projectedComments = '';
        foreach($dssProjections as $data){
            $projectedResult = $data->projected_result;
            $projectedPop = $data->projected_population;
            $projectedRes = $data->projected_residual_waste;
            $projectedDRW = $data->projected_DRW;
            $finalDate = $data->finalDate;
            $finalYear = $data->finalYear;
        }
        $projections = array("projectedResult"=>"Category ".$projectedResult,"projectedPop"=>$projectedPop,"projectedRes"=>$projectedRes,"projectedDRW"=>$projectedDRW,"finalYear"=>$finalYear);

        //progress bar
        $curYear = date('Y');
        $totalYear = $finalYear - $startYear;
        $yrspassed = $curYear - $startYear;
        $percent = ($yrspassed / $totalYear) * 100;

        //Date parsing for line chart
        //initial year
        $startMonth = $dateCreated->format("M");
        $initialDate = $startMonth . "-" . $startYear;
        //final year
        $finalDate = new Carbon($finalDate);
        $finalMonth = $finalDate->format("M");
        $finalD = $finalMonth . '-' . $finalYear;
        //current year
        $currentMonth = date("M");
        $currentYear = date("Y");
        $currentDate = $currentMonth . '-' . $currentYear;

        $dates = array("initialDate" => $initialDate,"finalDate"=>$finalD,"currentDate"=>$currentDate);

        //current projections
        $currentProjections = $this->current_projections($total,$res,$pop,$gr,$rer,$dateCreated);

        //waste date
        $waste = $this->total_waste($bio, $rec, $res, $spe, $total, $pop, $gr,$dateCreated,$time);

        $result = array('UData'=>$UData,"updateData"=>$updateData,"initialInput"=>$initialInput,"initialResult" => $initialResult,"projections"=>$projections, "progress" => $percent,"dates"=>$dates,"currentProjections"=>$currentProjections,"waste"=>$waste);
        
        $resultsEncode = json_encode($result);
        $res = json_decode($resultsEncode);
        $Page = "monitoringPage";
        return view('dashboard', ['Page' => $Page], ['res' => $res]);
    }

    function current_projections($totalWaste,$residual,$pop,$gr,$rer,$initialDate){
        $intInitialMonth = $initialDate->format('n'); // 12
        $intInitialYear = $initialDate->format('Y'); // 2022

        $intCurrentMonth = date('n'); // 1
        $intCurrentYr = date('Y'); // 2023
        $intCurrentYear = ($intCurrentYr - $intInitialYear) * 12; // 12
        $intCurrentDate = $intCurrentMonth + $intCurrentYear; // 13

        $actualWastePerCapita = $totalWaste / $pop;
        $actualResidualPercentage = $residual / $totalWaste;
        $projectedPop = $pop; //initial Population
        
        $projectedRes = '';
        $projectedDRW = '';

        $monthlyGR = pow((1+ ($gr/100)),(1/12))-1;

        if($intInitialMonth != $intCurrentDate){
            for($i = $intInitialMonth; $i < $intCurrentDate; $i++){
                $projectedPop = $projectedPop + ($projectedPop * $monthlyGR);
                $projectedRes = ($projectedPop * $actualWastePerCapita) * $actualResidualPercentage;
                $projectedDRW = $projectedRes - ($projectedRes * ($rer/100));
            }
    
            $projectedPop = round($projectedPop);
            $projectedRes = round($projectedRes,3);
            $projectedDRW = round($projectedDRW,3);
        }
        else{
            $projectedPop = $pop;
            $projectedRes = $residual;
            $projectedDRW = round($projectedRes - ($projectedRes * ($rer/100)),2);
        }
        

        $CP = array("projectedPop" => $projectedPop, "projectedRes" => $projectedRes, "projectedDRW" => $projectedDRW);

        return $CP;
/*
        $intFinalMonth = $finalDate->format('n'); // 12
        $intFinalYear = $years * 12; //120
        $intFinalDate = $intFinalMonth + $intFinalYear; //132
*/
    }

    function total_waste($bio,$rec,$res,$spe,$total,$pop,$gr,$startDate,$years){
        $startMonth = $startDate->format('n'); // 12
        $startYear = $startDate->format('Y');
        $finalYear = $startYear + $years;

        $wastePerCapita = $total / $pop;
        $bioPercent = round($bio / $total,3);
        $recPercent = round($rec / $total,3);
        $resPercent = round($res / $total,3);
        $spePercent = round($spe / $total,3);
        

        $pbio = $bio;
        $prec = $rec;
        $pres = $res;
        $pspe = $spe;
        $ptotal = 0;
        $ppop = $pop;
        for ($i = intval($startYear); $i < $finalYear; $i++){
            $ppop = $ppop + ($ppop * ($gr/100));
            $pbio = ($ppop * $wastePerCapita) * $bioPercent;
            $prec = ($ppop * $wastePerCapita) * $recPercent;
            $pres = ($ppop * $wastePerCapita) * $resPercent;
            $pspe = ($ppop * $wastePerCapita) * $spePercent;
            $ptotal = $pbio + $prec + $pres + $pspe;
        }



        $sYear = new Carbon($startDate);
        $intCurrentMonth = date('n'); // 1
        $intCurrentYr = date('Y'); // 2023
        $intCurrentYear = ($intCurrentYr - $sYear->year) * 12; // 12
        $intCurrentDate = $intCurrentMonth + $intCurrentYear; // 13

        $cbio = '';
        $crec = '';
        $cres = '';
        $cspe = '';
        $ctotal = 0;
        $cpop = $pop;
        
        $monthlyGR = pow((1+ ($gr/100)),(1/12))-1;
        if($startMonth != $intCurrentDate){
            for($i = $startMonth; $i < $intCurrentDate; $i++){
                $cpop = $cpop + ($cpop * $monthlyGR);
                $cbio = ($cpop * $wastePerCapita) * $bioPercent;
                $crec = ($cpop * $wastePerCapita) * $recPercent;
                $cres = ($cpop * $wastePerCapita) * $resPercent;
                $cspe = ($cpop * $wastePerCapita) * $spePercent;
                $ctotal = $cbio + $crec + $cres + $cspe;
            }
        } 
        else 
        {
            $cbio = $bio;
            $crec = $rec;
            $cres = $res;
            $cspe = $spe;
            $ctotal = $total;
        }

        $CW = array("ibio"=>$bio,"irec"=>$rec,"ires"=>$res,"ispe"=>$spe,"itotal"=>$total,"cbio"=>round($cbio,3),"crec"=>round($crec,3),"cres"=>round($cres,3),"cspe"=>round($cspe,3),"ctotal"=>round($ctotal,3),"pbio"=>round($pbio,3),"prec"=>round($prec,3),"pres"=>round($pres,3),"pspe"=>round($pspe,3),"ptotal"=>round($ptotal,3));
        return $CW;
    }

public function generatePDF()
{
    $user = Auth::id();

        //check update data
        $check = new checkUpdateData();
        $check->checkDB();
        $updateData = $check->checkUpdateDate();

        $UData = $check->retrieveData();
        
        //initial data
        $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));
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
        $initialInput = array("bio"=>$bio,'rec'=>$rec,'res'=>$res,'spe'=>$spe,'total'=>$total,'gr'=>$gr,'pop'=>$pop,'drw'=>$drw,'date'=>$date,'time'=>$time);
        

        //inital results
        $dssResults = DB::select('SELECT * FROM `results` WHERE userID = :user ORDER by date_created DESC limit 1',array('user'=>$user));
        $mainRes = ''; $altRes = ''; $op1Bio = ''; $op1Rec = ''; $op2Bio = ''; $op2Rec = ''; $comment = ''; $dateCreated = '';
        foreach($dssResults as $data){
            $mainRes = $data->MainResult;
            $dateCreated = $data->date_created;
            $altRes = $data->AlternativeResult;

        }
        $dateCreated = new Carbon($dateCreated);
        $startYear = $dateCreated->year;
        $showAltRes = false;
        if($altRes == " " || $altRes == null){
            $showAltRes = false;
        }
        else{
            $showAltRes = true;
        }
        $initialResult = array("mainRes" =>"Category ". $mainRes, "altRes"=>$altRes,"startYear" => $startYear, "showAltRes"=>$showAltRes);

        //projected results
        $dssProjections = DB::select('SELECT * FROM `projection` WHERE userID = :user ORDER by start_date DESC limit 1',array('user'=>$user));
        $projectedResult = '';$projectedPop = '';$projectedRes = '';$projectedDRW = '';$startDate = '';$finalDate = ''; $finalYear = ''; $projectedComments = '';
        foreach($dssProjections as $data){
            $projectedResult = $data->projected_result;
            $projectedPop = $data->projected_population;
            $projectedRes = $data->projected_residual_waste;
            $projectedDRW = $data->projected_DRW;
            $finalDate = $data->finalDate;
            $finalYear = $data->finalYear;
        }
        $projections = array("projectedResult"=>"Category ".$projectedResult,"projectedPop"=>$projectedPop,"projectedRes"=>$projectedRes,"projectedDRW"=>$projectedDRW,"finalYear"=>$finalYear);

        //progress bar
        $curYear = date('Y');
        $totalYear = $finalYear - $startYear;
        $yrspassed = $curYear - $startYear;
        $percent = ($yrspassed / $totalYear) * 100;

        //Date parsing for line chart
        //initial year
        $startMonth = $dateCreated->format("M");
        $initialDate = $startMonth . "-" . $startYear;
        //final year
        $finalDate = new Carbon($finalDate);
        $finalMonth = $finalDate->format("M");
        $finalD = $finalMonth . '-' . $finalYear;
        //current year
        $currentMonth = date("M");
        $currentYear = date("Y");
        $currentDate = $currentMonth . '-' . $currentYear;

        $dates = array("initialDate" => $initialDate,"finalDate"=>$finalD,"currentDate"=>$currentDate);

        //current projections
        $currentProjections = $this->current_projections($total,$res,$pop,$gr,$rer,$dateCreated);

        //waste date
        $waste = $this->total_waste($bio, $rec, $res, $spe, $total, $pop, $gr,$dateCreated,$time);

        $result = array('UData'=>$UData,"updateData"=>$updateData,"initialInput"=>$initialInput,"initialResult" => $initialResult,"projections"=>$projections, "progress" => $percent,"dates"=>$dates,"currentProjections"=>$currentProjections,"waste"=>$waste);
        
        $resultsEncode = json_encode($result);
        $res = json_decode($resultsEncode);
        $data = [
            'title' => 'Sample PDF File',
            'content' => 'This is a sample PDF file generated from Laravel.',
            'res' => $res
        ];
    
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('generatePDF', $data);
    
        return $pdf->download('sample.pdf');
}

}
