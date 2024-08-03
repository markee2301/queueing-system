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

// Retrieve the stored ID from the session
$newID = $_SESSION['newID'];

// Clear the session variable
unset($_SESSION['newID']);

date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TICKET NUMBER</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/print.css" media="print">
    <link rel="stylesheet" href="css/hide.css">
    <script>
      window.onload = function() {
        // Print the ID automatically when the new window is loaded
        window.print();
      };
    </script>
</head>
<body>
      <div class="receipt">
      <h1><?php echo $newID; ?></h1>
      <p>Date: <?php echo date('Y-m-d'); ?></p>
      <p>Time: <?php echo date('h:i:s A'); ?></p>
      <br>
      <h1><?php echo $newID; ?></h1>
      <p>Date: <?php echo date('Y-m-d'); ?></p>
      <p>Time: <?php echo date('h:i:s A'); ?></p>
      </div>
</body>
</html>