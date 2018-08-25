$(document).ready(function() {
    console.log("In ready function...");
    $.get("http://192.168.135.129:8000/services.php?taxId=1&from=1&to=10",
      function(data){},"json")  
    .then(function(data) {
    //    $('#check1').append(data.id);
    //    $('.greeting-content').append(data.content);
        console.log('Response received...');        
        console.log(data.result[0]);
        $.each(data.result,(index,item) =>{
            console.log(item.filename);
            console.log(item.title);

            var htmlStr = '';
            htmlStr += '<div class="row">';
            htmlStr +=      '<div class="col-sm">';
            htmlStr+=           '<p id="meta-text"  style="padding-top: 20px;">' + item.title + '</p>'; 
            htmlStr +=      '</div>';
            htmlStr +=      '<div class="col-sm">';
            htmlStr +=          '<audio id="testAud" class="float-right" src="' + item.filename + '" controls></audio>';
            htmlStr +=      '</div>';
            htmlStr += '</div>';
            var oHtml = $.parseHTML(htmlStr);
            $("#bayans").append(oHtml);


        });
     
    }).fail(function (result) {
        console.log("API called failed....");
        console.log(result)
      })
});