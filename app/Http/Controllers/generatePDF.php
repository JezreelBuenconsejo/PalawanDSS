<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\viewData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class generatePDF extends Controller
{
    public function generatePDF()
    {
        $viewData = new viewData();
        $user = Auth::id();

            //check update data
            $check = new checkUpdateData();
            $check->checkDB();
            $updateData = $check->checkUpdateDate();

            $UData = $check->retrieveData();
            
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
            if($SA == '' || $SA == null || $SA == ' '){
                $SA = "not required for the Main Result";
            }
            if($MC == '' || $MC == null || $MC == ' '){
                $MC = "not required for the Main Result";
            }
            $currentData = array("bio"=>$bio,'rec'=>$rec,'res'=>$res,'spe'=>$spe,'total'=>$total,'gr'=>$gr,'pop'=>$pop,'drw'=>$drw,'date'=>$date,'time'=>$time,'rer'=>$rer,'SA'=>$SA,'MC'=>$MC);
            
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
            $estimationTotal = $viewData->estimation($pop);
            $estimationPerCapita = $viewData->estimationPerCapita();
            $randomId = Str::random(10);
            $today = Carbon::now('Asia/Shanghai');
            $today = $today->format('F j, Y h:i A');
            $pdfData = array('randID'=> $randomId, 'dateIssued'=>$today);
    
            $results = array('UData'=>$UData,'pdfData'=>$pdfData,"CurrentData" => $currentData, "DSSResults" => $mainResult,"projections"=>$projections,"estimationTotal"=>$estimationTotal,"estimationPerCapita"=>$estimationPerCapita);
    
    
            $resultsEncode = json_encode($results);
            $res = json_decode($resultsEncode);
            
            /*$Page = "generatePDF";
            return view('dashboard', ['Page' => $Page], ['res' => $res]);*/
            
            $data = [
                'title' => 'Report Generation',
                'content' => 'Report Generated by Palawan Eco Waste DSS',
                'res' => $res
            ];
        
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('generatePDF', $data);
            $pdfContent = $pdf->output();
            Mail::send([], [], function ($message) use ($pdfContent) {
                $message->to('b.jezreel@yahoo.com')
                        ->subject('DSS Waste Report')
                        ->attachData($pdfContent, 'DSSWasteReport.pdf');
            });
            return $pdf->download('DSSWasteReport.pdf');
            
    }
}
