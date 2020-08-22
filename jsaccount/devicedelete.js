clearmodal()
$(document).ready(function(){
  $('#devicedelete').submit(function(e){
    clearmodal();
    e.preventDefault();
    var data = $('#devicedelete').serializeArray();
    data.push({name: 'delete_device', value: '1'});
    data.push({name: 'devicefordeletion', value:$("#devicechosen:selected").text()});
    var arr = JSON.parse(data);
    alert(arr);
    var promise = $.ajax({
        type: "POST",
        url: 'server.php',
        data: data,
        cache: false
    });
    promise.then(function(data){
        if(data === 'success'){
            window.location.href = 'account.php';
        }else if(data === 'failure'){
            alert('An unknown error has occurred; please contact support.')
        }
    });
  });
});