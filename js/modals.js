var modalsig = document.getElementById("signinModal");
var btnsig = document.getElementById("signinmodBtn");
var spansig = document.getElementsByClassName("close")[0];
var modalreg = document.getElementById("registerModal");
var btnreg = document.getElementById("registermodBtn");
var spanreg = document.getElementsByClassName("close")[1];
var btnreg1 = document.getElementById("registermodBtn1");
var btnsig1 = document.getElementById("signinmodBtn1");
btnreg1.onclick = function(){
    modalsig.style.display="none";
    clearmodal();
    modalreg.style.display="block";
}
btnsig1.onclick = function(){
    modalreg.style.display="none";
    clearmodal();
    modalsig.style.display="block";
}
btnreg.onclick = function(){
    modalreg.style.display="block";
}
spanreg.onclick = function(){
    modalreg.style.display="none";
    clearmodal();
}
btnsig.onclick = function(){
    modalsig.style.display="block";
}
spansig.onclick = function(){
    modalsig.style.display="none";
    clearmodal();
}
window.onclick = function(event){
    if(event.target == modalreg){
        modalreg.style.display="none";
        clearmodal();
    }
    if(event.target == modalsig){
        modalsig.style.display="none";
        clearmodal();
    }
}
function clearmodal(){
    $("#error1").hide();$("#error2").hide();$("#error3").hide();$("#error4").hide();$("#error5").hide();$("#error19").hide();$("#error29").hide();$("#error39").hide();$("#error49").hide();$("#error6").hide();$("#error7").hide();$("#error8").hide();$("#error9").hide();$("#error10").hide();$("#error11").hide();
    $("#username, #password, #username1, #email, #password1, #password2").removeClass("inputerror");
    $("#password1, #password2, #password, #username, #email, #username1").val("");
}