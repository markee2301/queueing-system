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

$sql = "SELECT * FROM queue_list WHERE status = 'WAITING' || status = 'PROCESSING' || status = 'READY' || status = 'ONCALL' ORDER BY priority ASC";
$queue = $con -> query($sql) or die ($con -> error);
$row = $queue -> fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/form.css">
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

            <li><a href="dashboard.php">
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

    <h1>DASHBOARD</h1>

    <!-- ADD DATA/QUEUE NUMBER -->
    <div class="form">
        <form class="add_form" action="add.php" method="post" target="_blank" onsubmit="return confirm('\nA NEW NUMBER WILL BE ADDED TO THE QUEUE.\nAre you sure you want to CONTINUE?');">

        <label>PRIORITY</label>
        <select name="priority" id="priority">
            <option value="4">4 (REGULAR)</option>
            <option value="2">2 (PWD)</option>
        </select>

        <label>&nbsp;&nbsp;&nbsp;STATUS</label>
        <select name="status" id="status">
            <option value="WAITING">WAITING</option>
            <option value="ONCALL">ONCALL</option>
            <option value="PROCESSING">PROCESSING</option>
        </select>

        <input type="submit" name="add" value="ADD NEW">&nbsp;&nbsp;&nbsp;
        <input type="button" class="refresh" value="REFRESH" onclick="location.reload();">
        </form>

    <br>
    </div>

    <table>
        <thead>
        <tr>
            <th>UPDATE PRIORITY</th>
            <th>CURRENT PRIORITY</th>
            <th>QUEUE NUMBER</th>
            <th>CURRENT STATUS</th>
            <th>UPDATE STATUS</th>
            <th>DELETE</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
        <?php if (isset($row) && $row !== null) { ?>
        <tr>
        <td>
            <form id="update_form" method="post" action="dashboard_update_priority.php" onsubmit="return confirm('\nAre you sure you want to update the PRIORITY?');">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <?php if ($row['priority'] != '1' && $row['priority'] != '3') { 
                    if ($row['status'] != 'WAITING') {
                ?>
                <select name="priority">
                    <?php if ($row['priority'] == '4') { ?>
                    <option value="3">3</option>
                    <?php } else if ($row['priority'] == '2') { ?>
                    <option value="1">1</option>
                    <?php } ?>
                </select>

                <button type="submit">UPDATE</button>

                    <?php } else {
                        echo '<span>WAITING</span>';
                    }
                } else { ?>
                    <span><?php echo $row['priority']; ?></span>
                <?php } ?>
            </form>
        </td>
            <td><?php echo $row['priority'] ?></td>
            <td class="ticket"><?php echo $row['id'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <td>
                <?php if ($row['status'] == 'WAITING') { ?>
                    <form id="update_form" method="post" action="dashboard_update_status.php" onsubmit="return print(event) && confirm('\nAre you sure you want to UPDATE STATUS?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <select name="status">
                            <option value="ONCALL">ONCALL</option>
                            <option value="PROCESSING">PROCESSING</option>
                        </select>
                        <button type="submit">UPDATE</button>
                    </form>
                <?php } else if ($row['status'] == 'ONCALL') { ?>
                    <form id="update_form" method="post" action="dashboard_update_status.php" onsubmit="return confirm('\nAre you sure you want to UPDATE STATUS?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <select name="status">
                            <option value="PROCESSING">PROCESSING</option>
                            <option value="READY">READY</option>
                        </select>
                        <button type="submit">UPDATE</button>
                    </form>
                <?php } else if ($row['status'] == 'PROCESSING') { ?>
                    <form id="update_form" method="post" action="dashboard_update_status.php" onsubmit="return confirm('\nAre you sure you want to UPDATE STATUS?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <select name="status">
                            <option value="READY">READY</option>
                            <option value="ONCALL">ONCALL</option>
                        </select>
                        <button type="submit">UPDATE</button>
                    </form>
                <?php } else if ($row['status'] == 'READY') { ?>
                    <form id="update_form" method="post" action="dashboard_update_status.php" onsubmit="return confirm('\nCurrent status is READY.\nAre you sure you want to UPDATE?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <select name="status">
                            <option value="DONE">DONE</option>
                            <option value="ONCALL">ONCALL</option>
                        </select>
                        <button type="submit">UPDATE</button>
                    </form>
                <?php } ?>
            </td>
            <td>
                <form id="update_form" method="post" action="dashboard_delete.php" onsubmit="return confirm('\nAre you sure you want to DELETE this item?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">DELETE</button>
                </form>
            </td>
        </tr>
        <?php } ?>
        <?php }while($row = $queue -> fetch_assoc()) ?>
        </tbody>
    </table>
</body>
</html>