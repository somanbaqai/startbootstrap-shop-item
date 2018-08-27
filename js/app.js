$(document).ready(function () {
    console.log("In ready function...");
    $.get("http://www.majliseirshad.org/services.php?from=1&to=10",
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