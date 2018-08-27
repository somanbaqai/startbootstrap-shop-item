$(document).ready(function () {
    console.log("In ready function...");

        $("#loading-icon").hide();
 

    $.ajaxSetup({
        beforeSend: function() {
            // TODO: show your spinner
            $('#loading-icon').show();
        },
        complete: function() {
            // TODO: hide your spinner
            $('#loading-icon').hide();
        }
    });
    $.get("http://192.168.135.129:8000/services.php?from=1&to=10",
        function (data) { }, "json")
        .then(function (data) {
           
            console.log('Response received...');
            
            $.each(data.result, (index, item) => {

                var htmlStr = '';
                htmlStr += '<div class="row">';
                htmlStr += '<div class="col-sm">';
                htmlStr += '<p id="meta-text"  style="padding-top: 20px;">' + item.title + '</p>';
                htmlStr += '</div>';
                htmlStr += '<div class="col-sm">';
                htmlStr += '<audio id="testAud" class="float-right" src="' + item.filename + '" controls></audio>';
                htmlStr += '</div>';
                htmlStr += '</div>';
                var oHtml = $.parseHTML(htmlStr);
                $("#bayans").append(oHtml);


            });
           
        }).fail(function (result) {
            console.log("API called failed....");
            console.log(result)
        })

});