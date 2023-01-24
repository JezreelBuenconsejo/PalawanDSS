<?php

namespace App\Http\Controllers;
use App\Models\dssdata;
use App\Models\benchmark;
use App\Models\updateData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
            DB::statement("INSERT INTO `updateddata` (`DataID`, `userID`, `2ndBio`, `2ndRec`, `2ndRes`, `2ndSpe`, `2ndTotal`, `2ndDate`, `4thBio`, `4thRec`, `4thRes`, `4thSpe`, `4thTotal`, `4thDate`, `6thBio`, `6thRec`, `6thRes`, `6thSpe`, `6thTotal`, `6thDate`, `8thBio`, `8thRec`, `8thRes`, `8thSpe`, `8thTotal`, `8thDate`, `10thBio`, `10thRec`, `10thRes`, `10thSpe`, `10thTotal`, `10thDate`) VALUES ( :DataID,:user, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', '0', NULL);",array('user'=>$user,'DataID'=>$DID));
        }

    }
    function viewUpdateData(){
    $user = Auth::id();
        $checkUD = new checkUpdateData();
        if($checkUD == true){
            $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));
            $Page = "updateData";
            return view('dashboard',['Page' => $Page]);
        }
        else{
            
            return redirect('/dashboard');
        }
    }
    function checkUpdateDate(){
    $user = Auth::id();
    // Get the current date
    $currentDate = Carbon::now();

    // Get the date from the database
    $date_created = DB::select('SELECT date_created FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));
    
    $updateData = new updateData();
    
    $secondDate = DB::table('updateddata')->select('2ndDate')->where('userID', $user)->get();
    $dateSecond = implode(',', $secondDate->pluck('2ndDate')->toArray());

    $fourthDate = DB::table('updateddata')->select('4thDate')->where('userID', $user)->get();
    $dateFourth = implode(',', $fourthDate->pluck('4thDate')->toArray());

    $sixthDate = DB::table('updateddata')->select('6thDate')->where('userID', $user)->get();
    $dateSixth = implode(',', $sixthDate->pluck('6thDate')->toArray());

    $eighthDate = DB::table('updateddata')->select('8thDate')->where('userID', $user)->get();
    $dateEighth = implode(',', $eighthDate->pluck('8thDate')->toArray());

    

    $databaseDate = Carbon::parse($date_created[0]->date_created);
    // Check if the difference; between the current date and the date from the database is 2 years
    switch ($currentDate->diffInYears($databaseDate)) {
        case 2:
            $updateData = true;
            break;
        case 3:
            if($dateSecond == NULL || $dateSecond == ''){
                $updateData = true;
            }
            break;
        case 4:
            $updateData = true;
            break;
        case 5:
            if($dateFourth == NULL || $dateFourth == ''){
                $updateData = true;
            }
            break;            
        case 6:
            $updateData = true;
            break;
        case 7:
            if($dateSixth == NULL || $dateSixth == ''){
                $updateData = true;
            }
            break;
        case 8:
            $updateData = true;
            break;
        case 9:
            if($dateEighth == NULL || $dateEighth == ''){
                $updateData = true;
            }
            break;
        case 10:
            $updateData = true;
            break;
        default:  
                $updateData = false;
    }
        return $updateData;
    }
}
