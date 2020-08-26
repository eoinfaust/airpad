function clearmodal() {
  $("#error1").hide();
  $("#error2").hide();
  $("#error3").hide();
  $("#error4").hide();
  $("#error5").hide();
  $("#error6").hide();
  $("#error7").hide();
  $("#error8").hide();
  $("#devicename, #deviceid, #newname").removeClass("inputerror");
}
var modaladdev = document.getElementById("deviceaddModal");
var btnaddev = document.getElementById("deviceaddBtn");
var spanaddev = document.getElementsByClassName("close")[0];
var modaldeldev = document.getElementById("devicedeleteModal");
var btndeldev = document.getElementById("devicedeleteBtn");
var spandeldev = document.getElementsByClassName("close")[1];
var modalchangedev = document.getElementById("devicechangeModal");
var btnchangedev = document.getElementById("devicechangeBtn");
var spanchangedev = document.getElementsByClassName("close")[2];
window.onclick = function (event) {
  if (event.target == modaladdev) {
    modaladdev.style.display = "none";
    clearmodal();
  }
  if (event.target == modaldeldev) {
    modaldeldev.style.display = "none";
    clearmodal();
  }
  if (event.target == modalchangedev) {
    modalchangedev.style.display = "none";
    clearmodal();
  }
};
btndeldev.onclick = function () {
  modaldeldev.style.display = "block";
};
spandeldev.onclick = function () {
  modaldeldev.style.display = "none";
  clearmodal();
};
btnaddev.onclick = function () {
  modaladdev.style.display = "block";
};
spanaddev.onclick = function () {
  modaladdev.style.display = "none";
  clearmodal();
};
btnchangedev.onclick = function () {
  modalchangedev.style.display = "block";
};
spanchangedev.onclick = function () {
  modalchangedev.style.display = "none";
  clearmodal();
};
