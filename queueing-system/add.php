<?php
// SESSION
if(!isset($_SESSION)){
    session_start();
}

// SESSION VERIFICATION
if(isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator"){
    echo "";
}else{
    echo header("Location: login.php");
}

// XAMPP CONNECTION
include_once("connections/connection.php");
$con = connection();

// ADD FUNCTION
if(isset($_POST['add'])){

    $priority = $_POST['priority'];
    $status = $_POST['status'];
    
    $sql = "INSERT INTO `queue_list`(`priority`, `status`) VALUES ('$priority', '$status')";
    $con->query($sql) or die ($con->error);

    echo header("Location: index.php");

    // Retrieve the ID of the newly added data
$newID = $con->insert_id;

session_start();
$_SESSION['newID'] = $newID;

header("Location: print.php");
exit;
}

// Close the database connection
$con->close();

?>