<?php

namespace App\Http\Controllers;
use App\Models\dssdata;
use App\Models\benchmark;
use App\Models\updateData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class checkUpdateData extends Controller
{
    function checkDB(){
        $user = Auth::id();
        
    }
    function viewUpdateData(){
    $user = Auth::id();
    $dssData = DB::select('SELECT * FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));
        $Page = "updateData";
        return view('dashboard',['Page' => $Page]);
    }
    function checkUpdateDate(){
    $user = Auth::id();
    // Get the current date
    $currentDate = Carbon::now();

    // Get the date from the database
    $date_created = DB::select('SELECT date_created FROM `dssdata` WHERE user_id = :user ORDER by date_created DESC limit 1',array('user'=>$user));
    
    $updateData = new updateData();
    
    $secondDate = DB::select('SELECT `2ndDate` FROM `updateddata` WHERE userID = :user ORDER by `updatedDataID` DESC limit 1',array('user'=>$user));
    $dateSecond = implode($secondDate);
    $fourthDate = DB::select('SELECT `4thDate` FROM `updateddata` WHERE userID = :user ORDER by `updatedDataID` DESC limit 1',array('user'=>$user));
    $dateFourth = implode($fourthDate);
    $sixthDate = DB::select('SELECT `6thDate` FROM `updateddata` WHERE userID = :user ORDER by `updatedDataID` DESC limit 1',array('user'=>$user));
    $dateSixth = implode($sixthDate);
    $eighthDate = DB::select('SELECT `8thDate` FROM `updateddata` WHERE userID = :user ORDER by `updatedDataID` DESC limit 1',array('user'=>$user));
    $dateEigth = implode($eighthDate);
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
            if($dateEigth == NULL || $dateEigth == ''){
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
