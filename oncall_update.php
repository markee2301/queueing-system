<?php

// XAMPP CONNECTION
include_once("connections/connection.php");
$con = connection();

// GET THE FORM DATA
$id = $_POST['id'];
$status = $_POST['status'];

// UPDATE THE STATUS IN THE DATABASE
$sql = "UPDATE queue_list SET status='$status' WHERE id='$id'";

if ($con->query($sql) === TRUE) {
    echo header("Location: oncall.php");
} else {
    echo "Error updating status: " . $con->error;
}

// CLOSE THE DATABASE CONNECTION
$con->close();

?>