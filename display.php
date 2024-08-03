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

// WAITING
$sql_waiting = "SELECT * FROM queue_list WHERE status = 'WAITING' ORDER BY priority ASC";
$queue_waiting = $con -> query($sql_waiting) or die ($con -> error);
$row_waiting = $queue_waiting -> fetch_assoc();

// ONCALL
$sql_oncall = "SELECT * FROM queue_list WHERE status = 'ONCALL' ORDER BY priority ASC";
$queue_oncall = $con -> query($sql_oncall) or die ($con -> error);
$row_oncall = $queue_oncall -> fetch_assoc();

// PROCESSING
$sql_processing = "SELECT * FROM queue_list WHERE status = 'PROCESSING' ORDER BY priority ASC";
$queue_processing = $con -> query($sql_processing) or die ($con -> error);
$row_processing = $queue_processing -> fetch_assoc();

// READY
$sql_ready = "SELECT * FROM queue_list WHERE status = 'READY' ORDER BY priority ASC";
$queue_ready = $con -> query($sql_ready) or die ($con -> error);
$row_ready = $queue_ready -> fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/display.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <br>

        <div class="container">
        
            <!-- WAITING -->
            <table class="waiting">
            <thead>
            <tr>
                <th>WAITING</th>
            </tr>
            </thead>
            <tbody>
            <?php do { ?>
            <?php if (isset($row_waiting) && $row_waiting !== null) { ?>
                <tr>
                    <td><?php echo $row_waiting['id'] ?></td>
                </tr>
            <?php } ?>
            <?php } while ($row_waiting = $queue_waiting->fetch_assoc()); ?>
            </tbody>
            </table>
    
            <!-- PROCESSING -->
            <table class="processing">
            <thead>
            <tr>
                <th>PROCESSING</th>
            </tr>
            </thead>
            <tbody>
            <?php do { ?>
            <?php if (isset($row_processing) && $row_processing !== null) { ?>
                <tr>
                    <td><?php echo $row_processing['id'] ?></td>
                </tr>
            <?php } ?>
            <?php } while ($row_processing = $queue_processing->fetch_assoc()); ?>
            </tbody>
            </table>

                 <!-- ONCALL -->
                 <table class="oncall">
            <thead>
            <tr>
                <th>ONCALL</th>
            </tr>
            </thead>
            <tbody>
            <?php do { ?>
            <?php if (isset($row_oncall) && $row_oncall !== null) { ?>
                <tr>
                    <td><?php echo $row_oncall['id'] ?></td>
                </tr>
            <?php } ?>
            <?php } while ($row_oncall = $queue_oncall->fetch_assoc()); ?>
            </tbody>
            </table>

            <!-- READY -->
            <table class="ready">
            <thead>
            <tr>
                <th>READY</th>
            </tr>
            </thead>
            <tbody>
            <?php do { ?>
            <?php if (isset($row_ready) && $row_ready !== null) { ?>
                <tr>
                    <td><?php echo $row_ready['id'] ?></td>
                </tr>
            <?php } ?>
            <?php } while ($row_ready = $queue_ready->fetch_assoc()); ?>
            </tbody>
            </table>
        </div>

        <!-- PAGE REFRESHER FOR REALTIME DISPLAY OF DATABASE -->
    <script>
            setInterval(function(){
            location.reload();
        }, 3000);
    </script>

</body>
</html>