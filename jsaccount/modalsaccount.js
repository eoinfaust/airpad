function clearmodal(){
  $("#error1").hide();$("#error2").hide();$("#error3").hide();$("#error4").hide();$("#error5").hide();$("#error6").hide();
  $("#devicename, #deviceid").removeClass("inputerror");
}
var modaladdev = document.getElementById("deviceaddModal");
var btnaddev = document.getElementById("deviceaddBtn");
var spanaddev = document.getElementsByClassName("close")[0];
btnaddev.onclick = function(){
  modaladdev.style.display="block";
}
spanaddev.onclick = function(){
  modaladdev.style.display="none";
  clearmodal();
}
window.onclick = function(event){
  if(event.target == modaladdev){
      modaladdev.style.display="none";
      clearmodal();
  }
}