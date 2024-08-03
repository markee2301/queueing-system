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
    echo header("Location: index.php");
} else {
    echo "Error updating status: " . $con->error;
}

// ADD CURRENT DATETIME TO DATABASE
if ($status === 'DONE') {
    $query = "UPDATE queue_list SET status='$status', finished_at=NOW() WHERE id=$id";
    mysqli_query($con, $query);
} else {
    $query = "UPDATE queue_list SET status='$status' WHERE id=$id";
    mysqli_query($con, $query);
}

// CLOSE THE DATABASE CONNECTION
$con->close();

?>