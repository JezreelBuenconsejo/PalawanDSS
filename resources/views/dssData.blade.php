
<link rel="stylesheet" href="/assets/bootstrap/css/dssDataBootstrap.min.css">
<link rel="stylesheet" href="/assets/css/Multi-step-form.css">
<link rel="stylesheet" href="/assets/css/Pretty-Registration-Form-.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/assets/js/dssData.js"></script>

<h2 class="text-center text-wrap">Decision Support System for Solid Waste Disposal Center</h2>
<section>
    <div id="multple-step-form" class="container overflow-hidden" style="margin-top: 0px;margin-bottom: 10px;padding-bottom: 300px;padding-top: 15px;height: 1000px;max-height: 1000px;min-height: 500px;">
        <div id="progress-bar-button" class="multisteps-form">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                    <div class="multisteps-form__progress"><a class="btn multisteps-form__progress-btn js-active" role="button" title="Solid Waste Data">Solid Waste Data</a><a class="btn multisteps-form__progress-btn" role="button" title="Population Density">Population Density</a><a class="btn multisteps-form__progress-btn" role="button" title="Reduction Efficiency Rating">Reduction Efficiency Rating</a><a class="btn multisteps-form__progress-btn" role="button" title="Review">Review</a></div>
                </div>
            </div>
        </div>
        <div id="multistep-start-row" class="row">
            <div id="multistep-start-column" class="col-12 col-lg-8 m-auto">
                <form id="main-form" class="multisteps-form__form needs-validation" action="dssData" method="POST">
                    @csrf
                    <div id="single-form-next-solid-waste" class="multisteps-form__panel shadow p-4 rounded bg-white mx-2 js-active" data-animation="scaleIn">
                        <h3 class="text-center multisteps-form__title">Solid Waste Data</h3>
                        <div class="row form-group d-flex justify-content-center">
                            <div class="col-sm-4 col-xl-2 label-column d-flex justify-content-end"><label class="col-form-label" for="name-input-field"></label></div>
                            <div class="col-sm-6 col-xl-3 d-flex justify-content-center"><label class="col-form-label fs-6 fw-lighter text-center">Actual Kg/Day (Total)</label></div>
                        </div>
                        <div class="row form-group my-1 d-flex justify-content-center">
                            <div class="col-5 col-sm-4 col-xl-2 label-column d-flex justify-content-end"><label class="col-form-label" for="name-input-field">Biodegradable</label></div>
                            <div class="col-7 col-sm-6 col-xl-3 input-column"><input class="form-control" type="text" id="txtBiodegradable" required="" name="biodegradable"></div>
                        </div>
                        <div class="row form-group my-1 d-flex justify-content-center">
                            <div class="col-5 col-sm-4 col-xl-2 label-column d-flex justify-content-end"><label class="col-form-label" for="name-input-field">Recyclable</label></div>
                            <div class="col-7 col-sm-6 col-xl-3 input-column"><input class="form-control" type="text" id="txtRecyclable" required="" name="recyclable"></div>
                        </div>
                        <div class="row form-group my-1 d-flex justify-content-center">
                            <div class="col-5 col-sm-4 col-xl-2 label-column d-flex justify-content-end"><label class="col-form-label" for="name-input-field">Residual</label></div>
                            <div class="col-7 col-sm-6 col-xl-3 input-column"><input class="form-control" type="text" id="txtResidual" required="" name="residual"></div>
                        </div>
                        <div class="row form-group my-1 d-flex justify-content-center">
                            <div class="col-5 col-sm-4 col-xl-2 label-column d-flex justify-content-end"><label class="col-form-label" for="name-input-field">Special</label></div>
                            <div class="col-7 col-sm-6 col-xl-3 input-column"><input class="form-control" type="text" id="txtSpecial" required="" name="special"></div>
                        </div>
                        <div class="row form-group my-1 d-flex justify-content-center">
                            <div class="col-5 col-sm-4 col-xl-2 label-column d-flex justify-content-end"><label class="col-form-label" for="name-input-field">Total Waste</label></div>
                            <div class="col-7 col-sm-6 col-xl-3 input-column" name="totalWaste"><label class="form-label" id="lblTotalWaste">---</label><input class="form-control" type="hidden" id="txtTotalWaste" name="totalWaste"></div>
                        </div>
                        <div class="row form-group my-1 d-flex justify-content-center">
                            <div class="col d-flex justify-content-end"><button class="btn btn-dark btn btn-primary ml-auto js-btn-next" id="btnNextSolidWaste" type="button">Next</button></div>
                        </div>
                    </div>
                    <div id="single-form-next-prev-population-density" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                        <h3 class="text-center multisteps-form__title">Population Density</h3>
                        <div id="form-content-1" class="multisteps-form__content">
                            <div class="row form-group my-1 d-flex justify-content-center">
                                <div class="col-6 col-sm-4 col-md-4 col-lg-4 col-xl-3 offset-lg-0"><label class="col-form-label text-start d-flex justify-content-end">Total population</label></div>
                                <div class="col-6 col-sm-4 col-md-4 col-lg-4 col-xl-3"><input class="form-control" type="text" id="txtPopulation" required="" name="population"></div>
                            </div>
                            <div class="row form-group my-1 d-flex justify-content-center">
                                <div class="col-5 col-sm-3 col-md-2 col-lg-3 col-xl-2"><label class="col-form-label d-flex justify-content-end">Growth Rate</label></div>
                                <div class="col-5 col-sm-3 col-md-2 col-lg-3 col-xl-2"><input class="form-control" type="text" id="txtGrowthRate" required="" name="growthRate"></div>
                            </div>
                            <div class="row form-group my-1 d-flex justify-content-center">
                                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3"><label class="col-form-label d-flex justify-content-end">Land Area</label></div>
                                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3"><input class="form-control" type="text" id="txtLandArea" required="" name="landArea"></div>
                            </div>
                            <div class="row">
                                <div class="col"><button class="btn btn-dark btn btn-primary js-btn-prev" id="btnPrevPopulationDensity" type="button" title="Prev">Prev</button></div>
                                <div class="col d-flex justify-content-end"><button class="btn btn-dark btn btn-primary ml-auto js-btn-next" id="btnNextPopulationDensity" type="button" title="Next">Next</button></div>
                            </div>
                        </div>
                    </div>
                    <div id="single-form-next-prev-RER" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                        <h3 class="text-center multisteps-form__title">Reduction Efficiency Rating</h3>
                        <div id="form-content-1" class="multisteps-form__content">
                            <div class="row form-group my-1 d-flex justify-content-center">
                                <div class="col-sm-7 col-md-5 col-lg-6 col-xl-5"><label class="col-form-label d-flex justify-content-center">Initial residual waste reduction rate&nbsp;</label></div>
                                <div class="col-3 col-sm-2 col-md-2 col-xl-2"><input class="form-control" type="text" id="txtR1" required="" name="r1"></div>
                            </div>
                            <div class="row form-group my-1 d-flex justify-content-center">
                                <div class="col-sm-7 col-md-5 col-lg-6 col-xl-5"><label class="col-form-label d-flex justify-content-center">Final residual waste reduction rate</label></div>
                                <div class="col-3 col-sm-2 col-md-2 col-xl-2"><input class="form-control" type="text" id="txtR2" required="" name="r2"></div>
                            </div>
                            <div class="row form-group my-1 d-flex justify-content-center">
                                <div class="col-1 col-sm-5 col-md-4 col-lg-4 col-xl-3 col-xxl-3"><label class="col-form-label"></label></div>
                                <div class="col-sm-2 col-md-1 col-lg-2 col-xl-2 col-xxl-2"><label class="col-form-label d-flex justify-content-center">Years</label></div>
                                <div class="col-3 col-sm-2 col-md-2 col-xl-2 col-xxl-2"><input class="form-control" type="text" id="txtYears" required="" name="years"></div>
                            </div>
                            <div class="row">
                                <div class="col"><button class="btn btn-dark btn btn-primary js-btn-prev" id="btnPrevRER" type="button" title="Prev">Prev</button></div>
                                <div class="col d-flex justify-content-end"><button class="btn btn-dark btn btn-primary ml-auto js-btn-next" id="btnNextRER" type="button" title="Next">Next</button></div>
                            </div>
                        </div>
                    </div>
                    <div id="single-form-prev-review" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn" style="height: 840px;min-height: 553.09px;max-height: 840px;">
                        <h3 class="text-center multisteps-form__title">Review Data</h3>
                        <div id="form-content-3" class="multisteps-form__content" style="height: 758.09px;">
                            <div class="row" style="margin: 0;">
                                <div class="col-xl-6">
                                    <div id="divSolidWaste">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label fs-5 fw-semibold">Solid Waste</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label fs-6" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">Actual Kg/Day (Total)</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label">Biodegradable</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblBiodegradable" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label">Recyclable</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblRecyclable" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label">Residual</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblResidual" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label">Special</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblSpecial" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label">Total</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblTotal" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="divPopulationDensity">
                                        <div class="row">
                                            <div class="col-9 col-sm-6 col-lg-6 col-xl-7 d-flex justify-content-end"><label class="col-form-label fs-5 fw-semibold">Population Density</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label">Total Population</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblPopulation" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label">Growth Rate</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblGrowthRate" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-xl-5 d-flex justify-content-end"><label class="col-form-label">Land Area</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblLandArea" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-1"><label class="col-form-label"></label></div>
                                            <div class="col-sm-7 col-md-6 col-xl-12 d-flex justify-content-start"><label class="col-form-label fs-5 fw-semibold">Reduction Efficiency Rating</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-9 col-sm-6 col-xl-8 d-flex justify-content-end"><label class="col-form-label">Initial waste reduction rate</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblR1" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-9 col-sm-6 col-xl-8 d-flex justify-content-end"><label class="col-form-label">Final waste reduction rate</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblR2" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-9 col-sm-6 col-xl-8 d-flex justify-content-end"><label class="col-form-label">Years</label></div>
                                            <div class="col" style="padding-right: 0px;padding-left: 0px;"><label class="col-form-label" id="lblYears" style="padding: 0;padding-top: 7px;padding-bottom: 7px;margin: 4px;margin-right: 0px;margin-left: 0px;">---</label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 16px;">
                                <div class="col-8 col-sm-9 col-md-10 col-xl-9 col-xxl-10"><button class="btn btn-dark btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button></div>
                                <div class="col-4 col-sm-2 col-xl-1"><button class="btn btn-dark" type="submit">Submit</button></div>
                            </div>
                            <div id="next-prev-buttons-2" class="button-row d-flex mt-4"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
