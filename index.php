<?php
session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <a href="edit.php">Edit account</a>
    <a href="onlinechat.php">Write Message</a>
    
    <div>
        Welcome, <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?>!
    </div>
    <div>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
