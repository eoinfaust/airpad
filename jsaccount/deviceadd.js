clearmodal()
$(document).ready(function(){
  $('#deviceaddform').submit(function(e){
    clearmodal();
    e.preventDefault();
    var data = $('#deviceaddform').serializeArray();
    data.push({name: 'add_device', value: '1'});
    var promise = $.ajax({
      type: "POST",
      url: 'server.php',
      data: data,
      cache: false
    });
    promise.then(function(data){
      if(data === 'success'){
        window.location.href = 'account.php';
      }else{
        var arr = JSON.parse(data);
        alert(arr);
        if(arr[0]){
          $("#deviceid").addClass("inputerror");
          $("#error1").show();
        }else if(arr[4]){
          $("#deviceid").addClass("inputerror");
          $("#error5").show();
        }else if(arr[5]){
          $("#deviceid").addClass("inputerror");
          $("#error6").show();
        }
        if(arr[1]){
          $("#devicename").addClass("inputerror");
          $("#error2").show();
        }else if(arr[2]){
          $("#devicename").addClass("inputerror");
          $("#error3").show();
        }else if(arr[3]){
          $("#devicename").addClass("inputerror");
          $("#error4").show();
        }
      }
    });
  });
});