<?php

namespace App\Http\Controllers;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Datasets\Unlabeled;

require_once dirname(__FILE__,4) . '/vendor/autoload.php';
use Illuminate\Http\Request;
use App\Models\dssdata;
use App\Models\benchmark;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class dssPredict extends Controller
{
    function predict($drw){

        $samples = [
            1,2,4998,4999,5000,5001,14998,14999,15000,15001
        ];
        
        $labels = ['1A Special Containment Facility', '1A Special Containment Facility', '1A Special Containment Facility', '1A Special Containment Facility','1B Sanitary Landfill','1B Sanitary Landfill','1B Sanitary Landfill','1B Sanitary Landfill','2B Sanitary Landfill','2B Sanitary Landfill' ];
        $dataset = new Labeled($samples, $labels);

        $estimator = new KNearestNeighbors(1);

        $estimator->train($dataset);
        $samples = [
            $drw
        ];
        
        $dataset = new Unlabeled($samples);
        
        $predictions = $estimator->predict($dataset);
        
        return $predictions;

        /**$Page = "predict";
        return view('dashboard',['Page' => $Page],['number'=>$predictions]);*/
    }
}
