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
function clearmodal(){
  $("#error101").hide();$("#error102").hide();$("#error103").hide();$("#error104").hide();$("#error105").hide();$("#error106").hide();
  $("#devicename, #deviceid").removeClass("inputerror");
  $("#devicename, #deviceid").val("");
}