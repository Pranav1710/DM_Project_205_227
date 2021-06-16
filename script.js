//execute on load of index.php

$(function () {
  $.ajax({
    type: "GET",
    url: "task.php",
    success: function (result) {
      var string = '';

      $.each(result, function (key, value) {
        var status = "";
        if(value['is_completed']){
          status = "checked";
        }
        console.log(status + value['is_completed'])
        string += `<tr>
        <td><input type="checkbox" name="list1" ${status}/>  <input type="text" class="task-display" id="edit${value['task_id']}" value = "${value['task_name']}" onfocusout = "disableField(event)" data-arg1="${value['task_id']}" disabled>  </td>
        <td>
          <i class="far fa-edit fa-icn fa-icn-small" onclick="edit_clicked(event)"  data-arg1="${value['task_id']}"></i>
          <i class="far fa-trash-alt fa-icn fa-icn-small" onclick="deleteTask(event)" id="${value['task_id']}" data-arg1="${value['task_id']}"></i>
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

$('#logout').click(function (){
  location.replace('http://localhost/todo%20list/auth');
})


function deleteTask(e) {
  var id = e.target.getAttribute('data-arg1');
  if(confirm("Are you sure you want to delete")){
    $.ajax({
      url: 'task.php' + '?' + $.param({"id": id}),
      method: 'DELETE',
      success: function(result) {
        window.location = "index.php";
          // handle success
      },
      error: function(request,msg,error) {
        console.log('something wrong');
          // handle failure
      }
  });
  }
}

// function updateTask(e){
$("#update-task").submit(function(e){
  e.preventDefault();
  var id = e.target.getAttribute('data-arg1');
  
  $.ajax({
    // url: 'task.php' + '?' + $.param({"id": id}),
    url: 'task.php' + '?' + $.param({"id": 21, "name": 'Pranav'}),
    method: 'PUT',
    success: function(result) {
      console.log(result);
      // handle success
    },
    error: function(request,msg,error) {
      console.log('something wrong');
        // handle failure
    }
});
})

function edit_clicked(e){
  var id = "edit" + e.target.getAttribute('data-arg1');
  var input = document.getElementById(id);
  console.log(id);
  input.classList.remove('task-display');
  input.removeAttribute('disabled');
}
function disableField(e){
  var id = "edit" + e.target.getAttribute('data-arg1');
  document.getElementById(id).setAttribute('disabled', true);
  var input = document.getElementById(id);
  input.classList.add('task-display');
  $.ajax({
    // url: 'task.php' + '?' + $.param({"id": id}),
    url: 'task.php' + '?' + $.param({"id": e.target.getAttribute('data-arg1'), "name": e.target.value}),
    method: 'PUT',
    success: function(result) {
      console.log(result);
      window.location = 'index.php';
      // handle success
    },
    error: function(request,msg,error) {
      console.log('something wrong');
        // handle failure
    }
});

}
