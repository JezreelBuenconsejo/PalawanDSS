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
        
        $labels = ['1A Special Containment Facility', '1A Special Containment Facility', '1A Special Containment Facility', '1A Special Containment Facility','1B Sanitary Landfill','1B Sanitary Landfill','1B Sanitary Landfill','1B Sanitary Landfill','2 Sanitary Landfill','2 Sanitary Landfill' ];
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

    function comment($SA,$MC){
        $dataset = $this->samplesAndLabels();

        $estimator = new KNearestNeighbors(2);

        $estimator->train($dataset);

        $samples = [
            [$SA,$MC]
        ];
        
        $dataset = new Unlabeled($samples);
        
        $predictions = $estimator->predict($dataset);
        
        return $predictions;
    }

    function samplesAndLabels(){
        $samples = [
            [3,2],
            [3,2],
            [3,2],
            [3,2],
            [2.99,2],
            [2.99,2],
            [2.99,2],
            [2.99,2],
            [1,2],
            [1,2],
            [1,2],
            [1,2],
            [3,3],
            [3,3],
            [3,3],
            [3,3],
            [2.99,3],
            [2.99,3],
            [2.99,3],
            [2.99,3],
            [1,3],
            [1,3],
            [1,3],
            [1,3]
        ];
        $labels = [
            'No Comment',
            'No Comment',
            'No Comment',
            'No Comment',
            'Social Acceptability below 3%',
            'Social Acceptability below 3%',
            'Social Acceptability below 3%',
            'Social Acceptability below 3%',
            'Social Acceptability below 3%',
            'Social Acceptability below 3%',
            'Social Acceptability below 3%',
            'Social Acceptability below 3%',
            'Not 1st or 2nd Class Municipality',
            'Not 1st or 2nd Class Municipality',
            'Not 1st or 2nd Class Municipality',
            'Not 1st or 2nd Class Municipality',
            'Not 1st or 2nd Class Municipality and Social Acceptability below 3%',
            'Not 1st or 2nd Class Municipality and Social Acceptability below 3%',
            'Not 1st or 2nd Class Municipality and Social Acceptability below 3%',
            'Not 1st or 2nd Class Municipality and Social Acceptability below 3%',
            'Not 1st or 2nd Class Municipality and Social Acceptability below 3%',
            'Not 1st or 2nd Class Municipality and Social Acceptability below 3%',
            'Not 1st or 2nd Class Municipality and Social Acceptability below 3%',
            'Not 1st or 2nd Class Municipality and Social Acceptability below 3%',
            
        ];
        $dataset = new Labeled($samples, $labels);
        return $dataset;
    }
}
