

$("#signup-form").submit(function (e) {
  e.preventDefault();
  data = $("#signup-form").serialize();
  console.log(data);
  $.ajax({
    type: "POST",
    url: "user.php",
    data,
    success: function (data) {
      alert(" Status: " + data);
      window.location = "login.php";
    },
    fail: function (data) {
      alert("something went wrong");
    },
  });
});


