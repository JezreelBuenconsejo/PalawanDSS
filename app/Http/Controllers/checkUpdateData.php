<?php

namespace App\Http\Controllers;
use App\Models\dssdata;
use App\Models\benchmark;
use App\Models\updateData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

class checkUpdateData extends Controller
{
    function checkDB(){
        $user = Auth::id();
        $updateData = new updateData();
        $results = DB::select('SELECT * FROM updateddata WHERE userID = :user',array('user'=>$user));

        if(count($results) == 0){
            $DataID = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by DataID DESC limit 1',array('user'=>$user));
            foreach($DataID as $data){
                $DID = $data->dataID;
            }
            DB::statement("INSERT INTO `updateddata` (`DataID`, `userID`, `UD2ndBio`, `UD2ndRec`, `UD2ndRes`, `UD2ndSpe`, `UD2ndTotal`, `UD2ndDate`, `UD4thBio`, `UD4thRec`, `UD4thRes`, `UD4thSpe`, `UD4thTotal`, `UD4thDate`, `UD6thBio`, `UD6thRec`, `UD6thRes`, `UD6thSpe`, `UD6thTotal`, `UD6thDate`, `UD8thBio`, `UD8thRec`, `UD8thRes`, `UD8thSpe`, `UD8thTotal`, `UD8thDate`, `UD10thBio`, `UD10thRec`, `UD10thRes`, `UD10thSpe`, `UD10thTotal`, `UD10thDate`) VALUES ( :DataID,:user, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL);",array('user'=>$user,'DataID'=>$DID));
        }

    }
    function viewUpdateData(){
        try{
            $user = Auth::id();
            $check = $this->checkUpdateDate();
            if($check['checkUD'] == 1){
                
                $Page = "updateData";
                return view('dashboard',['Page' => $Page]);
            }
            else{
                
                return redirect('/dashboard');
            }
        }catch(Exception $e){
            abort(404);
        }
        
    }
    function checkUpdateDate(){
    $user = Auth::id();
    // Get the current date
    $currentDate = Carbon::now();

    // Get the date from the database
    $date_created = DB::select('SELECT date_created FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));
    
    $updateData = new updateData();
    
    $secondDate = DB::table('updateddata')->select('UD2ndDate')->where('userID', $user)->get();
    $dateSecond = implode(',', $secondDate->pluck('UD2ndDate')->toArray());

    $fourthDate = DB::table('updateddata')->select('UD4thDate')->where('userID', $user)->get();
    $dateFourth = implode(',', $fourthDate->pluck('UD4thDate')->toArray());

    $sixthDate = DB::table('updateddata')->select('UD6thDate')->where('userID', $user)->get();
    $dateSixth = implode(',', $sixthDate->pluck('UD6thDate')->toArray());

    $eighthDate = DB::table('updateddata')->select('UD8thDate')->where('userID', $user)->get();
    $dateEighth = implode(',', $eighthDate->pluck('UD8thDate')->toArray());


    $databaseDate = Carbon::parse($date_created[0]->date_created);
    // Check if the difference; between the current date and the date from the database is 2 years
        $yrs = 0;
    switch ($currentDate->diffInYears($databaseDate)) {
        case 2:
            if($dateSecond == NULL || $dateSecond == ''){
            $updateData = true;
            $yrs = 2;
            }
            break;
        case 3:
            if($dateSecond == NULL || $dateSecond == ''){
                $updateData = true;
                $yrs = 2;
            }
            break;
        case 4:
            if($dateFourth == NULL || $dateFourth == ''){
                $updateData = true;
                $yrs = 4;
            }
            break;
        case 5:
            if($dateFourth == NULL || $dateFourth == ''){
                $updateData = true;
                $yrs = 4;
            }
            break;            
        case 6:
            if($dateSixth == NULL || $dateSixth == ''){
                $updateData = true;
                $yrs = 6;
            }
            break;
        case 7:
            if($dateSixth == NULL || $dateSixth == ''){
                $updateData = true;
                $yrs = 6;
            }
            break;
        case 8:
            if($dateEighth == NULL || $dateEighth == ''){
                $updateData = true;
                $yrs = 8;
            }
            break;
        case 9:
            if($dateEighth == NULL || $dateEighth == ''){
                $updateData = true;
                $yrs = 8;
            }
            break;
        case 10:
            $updateData = true;
            $yrs = 10;
            break;
        default:  
                $updateData = false;
                $yrs = 1;
    }

        $UD = array('checkUD' => $updateData, 'checkyrs' => $yrs);
        return $UD;
    }

    function retrieveData(){
        $user = Auth::id();
        $updateData = DB::select('SELECT * FROM `updateddata` WHERE userID = :user ORDER BY updatedDataID DESC LIMIT 1',array('user'=>$user));
        return $updateData;
    }
}
