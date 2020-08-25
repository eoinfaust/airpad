clearmodal();
$(document).ready(function () {
  $("#devicerename").submit(function (e) {
    clearmodal();
    e.preventDefault();
    var data = $("#devicerename").serializeArray();
    data.push({ name: "rename_device", value: "1" });
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
      } else {
        var arr = JSON.parse(data);
        if (arr[0]) {
          $("#newname").addClass("inputerror");
          $("#error7").show();
        } else if (arr[1]) {
          $("#newname").addClass("inputerror");
          $("#error8").show();
        } else if (arr[2]) {
          $("#newname").addClass("inputerror");
          $("#error9").show();
        } else {
          alert("An unknown error has occurred; please contact support.");
        }
      }
    });
  });
});
