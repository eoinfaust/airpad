clearmodal();
$(document).ready(function(){
  $('#signinform').submit(function(e){
    clearmodal();
    e.preventDefault();
    var data = $('#signinform').serializeArray();
    data.push({name: 'signin_user', value: '1'});
    var promise = $.ajax({
      type: "POST",
      url: 'server.php',
      data: data,
      cache: false
    });
    $("#username, #password").val("");
    promise.then(function(data){
      if(data === 'success'){
        window.location.href = 'index.php';
      }else{
        var arr = JSON.parse(data);
        if(arr[2]){
          $("#username, #password").addClass("inputerror");
          $("#error12").show();
        }else{
          if(arr[0]){
            $("#username").addClass("inputerror");
            $("#error13").show();
          }
          if(arr[1]){
            $("#password").addClass("inputerror");
            $("#error14").show();
          }
        }
      }
    });
  });
});