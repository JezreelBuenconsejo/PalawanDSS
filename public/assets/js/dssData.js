var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.getElementsByTagName('head')[0].appendChild(script);

var Total;

$(document).ready(function(){
  $('#otherData').hide();
    $("#Review,#btnNextRER").click(function(){
      var Bio = $("#txtBiodegradable").val();
      var Rec = $("#txtRecyclable").val();
      var Res = parseFloat($("#txtResidual").val());
      var Spe = $("#txtSpecial").val();
      var Tot = $("#lblTotalWaste").text();
      var Pop = $("#txtPopulation").val();
      var GR = $("#txtGrowthRate").val();
      var LA = $("#txtLandArea").val();
      var R1 = parseFloat($("#txtR1").val());
      var R2 = parseFloat($("#txtR2").val());
      var yrs = parseFloat($("#txtYears").val());
      var RER = (R2 - R1) / yrs;
      var DRW = Res - (Res * (RER/100));

      if(DRW > 5000){
        $('#otherData').show();
        $('#txtSocialAcceptability').prop('required',true);
        $('#selectMunicipalClass').prop('required',true);
      }
      else{
        $('#otherData').hide();
        $('#txtSocialAcceptability').prop('required',false);
        $('#selectMunicipalClass').prop('required',false);
      }

      
      $("#lblBiodegradable").text(Bio);
      $("#lblRecyclable").text(Rec);
      $("#lblResidual").text(Res);
      $("#lblSpecial").text(Spe);
      $("#lblTotal").text(Tot);
      $("#lblPopulation").text(Pop);
      $("#lblGrowthRate").text(GR);
      $("#lblLandArea").text(LA);
      $("#lblR1").text(R1);
      $("#lblR2").text(R2);
      $("#lblYears").text(yrs);
      $("#lblDRW").text(DRW);
      $("#txtDRW").val(DRW);
    });

    $("#txtBiodegradable,#txtRecyclable,#txtResidual,#txtSpecial").blur(function(){
      var Bio = parseFloat($("#txtBiodegradable").val());
      var Rec = parseFloat($("#txtRecyclable").val());
      var Res = parseFloat($("#txtResidual").val());
      var Spe = parseFloat($("#txtSpecial").val());
      Total = Bio + Rec + Res + Spe;
      $("#txtTotalWaste").val(Total.toFixed(2));
      $("#lblTotalWaste").text(Total.toFixed(2));
    });

    $("#txtLandArea").on('input',function() {
      var LA = $("#txtLandArea").val();
      if(LA > 50000){
        $("#notSmallIsland").show();
      }
      else{
        $("#notSmallIsland").hide();
      }
    });
    $("#txtLandArea").blur(function(){
      var LA = $("#txtLandArea").val();
      if(LA > 50000){
        $("#txtLandArea").val('');
        $("#notSmallIsland").hide();
      }
    });


    $('#txtEmail').each(function(){
      var value = $(this).val();
      var size  = value.length;
      // playing with the size attribute
      //$(this).attr('size',size);
      
      // playing css width
      size = size*2.8;
      $(this).css('width',size*3);
      
      })

  });