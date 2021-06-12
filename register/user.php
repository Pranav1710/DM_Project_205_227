<?php
require_once('../config.php');
if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    $sql = "SELECT * FROM users";
    $result = $link->query($sql);
    /* If there are results from database push to result array */
    // $result_array = [];
    $status = 'fail';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($row['email'] === $_GET['email'] && $row['password'] === $_GET['password']){
                $status =  "success";
                break;
            }
        }
        echo $status;
    }
    /* send a JSON encded array to client */
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "INSERT INTO users VALUES (?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "isss", $param_id, $param_uname, $param_email, $param_password);
        //asd
        
        // Set parameters
        $param_id = "";
        $param_uname = $_POST['user_name'];
        $param_email = $_POST['user_email'];
        $param_password = $_POST['user_password'];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records created successfully. Redirect to landing page
            echo "success";
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}
