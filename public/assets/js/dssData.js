var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.getElementsByTagName('head')[0].appendChild(script);

var Total;

$(document).ready(function(){
    $("#Review,#btnNextRER").click(function(){
      var Bio = $("#txtBiodegradable").val();
      var Rec = $("#txtRecyclable").val();
      var Res = $("#txtResidual").val();
      var Spe = $("#txtSpecial").val();
      var Tot = $("#lblTotalWaste").text();
      var Pop = $("#txtPopulation").val();
      var GR = $("#txtGrowthRate").val();
      var LA = $("#txtLandArea").val();
      var R1 = $("#txtR1").val();
      var R2 = $("#txtR2").val();
      var yrs = $("#txtYears").val();
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
    });

    $("#txtBiodegradable,#txtRecyclable,#txtResidual,#txtSpecial").blur(function(){
      var Bio = parseInt($("#txtBiodegradable").val());
      var Rec = parseInt($("#txtRecyclable").val());
      var Res = parseInt($("#txtResidual").val());
      var Spe = parseInt($("#txtSpecial").val());
      Total = Bio + Rec + Res + Spe;
      $("#txtTotalWaste").val(Total);
      $("#lblTotalWaste").text(Total);
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