$("#error1").hide();$("#error2").hide();$("#error3").hide();$("#error4").hide();
$(document).ready(function(){
  $('#signinform').submit(function(e){
    $("#username, #password").removeClass("inputerror");
    $("#error1").hide();$("#error2").hide();$("#error3").hide();$("#error4").hide();
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
      if(data === 'fail'){
        $("#username, #password").addClass("inputerror");
        $("#error1").show();
      }else if(data === 'fillu'){
        $("#username").addClass("inputerror");
        $("#error2").show();
      }else if(data === 'fillp'){
        $("#password").addClass("inputerror");
        $("#error3").show();
      }else if(data === 'fillup'){
        $("#username, #password").addClass("inputerror");
        $("#error4").show();
      }else{
        window.location.href = 'index.php';
      }
    });
  });
});
var modal = document.getElementById("signinModal");
var btn = document.getElementById("signinmodBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function(){
  modal.style.display="block";
}
span.onclick = function(){
  modal.style.display="none";
}
window.onclick = function(event){
  if (event.target == modal){
    modal.style.display="none";
  }
}