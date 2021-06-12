<?php
require_once('./config.php');
if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    $sql = "SELECT * FROM tasks ";
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
            echo "success";
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}
