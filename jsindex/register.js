clearmodal();
$(document).ready(function(){
  $('#registerform').submit(function(e){
    clearmodal();
    e.preventDefault();
    var data = $('#registerform').serializeArray();
    data.push({name: 'reg_user', value: '1'});
    var promise = $.ajax({
      type: "POST",
      url: 'server.php',
      data: data,
      cache: false
    });
    $("#password1, #password2").val("");
    promise.then(function(data){
        if(data === 'success'){
            window.location.href = 'index.php';
        }else{
            var ar = JSON.parse(data);
            if(ar[0]){
                $("#username1").addClass("inputerror");
                $("#error1").show();
            }else if(ar[1]){
                $("#username1").val("");
                $("#username1").addClass("inputerror");
                $("#error2").show();
            }else if(ar[2]){
                $("#username1").val("");
                $("#username1").addClass("inputerror");
                $("#error3").show();
            }else if(ar[9]){
                $("#username1").val("");
                $("#username1").addClass("inputerror");
                $("#error10").show();
            } 
            if(ar[3]){
                $("#email").val("");
                $("#email").addClass("inputerror");
                $("#error4").show();
            } 
            if(ar[4]){
                $("#email").val("");
                $("#email").addClass("inputerror");
                $("#error5").show();
            } 
            if(ar[5]){
                $("#password1, #password2").addClass("inputerror");
                $("#error6").show();
            } 
            if(ar[6]){
                $("#password1, #password2").addClass("inputerror");
                $("#error7").show();
            } 
            if(ar[7]){
                $("#password1, #password2").addClass("inputerror");
                $("#error8").show();
            } 
            if(ar[8]){
                $("#password1, #password2").addClass("inputerror");
                $("#error9").show();
            } 
            if(ar[10]){
                $("#email").val("");
                $("#email").addClass("inputerror");
                $("#error11").show();
            }
        }
    });
  });
});