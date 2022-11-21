
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/assets/js/result.js"></script>
<h2 class="text-center" style="margin: 8px;">Results</h2>
    <div class="container shadow" style="margin-bottom: 40px;">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 6px;">
                <h4 id="mainResult">{{$res->Decision}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 12px;">
                <h5 id="option1">Option 1: Collect 50% (amount in KG/Day)</h5>
                <h6 id="option1Bio">Biodegradable: {{$res->Options->option1Bio}}</h6>
                <h6 id="option1Rec">Recyclable: {{$res->Options->option1Rec}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 id="option1">Option 2: Collect in excess of the estimation (amount in KG/Day)</h5>
                <h6 id="option2Bio">Biodegradable: {{$res->Options->option2Bio}}</h6>
                <h6 id="option2Rec">Recyclable: {{$res->Options->option2Rec}}</h6>
            </div>
        </div>
    </div>
    <h3 class="text-center" style="margin: 8px;">Projections</h3>
    <div class="container shadow" style="margin-bottom: 20px;">
        <div class="row">
            <div class="col-md-12">
                <h5 id="projectedResult">{{$res->Projection->projectedResult}} in {{$res->Projection->finalYear}} ({{$res->Projection->years}} years)</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="projectedPopulation">
                <h6>Projected Population: {{$res->Projection->projectedPopulation}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h6 id="projectedRes">Projected Residual Waste: {{$res->Projection->projectedRes}} KG/Day</h6>
                <h6 id="projectedDRW">Projected Diverted Residual Waste: {{$res->Projection->projectedDRW}} KG/Day</h6>
            </div>
        </div>
    </div>
    <div class="container shadow" id="details" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <h4 class="text-center">Details</h4>
            </div>
        </div>
        <div class="row text-center justify-content-center">
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
                                <td id="estimatedTotalBio">{{$res->Total->estimatedBio}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable</td>
                                <td id="estimatedTotalRec">{{$res->Total->estimatedRec}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Residual</td>
                                <td id="estimatedTotalRes">{{$res->Total->estimatedRes}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Special</td>
                                <td id="estimatedTotalSpe">{{$res->Total->estimatedSpe}}</td>
                            </tr>
                            <tr>
                                <td id="identifiers2">Total</td>
                                <td id="estimatedTotal">{{$res->Total->estimatedTotal}}</td>
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
                                <td id="estimatedPerCapBio">{{$res->PerCapita->perCapitaBio}} ({{$res->PerCapita->percentBio}}%)</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable</td>
                                <td id="estimatedPerCapRec">{{$res->PerCapita->perCapitaRec}} ({{$res->PerCapita->percentRec}}%)</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Residual</td>
                                <td id="estimatedPerCapRes">{{$res->PerCapita->perCapitaRes}} ({{$res->PerCapita->percentRes}}%)</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Special</td>
                                <td id="estimatedPerCapSpe">{{$res->PerCapita->perCapitaSpe}} ({{$res->PerCapita->percentSpe}}%)</td>
                            </tr>
                            <tr>
                                <td id="identifiers2">Total</td>
                                <td id="estimatedPerCapTotal">{{$res->PerCapita->perCapitaTotal}} (100%)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-11 col-md-4 col-lg-2">
                <h5 class="text-center" id="collect50">Collect %50</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;width: 134.854px;">Biodegradable</td>
                                <td id="option1Bio">{{$res->Options->option1Bio}} KG/Day</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable KG/Day</td>
                                <td id="option1Rec">{{$res->Options->option1Rec}} KG/Day<br></td>
                            </tr>
                            <tr></tr>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-11 col-sm-11 col-md-4 col-lg-2">
                <h5 class="text-center" id="collect">Collect Excess of Estimation</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;width: 134.854px;">Biodegradable</td>
                                <td id="option2Bio">{{$res->Options->option2Bio}}<br></td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable</td>
                                <td id="option2Rec">{{$res->Options->option2Rec}}</td>
                            </tr>
                            <tr></tr>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row text-center d-flex justify-content-center">
                <div class="col-11 col-sm-11 col-md-6 col-lg-5 col-xxl-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr></tr>
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
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 12px;margin-top: 10px;">
        <div class="row d-flex">
            <div class="col-6 col-md-6" style="text-align: right;"><button class="btn btn-dark" id="viewDetails" type="button">View Details</button></div>
            <div class="col-6 col-md-6"><a class="btn btn-dark" role="button" href="{{ url('/dashboard') }}">OK</a></div>
        </div>
    </div>