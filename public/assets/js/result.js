var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.getElementsByTagName('head')[0].appendChild(script);

$(document).ready(function(){
    $('#details').hide();
    var hidden = true;
    $('#viewDetails').click(function(){
        if(hidden == true){
            $('#details').show();
            $('#viewDetails').text('Hide Details');
            hidden = false;
        }
        else if(hidden == false){
            $('#details').hide();
            $('#viewDetails').text('Show Details');
            hidden = true;
        }
      });
});