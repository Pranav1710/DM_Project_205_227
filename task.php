<?php
require_once('./config.php');
if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    session_start();
    if (isset($_SESSION['id'])) {
        $sql = "SELECT users_task.task_id, tasks.task_name, tasks.is_completed FROM `users_task` NATURAL JOIN tasks WHERE users_task.user_id =". $_SESSION['id'];
    }
    // $sql = "SELECT * FROM tasks ";
    $result = $link->query($sql);

    /* If there are results from database push to result array */
    $result_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }
    }
    /* send a JSON encded array to client */
    header('Content-type: application/json');
    echo json_encode($result_array);
}

function getTaskId($link)
{
    $sql = "SELECT task_id from tasks order by task_id desc ";
    $result = $link->query($sql);

    $row = $result->fetch_assoc();
    // echo $row['task_id'];
    return $row['task_id'];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "INSERT INTO tasks VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "isi", $param_id, $param_name, $is_completed);
        //asd

        // Set parameters
        $param_id = "";
        $param_name = $_POST['task_name'];
        $is_completed = 0;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records created successfully. Redirect to landing page

            // add to user_tasks
            $sql2 = "INSERT INTO users_task VALUES (?, ?)";

            if ($stmt = mysqli_prepare($link, $sql2)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ii", $user_id, $task_id);

                // Set parameters
                $temp = NULL;
                session_start();
                if (isset($_SESSION['id'])) {
                    $temp = $_SESSION['id'];
                }
                $user_id = $temp;
                $task_id = getTaskId($link);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "success";
                }
            }
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $sql = "DELETE from tasks where task_id =" . $_GET['id'];
    if ($link->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "fail";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $sql = "UPDATE tasks set task_name = ? WHERE task_id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "si", $param_name, $param_id);
        //asd

        // Set parameters
        $param_name = $_GET['name'];
        $param_id = $_GET['id'];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "fail";
        }
    }
}