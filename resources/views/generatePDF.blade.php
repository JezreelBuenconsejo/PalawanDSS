
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eco DSS') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    
    <script src="assets/js/chart.min.js"></script>
    <!-- Scripts -->
    <!--@vite(['resources/sass/app.scss', 'resources/js/app.js'])-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/assets/js/result.js"></script>
</head>
<body>
<link rel="stylesheet" href="assets/css/generatePDF.css">

  <!--<h4>Report Details</h4>
  <h5>Results</h5>
  <span id="mainRes">Main Result: {{$res->DSSResults->mainRes}}</span> <br>
  <span id="altRes">Alternative Result: {{$res->DSSResults->altRes}}</span>
  <h6>Collection Options</h6>
  <span>Option 1: Collect 50% (Amount in kg/day)</span> <br>
  <span>Biodegradable: {{$res->DSSResults->op1Bio}} kg per day</span> <br>
  <span>Recyclable: {{$res->DSSResults->op1Rec}} kg per day</span><br>
  <span>Option 2: Collect in excess of the estimation (amount in KG/Day)</span> <br>
  <span>Biodegradable: {{$res->DSSResults->op1Bio}} kg per day</span> <br>
  <span>Recyclable: {{$res->DSSResults->op1Rec}} kg per day</span>
  <h5>Projections</h5> -->
<div class="container card shadow border-start-primary py-2 text-dark" style="margin-bottom: 40px; font-family: Nunito, sans-serif;">
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 6px;">
            <h2>Palawan Decision Support System for Ecological Center of Island Municipalities</h2>
            <span id="reportID">Report ID: {{$res->pdfData->randID}}</span> <br>
            <span id="dateIssued">Date Generated: {{$res->pdfData->dateIssued}}</span> <br>
            <span id="User">User: {{ Auth::user()->name }} </span>
        </div>
    </div>
</div>
<h2 class="text-center text-uppercase fw-bold" style="margin: 8px; font-family: Nunito, sans-serif;">Results</h2>
    <div class="container card shadow border-start-primary py-2 text-dark" style="margin-bottom: 40px; font-family: Nunito, sans-serif;">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 6px;">
                <h3 id="" style="font-weight:700">Main Result: Ecology Center with Category {{$res->DSSResults->mainRes}}</h3>
                <h5 id=""style="font-weight:700">Alternative Result: {{$res->DSSResults->altRes}}</h5>
                <h5 id="" style="color: red">{{$res->DSSResults->comment}}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 12px;">
                <h3 id="option1">Option 1: Collect 50% (amount in KG/Day)</h3>
                <h5 id="option1Bio">Biodegradable: {{$res->DSSResults->op1Bio}}</h5>
                <h5 id="option1Rec">Recyclable: {{$res->DSSResults->op1Rec}}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 id="option1">Option 2: Collect in excess of the estimation (amount in KG/Day)</h3>
                <h5 id="option2Bio">Biodegradable: {{$res->DSSResults->op2Bio}}</h5>
                <h5 id="option2Rec">Recyclable: {{$res->DSSResults->op2Rec}}</h5>
            </div>
        </div>
    </div>
    <h3 class="text-center text-uppercase fw-bold" style="margin: 8px;font-family: Nunito, sans-serif;">Projections</h3>
    <div class="container card shadow border-start-primary py-2 text-dark" style="margin-bottom: 20px; font-family: Nunito, sans-serif;">
        <div class="row">
            <div class="col-md-12">
                <h3 id="projectedResult">Ecology Center with Category {{$res->projections->projectedResult}} in {{$res->projections->finalYear}} ({{$res->DSSResults->time}} years)</h3>
                <h6 id="projectedComment" style="color: red">{{$res->projections->projectedComments}}</h6>
            
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="projectedPopulation">
                <h5>Projected Population: {{$res->projections->projectedPop}}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 id="projectedRes">Projected Residual Waste: {{$res->projections->projectedRes}} KG/Day</h5>
                <h5 id="projectedDRW">Projected Diverted Residual Waste: {{$res->projections->projectedDRW}} KG/Day</h5>
            </div>
        </div>
    </div>
    
    <div class="container py-5 fw-bold"  style="margin-top:185px;font-family: Nunito, sans-serif;">
        <h3 class="text-center text-uppercase fw-bold" style="margin: 8px;font-family: Nunito, sans-serif;">Details</h3>
        <div class="row text-center justify-content-center last-row">
            <div class="col-lg-2" id="identifier">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody style="margin-top: 38px;">
                            <tr>
                                <td style="padding-right: 0px;padding-left: 0px;width: 134.854px;">Biodegradable</td>
                            </tr>
                            <tr>
                                <td style="padding-right: 0px;padding-left: 0px;">Recyclable</td>
                            </tr>
                            <tr>
                                <td style="padding-right: 0px;padding-left: 0px;">Residual</td>
                            </tr>
                            <tr>
                                <td style="padding-right: 0px;padding-left: 0px;">Special</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                </div>
            </div>
            <div class="col-11 col-md-4 col-lg-2">
                <h5 class="text-center" id="actual" style="margin-bottom: 0px;">Actual kg/day</h5>
                <h5 class="text-center" style="margin: 0px;"></h5>
                <h5 class="text-center">(total)</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;width: 134.854px;">Biodegradable</td>
                                <td id="actualBio">{{$res->CurrentData->bio}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable</td>
                                <td id="actualRec">{{$res->CurrentData->rec}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Residual</td>
                                <td id="actualRes">{{$res->CurrentData->res}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Special</td>
                                <td id="actualSpe">{{$res->CurrentData->spe}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2">Total</td>
                                <td id="actualTotal">{{$res->CurrentData->total}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-11 col-md-4 col-lg-2">
                <h5 class="text-center" id="estimated" style="margin-bottom: 0px;">Estimated kg/day</h5>
                <h5 class="text-center">(total)</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;width: 134.854px;">Biodegradable</td>
                                <td id="estimatedTotalBio">{{$res->estimationTotal->estimatedBio}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable</td>
                                <td id="estimatedTotalRec">{{$res->estimationTotal->estimatedRec}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Residual</td>
                                <td id="estimatedTotalRes">{{$res->estimationTotal->estimatedRes}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Special</td>
                                <td id="estimatedTotalSpe">{{$res->estimationTotal->estimatedSpe}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2">Total</td>
                                <td id="estimatedTotal">{{$res->estimationTotal->estimatedTotal}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-11 col-md-4 col-lg-2">
                <h5 class="text-center" id="estimated" style="margin-bottom: 0px;">Estimated kg/day </h5>
                <h5 class="text-center">(per capita)</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;width: 134.854px;">Biodegradable</td>
                                <td id="estimatedPerCapBio">{{$res->estimationPerCapita->perCapitaBio}} ({{$res->estimationPerCapita->percentBio}}%)</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable</td>
                                <td id="estimatedPerCapRec">{{$res->estimationPerCapita->perCapitaRec}} ({{$res->estimationPerCapita->percentRec}}%)</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Residual</td>
                                <td id="estimatedPerCapRes">{{$res->estimationPerCapita->perCapitaRes}} ({{$res->estimationPerCapita->percentRes}}%)</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Special</td>
                                <td id="estimatedPerCapSpe">{{$res->estimationPerCapita->perCapitaSpe}} ({{$res->estimationPerCapita->percentSpe}}%)</td>
                            </tr>
                            <tr>
                                <td id="identifiers2">Total</td>
                                <td id="estimatedPerCapTotal">{{$res->estimationPerCapita->perCapitaTotal}} (100%)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row text-center d-flex justify-content-center">
                <div class="col-11 col-sm-11 col-md-6 col-lg-5 col-xxl-4">
                    <h5 class="text-center" id="others">Other Details</h5>
                    <div class="table-responsive">
                        <table class="table last-table">
                            <thead>
                                <tr>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="">Diverted Residual Waste</td>
                                    <td id="growthRate">{{$res->CurrentData->drw}} KG/Day</td>
                                </tr>
                                <tr>
                                    <td style="">Current Population</td>
                                    <td id="option2Bio-1">{{$res->CurrentData->pop}}<br /></td>
                                </tr>
                                <tr>
                                    <td style="">Growth Rate</td>
                                    <td id="growthRate">{{$res->CurrentData->gr}}%</td>
                                </tr>
                                <tr>
                                    <td style="">Reduction Efficiency Rating</td>
                                    <td id="">{{$res->CurrentData->rer}}</td>
                                </tr>
                                <tr>
                                    <td style="">Social Acceptability</td>
                                    <td id="">{{$res->CurrentData->SA}}</td>
                                </tr>
                                <tr>
                                    <td style="">Municipal Classification</td>
                                    <td id="">{{$res->CurrentData->MC}}</td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="reportID-container">
        <span id="reportID" >Report ID: {{$res->pdfData->randID}}</span>
    </div>
    
    <div class="container py-2 fw-bold"  style="font-family: Nunito, sans-serif;">
        <div class="row text-center d-flex justify-content-center">
            <h3 class="text-center text-uppercase fw-bold" style="margin: 8px;font-family: Nunito, sans-serif;">Updates</h3>
            <div class="col-6 update">
                <table>
                    <thead>
                        <tr>
                            <td>
                                1st Update
                            </td>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <td>Biodegradable: </td>
                            @if ($res->UData[0]->UD2ndBio != 0 || $res->UData[0]->UD2ndBio != null)
                            <td>{{$res->UData[0]->UD2ndBio}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Recyclable: </td>
                            @if ($res->UData[0]->UD2ndRec != 0 || $res->UData[0]->UD2ndRec != null)
                            <td>{{$res->UData[0]->UD2ndRec}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Residual: </td>
                            @if ($res->UData[0]->UD2ndRes != 0 || $res->UData[0]->UD2ndRes != null)
                            <td>{{$res->UData[0]->UD2ndRes}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Special: </td>
                            @if ($res->UData[0]->UD2ndSpe != 0 || $res->UData[0]->UD2ndSpe != null)
                            <td>{{$res->UData[0]->UD2ndSpe}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6 update">
                
                <table>
                    <thead>
                        <tr>
                            <td>
                                2nd Update
                            </td>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <td>Biodegradable: </td>
                            @if ($res->UData[0]->UD4thBio != 0 || $res->UData[0]->UD4thBio != null)
                            <td>{{$res->UData[0]->UD4thBio}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Recyclable: </td>
                            @if ($res->UData[0]->UD4thRec != 0 || $res->UData[0]->UD4thRec != null)
                            <td>{{$res->UData[0]->UD4thRec}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Residual: </td>
                            @if ($res->UData[0]->UD4thRes != 0 || $res->UData[0]->UD4thRes != null)
                            <td>{{$res->UData[0]->UD4thRes}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Special: </td>
                            @if ($res->UData[0]->UD4thSpe != 0 || $res->UData[0]->UD4thSpe != null)
                            <td>{{$res->UData[0]->UD4thSpe}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6 update">
                
                <table>
                    <thead>
                        <tr>
                            <td>
                                3rd Update
                            </td>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <td>Biodegradable: </td>
                            @if ($res->UData[0]->UD6thBio != 0 || $res->UData[0]->UD6thBio != null)
                            <td>{{$res->UData[0]->UD6thBio}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Recyclable: </td>
                            @if ($res->UData[0]->UD6thRec != 0 || $res->UData[0]->UD6thRec != null)
                            <td>{{$res->UData[0]->UD6thRec}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Residual: </td>
                            @if ($res->UData[0]->UD6thRes != 0 || $res->UData[0]->UD6thRes != null)
                            <td>{{$res->UData[0]->UD6thRes}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Special: </td>
                            @if ($res->UData[0]->UD6thSpe != 0 || $res->UData[0]->UD6thSpe != null)
                            <td>{{$res->UData[0]->UD6thSpe}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6 update">
                
                <table>
                    <thead>
                        <tr>
                            <td>
                                4th Update
                            </td>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <td>Biodegradable: </td>
                            @if ($res->UData[0]->UD8thBio != 0 || $res->UData[0]->UD8thBio != null)
                            <td>{{$res->UData[0]->UD8thBio}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Recyclable: </td>
                            @if ($res->UData[0]->UD8thRec != 0 || $res->UData[0]->UD8thRec != null)
                            <td>{{$res->UData[0]->UD8thRec}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Residual: </td>
                            @if ($res->UData[0]->UD8thRes != 0 || $res->UData[0]->UD8thRes != null)
                            <td>{{$res->UData[0]->UD8thRes}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Special: </td>
                            @if ($res->UData[0]->UD8thSpe != 0 || $res->UData[0]->UD8thSpe != null)
                            <td>{{$res->UData[0]->UD8thSpe}} kg</td>
                            @else
                            <td>No Data Available</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div id="reportID-container">
        <span id="reportID" >Report ID: {{$res->pdfData->randID}}</span>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    </body>
    </html>