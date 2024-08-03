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

$sql = "SELECT * FROM queue_list WHERE status = 'PROCESSING' ORDER BY priority ASC";
$queue = $con -> query($sql) or die ($con -> error);
$row = $queue -> fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/form.css">
    <!-- <link rel="stylesheet" href="css/form.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li>
                <a href="display.php" class="logo" target="_blank">
                <img src="img/logo.png" alt="logo"></a>
            </li>

            <li><a href="index.php">
                <i class="fa-solid fa-house"></i>
                <span class="nav-item">Dashboard</span>
            </a></li>

            <li><a href="ready.php">
                <i class="fa-solid fa-circle-check"></i>
                <span class="nav-item">Ready</span>
            </a></li>

            <li><a href="oncall.php">
                <i class="fa-solid fa-bullhorn"></i>
                <span class="nav-item">Oncall</span>
            </a></li>

            <li><a href="processing.php">
                <i class="fa-regular fa-circle-check"></i>
                <span class="nav-item">Processing</span>
            </a></li>

            <li><a href="waiting.php">
                <i class="fa-solid fa-circle-pause"></i>
                <span class="nav-item">Waiting</span>
            </a></li>

            <br>
            <br>
            <br>

            <li><a href="priority1.php">
                <i class="fa-solid fa-circle"></i>
                <span class="nav-item">Priority 1</span>
            </a></li>

            <li><a href="priority2.php">
                <i class="fa-sharp fa-solid fa-circle-half-stroke fa-rotate-180"></i>
                <span class="nav-item">Priority 2</span>
            </a></li>

            <li><a href="priority3.php">
                <i class="fa-solid fa-circle-half-stroke"></i>
                <span class="nav-item">Priority 3</span>
            </a></li>

            <li><a href="priority4.php">
                <i class="fa-regular fa-circle"></i>
                <span class="nav-item">Priority 4</span>
            </a></li>

            <li><a href="history.php">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span class="nav-item">History</span>
            </a></li>

            <li><a href="logout.php" class="logout">
                <i class="fa-sharp fa-solid fa-right-from-bracket"></i>
                <span class="nav-item">Logout</span>
            </a></li>

        </ul>
    </nav>


    <h1>PROCESSING</h1>

    <table>
        <thead>
        <tr>
            <th>QUEUE NUMBER</th>
            <th>PRIORITY</th>
            <th>STATUS</th>
            <th>UPDATE STATUS</th>
            <th>DELETE</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
        <?php if (isset($row) && $row !== null) { ?>
        <tr>
            <td class="ticket"><?php echo $row['id'] ?></td>
            <td><?php echo $row['priority'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <td>
                <form id="update_form" method="post" action="processing_update.php" onsubmit="return confirm('\nAre you sure you want to UPDATE STATUS?');">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <select name="status">
                        <option value="READY">READY</option>
                        <option value="ONCALL">ONCALL</option>
                    </select>
                    <button type="submit">UPDATE</button>
                </form>
            </td>
            <td>
                <form id="update_form" method="post" action="processing_delete.php" onsubmit="return confirm('\nAre you sure you want to DELETE this item?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">DELETE</button>
                </form>
            </td>
        </tr>
        <?php }?>
        <?php }while($row = $queue -> fetch_assoc()) ?>
        </tbody>
    </table>
</body>
</html>