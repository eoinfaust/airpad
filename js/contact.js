clearmodals();
$("#loading").hide();
$(document).ready(function () {
  $("#contactform").submit(function (e) {
    $("#loading").show();
    clearmodals();
    e.preventDefault();
    var data = $("#contactform").serializeArray();
    data.push({ name: "contact", value: "1" });
    var promise = $.ajax({
      type: "POST",
      url: "server.php",
      data: data,
      cache: false,
    });
    promise.then(function (data) {
      $("#loading").hide();
      if (data === "success") {
        $("#name, #email, #message").val("");
        $("#success").show();
        setTimeout(function () {
          window.location.href = "index.php";
        }, 2000);
      } else if (data === "mailfail") {
        alert(
          "An unknown error occurred - please check you email address is correct."
        );
      } else {
        var arr = JSON.parse(data);
        if (arr[0]) {
          $("#name").addClass("inputerror");
          $("#error1").show();
        } else if (arr[5]) {
          $("#name").addClass("inputerror");
          $("#error6").show();
        }
        if (arr[1]) {
          $("#email").addClass("inputerror");
          $("#error2").show();
        } else if (arr[2]) {
          $("#email").addClass("inputerror");
          $("#error3").show();
        }
        if (arr[3]) {
          $("#message").addClass("inputerror");
          $("#error4").show();
        } else if (arr[4]) {
          $("#message").addClass("inputerror");
          $("#error5").show();
        }
      }
    });
  });
});
function clearmodals() {
  $("#error1").hide();
  $("#error2").hide();
  $("#error3").hide();
  $("#error4").hide();
  $("#error5").hide();
  $("#error6").hide();
  $("#success").hide();
  $("#name, #email, #message").removeClass("inputerror");
}
