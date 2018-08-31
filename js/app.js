$(document).ready(function () {
    console.log("In ready function...");
    
    $.ajaxSetup({

        complete: function() {
            // TODO: hide your spinner
            $('#loading-icon').hide();
        }
    });
    console.log( "http://" + window.location.host +  "/services.php?from=1&to=10");
 
    $.get("http://" + window.location.host +  "/services.php?from=1&to=10",
        function (data) { }, "json")
        .then(function (data) {
           
            console.log('Response received...');
            
            var i=0;
            $.each(data.result, (index, item) => {
                var htmlStr = '';
                htmlStr += '<div class="row">';
                htmlStr += '<div class="col-sm">';
                htmlStr += '<p id="meta-text"  style="padding-top: 20px;">' + item.title + '</p>';
                htmlStr += '</div>';
                htmlStr += '<div class="col-sm">';
                //htmlStr += '<audio id="testAud" class="float-right" src="' + item.filename + '" controls></audio>';
                htmlStr += '<button data-bayan-file="' + item.filename +'" onclick="loadAudio(this.id)" id="bayan' + i + '"type="button" class="play-btn"><i class="fas fa-play"></i></button>'
                htmlStr += '</div>';
                htmlStr += '</div>';
                var oHtml = $.parseHTML(htmlStr);
                $("#bayans").append(oHtml);
                i++;

            });
           
        }).fail(function (result) {
            console.log("API called failed....");
            console.log(result)
        })

      
        
});
