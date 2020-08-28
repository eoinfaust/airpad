clearmodal();
$(document).ready(function () {
  $("#devicechange").submit(function (e) {
    clearmodal();
    e.preventDefault();
    var data = $("#devicechange").serializeArray();
    data.push({ name: "change_device", value: "1" });
    var devicevalue = $("#devicechosen :selected").val();
    data.push({ name: "oldname", value: devicevalue });
    var promise = $.ajax({
      type: "POST",
      url: "server.php",
      data: data,
      cache: false,
    });
    promise.then(function (data) {
      if (data === "success") {
        window.location.href = "account.php";
      } else if (data === "successren") {
        document.cookie =
          "activedevice=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        window.location.href = "account.php";
      } else {
        var arr = JSON.parse(data);
        if (arr[0]) {
          $("#newname").val("");
          $("#newname").addClass("inputerror");
          $("#error7").show();
        } else if (arr[1]) {
          $("#newname").val("");
          $("#newname").addClass("inputerror");
          $("#error8").show();
        } else {
          alert("An unknown error has occurred; please contact support.");
        }
      }
    });
  });
});
$("#change_device").click(function () {
  $("#newname").removeAttr("required");
});

$(window).on("load", validate);
function validate() {
  if ($("#turn-on").is(":checked")) {
    $("#notifications").show();
    $("#secswitch").show();
    $("#secswitch1").show();
    $("#notswitch").show();
    $("#notswitch1").show();
  } else {
    $("#notifications").hide();
    $("#secswitch").hide();
    $("#secswitch1").hide();
    $("#notswitch").hide();
    $("#notswitch1").hide();
  }
}

$(document).ready(function () {
  $("#turn-on").change(function () {
    if (this.checked) {
      $("#notifications").show();
      $("#secswitch").show();
      $("#secswitch1").show();
      $("#notswitch").show();
      $("#notswitch1").show();
    } else {
      $("#notifications").hide();
      $("#secswitch").hide();
      $("#secswitch1").hide();
      $("#notswitch").hide();
      $("#notswitch1").hide();
    }
  });
});
