<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "todo_list";

// Create connection
$link = new mysqli($servername, $username, $password,$db);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}
?>