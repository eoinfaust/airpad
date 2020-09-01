clearmodal();
$("#loading").hide();
$(document).ready(function () {
  $("#registerform").submit(function (e) {
    $("#loading").show();
    clearmodal();
    e.preventDefault();
    var data = $("#registerform").serializeArray();
    data.push({ name: "reg_user", value: "1" });
    var promise = $.ajax({
      type: "POST",
      url: "server.php",
      data: data,
      cache: false,
    });
    $("#password1, #password2").val("");
    promise.then(function (data) {
      $("#loading").hide();
      if (data === "success") {
        window.location.href = "index.php";
      } else if (data === "mailfail") {
        alert("An unknown error occured; please contact support.");
      } else {
        var arr = JSON.parse(data);
        if (arr[0]) {
          $("#username1").addClass("inputerror");
          $("#error1").show();
        } else if (arr[1]) {
          $("#username1").val("");
          $("#username1").addClass("inputerror");
          $("#error2").show();
        } else if (arr[2]) {
          $("#username1").val("");
          $("#username1").addClass("inputerror");
          $("#error3").show();
        } else if (arr[9]) {
          $("#username1").val("");
          $("#username1").addClass("inputerror");
          $("#error10").show();
        }
        if (arr[3]) {
          $("#email").val("");
          $("#email").addClass("inputerror");
          $("#error4").show();
        } else if (arr[4]) {
          $("#email").val("");
          $("#email").addClass("inputerror");
          $("#error5").show();
        } else if (arr[10]) {
          $("#email").val("");
          $("#email").addClass("inputerror");
          $("#error11").show();
        }
        if (arr[5]) {
          $("#password1, #password2").addClass("inputerror");
          $("#error6").show();
        } else if (arr[6]) {
          $("#password1, #password2").addClass("inputerror");
          $("#error7").show();
        } else if (arr[8]) {
          $("#password1, #password2").addClass("inputerror");
          $("#error9").show();
        }
        if (arr[7]) {
          $("#password1, #password2").addClass("inputerror");
          $("#error8").show();
        }
      }
    });
  });
});
$("#loading").hide();
$("#loading")
  .bind("ajaxStart", function () {
    $(this).show();
  })
  .bind("ajaxStop", function () {
    $(this).hide();
  });
