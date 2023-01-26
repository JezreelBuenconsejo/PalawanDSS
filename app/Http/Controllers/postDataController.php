<?php

namespace App\Http\Controllers;

use App\Models\dssdata;
use App\Models\results;
use App\Models\projection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Param;
use App\Http\Controllers\dssController;
use App\Http\Controllers\checkUpdateData;
use App\Models\updateData;

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
        $dssdata ->years=10;
        $dssdata ->diverted_residual_waste=$req->DRW;

        $MunicipalClass = $req->municipalClass;
        $SocialAcceptability = $req->socialAcceptability;

        if($MunicipalClass != null || $MunicipalClass = ""){
            $dssdata ->municipal_classification=$MunicipalClass;
            $dssdata ->social_acceptability=$SocialAcceptability;
        }

        $dssdata ->save();
        $DataID = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by DataID DESC limit 1',array('user'=>$userID));
        
        $updateData = new updateData();
        foreach($DataID as $data){
            $DID = $data->dataID;
        }
        DB::statement("INSERT INTO `updateddata` (`DataID`, `userID`, `UD2ndBio`, `UD2ndRec`, `UD2ndRes`, `UD2ndSpe`, `UD2ndTotal`, `UD2ndDate`, `UD4thBio`, `UD4thRec`, `UD4thRes`, `UD4thSpe`, `UD4thTotal`, `UD4thDate`, `UD6thBio`, `UD6thRec`, `UD6thRes`, `UD6thSpe`, `UD6thTotal`, `UD6thDate`, `UD8thBio`, `UD8thRec`, `UD8thRes`, `UD8thSpe`, `UD8thTotal`, `UD8thDate`, `UD10thBio`, `UD10thRec`, `UD10thRes`, `UD10thSpe`, `UD10thTotal`, `UD10thDate`) VALUES (:DataID, :user, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL);",array('user'=>$userID,'DataID'=>$DID));


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

    public function addInputUpdate(Request $req){
        
        $currentDate = Carbon::now();
        $userID = Auth::id();
        $check = new checkUpdateData();
        $checkYRS = $check->checkUpdateDate();
        if($checkYRS['checkyrs'] == 2){
            $UID = DB::select("SELECT `updatedDataID` FROM `updateddata` WHERE userID = :id ORDER by `updatedDataID`DESC LIMIT 1",array('id'=>$userID));
            DB::select("UPDATE `updateddata` SET `UD2ndBio` = :bio, `UD2ndRec` = :rec, `UD2ndRes` = :res, `UD2ndSpe` = :spe, `UD2ndTotal` = :total, `UD2ndDate` = :secDate WHERE `updateddata`.`updatedDataID` = :id  ORDER BY updatedDataID DESC LIMIT 1",array('id'=>$UID[0]->updatedDataID, 'bio'=>$req->biodegradable,'rec'=>$req->recyclable,'res'=>$req->residual,'spe'=>$req->special,'total'=>$req->totalWaste,'secDate'=>$currentDate));
        }
        else if($checkYRS['checkyrs'] == 4){
            $UID = DB::select("SELECT `updatedDataID` FROM `updateddata` WHERE userID = :id ORDER by `updatedDataID`DESC LIMIT 1",array('id'=>$userID));
            DB::select("UPDATE `updateddata` SET `UD4thBio` = :bio, `UD4thRec` = :rec, `UD4thRes` = :res, `UD4thSpe` = :spe, `UD4thTotal` = :total, `UD4thDate` = :fourthDate WHERE `updateddata`.`updatedDataID` = :id  ORDER BY updatedDataID DESC LIMIT 1",array('id'=>$UID[0]->updatedDataID, 'bio'=>$req->biodegradable,'rec'=>$req->recyclable,'res'=>$req->residual,'spe'=>$req->special,'total'=>$req->totalWaste,'fourthDate'=>$currentDate));

        }
        else if($checkYRS['checkyrs'] == 6){
            $UID = DB::select("SELECT `updatedDataID` FROM `updateddata` WHERE userID = :id ORDER by `updatedDataID`DESC LIMIT 1",array('id'=>$userID));
            DB::select("UPDATE `updateddata` SET `UD6thBio` = :bio, `UD6thRec` = :rec, `UD6thRes` = :res, `UD6thSpe` = :spe, `UD6thTotal` = :total, `UD6thDate` = :sixthDate WHERE `updateddata`.`updatedDataID` = :id  ORDER BY updatedDataID DESC LIMIT 1",array('id'=>$UID[0]->updatedDataID, 'bio'=>$req->biodegradable,'rec'=>$req->recyclable,'res'=>$req->residual,'spe'=>$req->special,'total'=>$req->totalWaste,'sixthDate'=>$currentDate));

        }
        else if($checkYRS['checkyrs'] == 8){
            $UID = DB::select("SELECT `updatedDataID` FROM `updateddata` WHERE userID = :id ORDER by `updatedDataID`DESC LIMIT 1",array('id'=>$userID));
            DB::select("UPDATE `updateddata` SET `UD8thBio` = :bio, `UD8thRec` = :rec, `UD8thRes` = :res, `UD8thSpe` = :spe, `UD8thTotal` = :total, `UD8thDate` = :eigthDate WHERE `updateddata`.`updatedDataID` = :id  ORDER BY updatedDataID DESC LIMIT 1",array('id'=>$UID[0]->updatedDataID, 'bio'=>$req->biodegradable,'rec'=>$req->recyclable,'res'=>$req->residual,'spe'=>$req->special,'total'=>$req->totalWaste,'eigthDate'=>$currentDate));

        }
        else if($checkYRS['checkyrs'] == 10){
            $UID = DB::select("SELECT `updatedDataID` FROM `updateddata` WHERE userID = :id ORDER by `updatedDataID`DESC LIMIT 1",array('id'=>$userID));
            DB::select("UPDATE `updateddata` SET `UD10thBio` = :bio, `UD10thRec` = :rec, `UD10thRes` = :res, `UD10thSpe` = :spe, `UD10thTotal` = :total, `UD10thDate` = :tenthDate WHERE `updateddata`.`updatedDataID` = :id  ORDER BY updatedDataID DESC LIMIT 1",array('id'=>$UID[0]->updatedDataID, 'bio'=>$req->biodegradable,'rec'=>$req->recyclable,'res'=>$req->residual,'spe'=>$req->special,'total'=>$req->totalWaste,'tenthDate'=>$currentDate));

        }
        return redirect('/monitoringPage');
    }
}
