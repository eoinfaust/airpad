clearmodal();
$(document).ready(function () {
  $("#devicedelete").submit(function (e) {
    clearmodal();
    e.preventDefault();
    var data = $("#devicedelete").serializeArray();
    data.push({ name: "delete_device", value: "1" });
    var devicevalue = $("#devicechosen :selected").val();
    data.push({ name: "devicefordeletion", value: devicevalue });
    var promise = $.ajax({
      type: "POST",
      url: "server.php",
      data: data,
      cache: false,
    });
    promise.then(function (data) {
      if (data === "success") {
        document.cookie =
          "activedevice=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        window.location.href = "account.php";
      } else {
        alert("An unknown error has occurred; please contact support.");
      }
    });
  });
});
