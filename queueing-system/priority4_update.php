<?php

// XAMPP CONNECTION
include_once("connections/connection.php");
$con = connection();

// GET THE FORM DATA
$id = $_POST['id'];
$priority = $_POST['priority'];

// UPDATE THE PRIORITY IN THE DATABASE
$sql = "UPDATE queue_list SET priority='$priority' WHERE id='$id'";

if ($con->query($sql) === TRUE) {
    echo header("Location: priority4.php");
} else {
    echo "Error updating priority: " . $con->error;
}

// CLOSE THE DATABASE CONNECTION
$con->close();

?>