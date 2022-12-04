<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dssdata;
use App\Models\benchmark;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\dssPredict;
use App\Http\Controllers\postDataController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class dssController extends Controller
{
    

    //result
    public function result(){
        //retrieve data in database
        $user = Auth::id();
        $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));

        //if no data available for the user
        if($dssData == []){

            $Page = "NoData"; 
            return view('dashboard',['Page' => $Page]);
        }

        //retrieval of data
        $bio = ''; $rec=''; $res = ''; $spe = ''; $total=''; $drw = ''; $rer = ''; $pop = ''; $gr = '';$date = '';$SA='';$MC='';
        $dataID = '';
        $userID = '';
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
            $SA = $data->social_acceptability;
            $MC = $data->municipal_classification;
            $userID = $data->user_id;
            $dataID = $data->dataID;
        }
        $currentData = array("bio"=>$bio,'rec'=>$rec,'res'=>$res,'spe'=>$spe,'total'=>$total,'gr'=>$gr,'pop'=>$pop,'drw'=>$drw,'date'=>$date);
        
        //estimation (for display purposes)
        $estimationTotal = $this->estimation($pop);
        $estimationPerCapita = $this->estimationPerCapita();
       
        //option calculation
        $options = $this->options($bio,$rec,$estimationTotal['estimatedBio'],$estimationTotal['estimatedRec']);

        //decision
        $decision = array("MainDecision"=>' ',"AlternativeDecision"=>' ',"Comments"=>' ');
        $dssPredict = new dssPredict();
        $decision['MainDecision'] = $dssPredict->predict($drw);

        //comment
        if($SA != NULL || $MC != NULL){
        $Comment = $dssPredict->comment($SA,$MC);
            if($Comment[0] != 'No Comment'){
                $decision['Comments'] = $Comment;
                $decision['AlternativeDecision'] = "Ecology Center with Category 1A Special Containment Facility";
            }
        }

        //projection
        $projection = $this->projection($total,$pop,$res,$date,$time,$gr,$rer,$SA,$MC);

        //organizing results to add to DB and display to the user
        $results = array("UID"=>$userID,"DID"=>$dataID,'Options'=>$options,"Decision"=>$decision,'Projection'=>$projection,'CurrentData'=>$currentData);

        $resultsEncode = json_encode($results);
        $res = json_decode($resultsEncode);

        //adding to database
        (new postDataController)->addResults($res);
        (new postDataController)->addProjections($res);

        //forwarding to frontend
        return redirect('/result');
    }
    /*public function decision($drw){
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
    }*/
    public function projection($total,$totalPop,$totalRes,$currentDate,$years,$gr,$rer,$SA,$MC){
        $actualWastePerCapita = $total / $totalPop;
        $actualResidualPercentage = $totalRes / $total;
        $projectedPop = $totalPop; //initial Population
        $date = new Carbon($currentDate);
        $currentYear = $date->year;
        $finalYear = $currentYear + $years;
        $finalDate = $date->addYear($years);
        $finalDate = date('Y-m-d H:i:s');
        
        $projectedRes = '';
        $projectedDRW = '';

        for($i = $currentYear; $i < $finalYear;$i++){
            $projectedPop = $projectedPop + ($projectedPop * ($gr/100));
            $projectedRes = ($projectedPop * $actualWastePerCapita) * $actualResidualPercentage;
            $projectedDRW = $projectedRes - ($projectedRes * ($rer/100));
        }

        $projectedPop = round($projectedPop);
        $projectedRes = round($projectedRes,3);
        $projectedDRW = round($projectedDRW,3);

        $projectedDecision = array("MainDecision"=>'',"AlternativeDecision"=>' ',"Comments"=>' ');
        $dssPredict = new dssPredict();
        $projectedDecision['MainDecision'] = $dssPredict->predict($projectedDRW);

        if($projectedDecision['MainDecision'][0] != '1A Special Containment Facility'){
            if($SA != NULL || $MC != NULL){
                $projectedComment = $dssPredict->comment($SA,$MC);
                if($projectedComment[0] != 'No Comment'){
                    $projectedDecision['Comments'] = $projectedComment;
                }
            }
            else{
                $projectedDecision['Comments'] = array("Must conduct Social Acceptability Study and Municipality should be atleast 2nd Class Municipality");
            }
        }
        
        $projection = array('projectedResult'=>$projectedDecision['MainDecision'][0],'projectedComment'=>$projectedDecision['Comments'][0],'finalYear'=>$finalYear,'years'=>$years,'projectedPopulation'=>$projectedPop,'projectedRes'=>$projectedRes,'projectedDRW'=>$projectedDRW,'finalDate'=>$finalDate);

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

