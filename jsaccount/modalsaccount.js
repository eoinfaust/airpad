function clearmodal(){
  $("#error1").hide();$("#error2").hide();$("#error3").hide();$("#error4").hide();$("#error5").hide();$("#error6").hide();$("#error7").hide();$("#error8").hide();$("#error9").hide();
  $("#devicename, #deviceid, #devicename1").removeClass("inputerror");
}
var modaladdev = document.getElementById("deviceaddModal");
var btnaddev = document.getElementById("deviceaddBtn");
var spanaddev = document.getElementsByClassName("close")[0];
var modaldeldev = document.getElementById("devicedeleteModal");
var btndeldev = document.getElementById("devicedeleteBtn");
var spandeldev = document.getElementsByClassName("close")[1];
var modalrenamedev = document.getElementById("devicerenameModal");
var btnrenamedev = document.getElementById("devicerenameBtn");
var spanrenamedev = document.getElementsByClassName("close")[2];
window.onclick = function(event){
  if(event.target == modaladdev){
    modaladdev.style.display="none";
    clearmodal();
  }
  if(event.target == modaldeldev){
    modaldeldev.style.display="none";
    clearmodal();
  }
  if(event.target == modalrenamedev){
    modalrenamedev.style.display="none";
    clearmodal();
  }
}
btndeldev.onclick = function(){
  modaldeldev.style.display="block";
}
spandeldev.onclick = function(){
  modaldeldev.style.display="none";
  clearmodal();
}
btnaddev.onclick = function(){
  modaladdev.style.display="block";
}
spanaddev.onclick = function(){
  modaladdev.style.display="none";
  clearmodal();
}
btnrenamedev.onclick = function(){
  modalrenamedev.style.display="block";
}
spanrenamedev.onclick = function(){
  modalrenamedev.style.display="none";
  clearmodal();
}