

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

$("#signin-form").submit(function (e) {
  e.preventDefault();
  data = $("#signin-form").serialize();
  console.log(data);
  $.ajax({
    type: "GET",
    url: "user.php",
    data,
    success: function (data) {
      alert(" Status: " + data);
      window.location = "../index.php";
    },
    fail: function (data) {
      alert("something went wrong");
    },
  });
});
