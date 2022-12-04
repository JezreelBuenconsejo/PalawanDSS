
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/assets/js/result.js"></script>
<h2 class="text-center text-uppercase text-primary fw-bold" style="margin: 8px; font-family: Nunito, sans-serif;">Results</h2>
    <div class="container card shadow border-start-primary py-2 text-dark" style="margin-bottom: 40px; font-family: Nunito, sans-serif;">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 6px;">
                <h4 id="mainResult">Main Result: Ecology Center with Category {{$res->DSSResults->mainRes}}</h4>
                <h5 id="alternativeResult">{{$res->DSSResults->altRes}}</h5>
                <h6 id="comment" style="color: red">{{$res->DSSResults->comment}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 12px;">
                <h5 id="option1">Option 1: Collect 50% (amount in KG/Day)</h5>
                <h6 id="option1Bio">Biodegradable: {{$res->DSSResults->op1Bio}}</h6>
                <h6 id="option1Rec">Recyclable: {{$res->DSSResults->op1Rec}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 id="option1">Option 2: Collect in excess of the estimation (amount in KG/Day)</h5>
                <h6 id="option2Bio">Biodegradable: {{$res->DSSResults->op2Bio}}</h6>
                <h6 id="option2Rec">Recyclable: {{$res->DSSResults->op2Rec}}</h6>
            </div>
        </div>
    </div>
    <h3 class="text-center text-uppercase fw-bold" style="margin: 8px; color:rgb(28,200,138);font-family: Nunito, sans-serif;">Projections</h3>
    <div class="container card shadow border-start-primary py-2 text-dark" style="margin-bottom: 20px; font-family: Nunito, sans-serif;">
        <div class="row">
            <div class="col-md-12">
                <h5 id="projectedResult">Ecology Center with Category {{$res->projections->projectedResult}} in {{$res->projections->finalYear}} ({{$res->DSSResults->time}} years)</h5>
                <h6 id="projectedComment" style="color: red">{{$res->projections->projectedComments}}</h6>
            
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="projectedPopulation">
                <h6>Projected Population: {{$res->projections->projectedPop}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h6 id="projectedRes">Projected Residual Waste: {{$res->projections->projectedRes}} KG/Day</h6>
                <h6 id="projectedDRW">Projected Diverted Residual Waste: {{$res->projections->projectedDRW}} KG/Day</h6>
            </div>
        </div>
    </div>
    <div class="container card shadow border-start-primary py-2 small fw-bold" id="details" style="margin-top: 20px; color: rgb(133,135,150);font-family: Nunito, sans-serif;">
        <div class="row">
            <div class="col">
                <h4 class="text-center fw-bold" style="color: #36b9cc;font-family: Nunito, sans-serif;">Details</h4>
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
                                <td id="option1Bio">{{$res->DSSResults->op1Bio}} KG/Day</td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable KG/Day</td>
                                <td id="option1Rec">{{$res->DSSResults->op1Rec}} KG/Day<br></td>
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
                                <td id="option2Bio">{{$res->DSSResults->op2Bio}}<br></td>
                            </tr>
                            <tr>
                                <td id="identifiers2" style="padding-right: 0px;padding-left: 0px;">Recyclable</td>
                                <td id="option2Rec">{{$res->DSSResults->op2Rec}}</td>
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
