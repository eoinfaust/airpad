$("#error1").hide();$("#error2").hide();$("#error3").hide();$("#error4").hide();$("#error5").hide();
$("#error6").hide();$("#error7").hide();$("#error8").hide();$("#error9").hide();$("#error10").hide();$("#error11").hide();
$(document).ready(function(){
  $('#registerform').submit(function(e){
    $("#username, #email, #password1, #password2").removeClass("inputerror");
    $("#error1").hide();$("#error2").hide();$("#error3").hide();$("#error4").hide();$("#error5").hide();
    $("#error6").hide();$("#error7").hide();$("#error8").hide();$("#error9").hide();$("#error10").hide();$("#error11").hide();
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
        var ar = JSON.parse(data);
        if(ar[0]){
            $("#username").addClass("inputerror");
            $("#error1").show();
        }
        if(ar[1]){
            $("#username").val("");
            $("#username").addClass("inputerror");
            $("#error2").show();
        }
        if(ar[2]){
            $("#username").val("");
            $("#username").addClass("inputerror");
            $("#error3").show();
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
        if(ar[9]){
            $("#username").val("");
            $("#username").addClass("inputerror");
            $("#error10").show();
        } 
        if(ar[10]){
            $("#email").val("");
            $("#email").addClass("inputerror");
            $("#error11").show();
        }
        if(ar[11]){
            window.location.replace("index.php");
        }
    });
  });
});