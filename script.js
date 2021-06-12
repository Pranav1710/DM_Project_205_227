$(function () {
  $.ajax({
    type: "GET",
    url: "task.php",
    success: function (result) {
 
      var string = '';
      $.each(result, function (key, value) {
        string += `<tr>
        <td><input type="checkbox" name="list1" /> ${value['task_name']} </td>
        <td>
          <i class="far fa-edit fa-icn fa-icn-small"></i>
          <i class="far fa-trash-alt fa-icn fa-icn-small"></i>
        </td>
      </tr>`
          
      });
      $('#taskTable').html(string);
    },
    fail: function (data) {
      alert("something went wrong");
    },
  });
});

$("#taskForm").submit(function (e) {
  e.preventDefault();
  data = $("#taskForm").serialize();
  console.log(data);
  $.ajax({
    type: "POST",
    url: "task.php",
    data,
    success: function (data) {
      alert(" Status: " + data);
      window.location = "index.php";
    },
    fail: function (data) {
      alert("something went wrong");
    },
  });
});
