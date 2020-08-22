clearmodal()
$(document).ready(function(){
  $('#devicedelete').submit(function(e){
    clearmodal();
    e.preventDefault();
    var data = $('#devicedelete').serializeArray();
    data.push({name: 'delete_device', value: '1'});
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
          $("#error7").show();
        }else if(arr[1]){
          $("#deviceid").addClass("inputerror");
          $("#error8").show();
        }
      }
    });
  });
});