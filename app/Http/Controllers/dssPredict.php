<?php

namespace App\Http\Controllers;

require_once dirname(__FILE__,4) . '/vendor/autoload.php';
use Illuminate\Http\Request;
use App\Models\dssdata;
use App\Models\benchmark;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Phpml\Classification\SVC;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Dataset\FilesDataset;
use Phpml\FeatureExtraction\StopWords\English;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Metric\Accuracy;
use Phpml\SupportVectorMachine\Kernel;
use Phpml\Tokenization\NGramTokenizer;


class dssPredict extends Controller
{
    function predict(){
        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];
        $classifier = new SVC(Kernel::LINEAR, $cost = 1000);
        $classifier->train($samples,$labels);
        

        $Page = "predict";
        return view('dashboard',['Page' => $Page],['number'=>$classifier->predict([3, 2])]);
    }
}
