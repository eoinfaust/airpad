clearmodal()
$(document).ready(function(){
  $('#deviceaddform').submit(function(e){
    $("#deviceid, #devicename").removeClass("inputerror");
    $("#error101").hide();$("#error102").hide();$("#error103").hide();$("#error104").hide();$("#error105").hide();$("#error106").hide();
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
        if(arr[0]){
          $("#deviceid").addClass("inputerror");
          $("#error101").show();
        }else if(arr[4]){
          $("#deviceid").addClass("inputerror");
          $("#error105").show();
        }else if(arr[5]){
          $("#deviceid").addClass("inputerror");
          $("#error106").show();
        }
        if(arr[1]){
          $("#devicename").val("");
          $("#devicename").addClass("inputerror");
          $("#error102").show();
        }else if(arr[2]){
          $("#devicename").val("");
          $("#devicename").addClass("inputerror");
          $("#error103").show();
        }else if(arr[3]){
          $("#devicename").val("");
          $("#devicename").addClass("inputerror");
          $("#error104").show();
        }
      }
    });
  });
});