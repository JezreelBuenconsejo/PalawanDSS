
<link rel="stylesheet" href="/assets/bootstrap/css/dssDataBootstrap.min.css">
<script src="/assets/js/updateDataJquery.min.js"></script>
<script src="/assets/js/dssData.js"></script>
<div class="row register-form" style="width: 100%;">
    <div class="col" style="width: 100%;">
        <h1 class="text-center" style="width: 100%;">Update Solid Waste Data</h1>
        <form class="custom-form needs-validation" action="InputUpdate" method="POST">
            @csrf
            <div class="row form-group">
                <div class="col-8 col-sm-4 label-column" style="text-align: right;"><label class="col-form-label" for="name-input-field">Biodegradable</label></div>
                <div class="col-sm-6 input-column"><input class="form-control" type="text" id="txtBiodegradable" required="" name="biodegradable"></div>
            </div>
            <div class="row form-group">
                <div class="col-8 col-sm-4 label-column" style="text-align: right;"><label class="col-form-label" for="email-input-field">Recyclable</label></div>
                <div class="col-sm-6 input-column"><input class="form-control" type="text" id="txtRecyclable" required="" name="recyclable"></div>
            </div>
            <div class="row form-group">
                <div class="col-8 col-sm-4 label-column" style="text-align: right;"><label class="col-form-label" for="pawssword-input-field">Residual</label></div>
                <div class="col-sm-6 input-column"><input class="form-control" type="text" id="txtResidual" required="" name="residual"></div>
            </div>
            <div class="row form-group">
                <div class="col-8 col-sm-4 label-column" style="text-align: right;"><label class="col-form-label" for="repeat-pawssword-input-field">Special</label></div>
                <div class="col-sm-6 input-column"><input class="form-control" type="text" id="txtSpecial" required="" name="special"></div>
            </div>
            <div class="row form-group">
                <div class="col-8 col-sm-4 label-column" style="text-align: right;"><label class="col-form-label" for="repeat-pawssword-input-field">Total</label></div>
                <div class="col-sm-6 input-column"><label class="form-label" id="lblTotalWaste">---</label><input class="form-control" type="hidden" id="txtTotalWaste" name="totalWaste"></div>
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-success submit-button" type="submit">Submit&nbsp;</button>
            </div>
        </form>
    </div>
</div>