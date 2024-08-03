<?php

// XAMPP CONNECTION
include_once("connections/connection.php");
$con = connection();

// GET THE FORM DATA
$id = $_POST['id'];

// DELETE THE DATA FORM THE DATABASE
$query = "DELETE FROM queue_list WHERE id=$id";
mysqli_query($con, $query);

echo header('Location: priority1.php');

// CLOSE THE DATABASE CONNECTION
mysqli_close($con);

?>