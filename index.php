<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Todo List</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <div class="container clearfix">
      <div class="logo">
        <span class="primary-logo-text">To-do </span><span class="secondary-logo-text">List</span>
      </div>
      <?php
        session_start();
        if(isset($_SESSION['uname'])){ ?>
          <a href="./auth/login.php"><button class="btn btn-login float-right" id="logout">Logout</button></a>
        <?php } else { ?>
          <a href="./auth/login.php"><button class="btn btn-login float-right">LogIn</button></a>
        <?php } ?>
    </div>
  </header>

  <main class="container margin-top-mediam">
    <div class="grid-layout">
      <div class="todo-list">
        <h1 class="primary-text">
          <?php
            if(isset($_SESSION['uname'])){
              echo "What is today's plan, ". $_SESSION['uname'];
            }else{
              echo "do what you are supposed to do";
            }
          ?>
           <!-- <i class="far fa-trash-alt fa-icn fa-icn-big"></i> -->
        </h1>
        <form action="task.php" method="post" class="list-item" id="taskForm">
          <input type="text" placeholder="Write Your Task Here" name="task_name" maxlength="34" />
          <div class="list-control">
            <button class="btn btn-primary" type="submit" id="taskSubmit">Add Task</button>
          </div>
        </form>

        <table class="task-table margin-top-big" id="taskTable">

        </table>
      </div>

      <div class="sidebar">
        <h2 class="title">
          <span class="primary-logo-text">My </span><span class="secondary-logo-text"> Lists</span>
        </h2>
      </div>
    </div>
  </main>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./script.js"></script>
</body>

</html>