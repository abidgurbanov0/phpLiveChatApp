<?php
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('Location: index.php');
    exit;
}

if(isset($_POST['submit'])) {
    include_once 'dbconfig.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "INSERT INTO users (username, password, firstname, lastname, email) VALUES ('$username', MD5('$password'), '$firstname', '$lastname', '$email')";

    if(mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Registration successful';
        header('Location: login.php');
        exit;
    } else {
        $_SESSION['message'] = 'Error with registration';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<a href="login.php">Login</a>
    <div>
        <?php
            if(isset($_SESSION['message'])) {
                echo "<p>{$_SESSION['message']}</p>";
                unset($_SESSION['message']);
            }
        ?>
    </div>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" required>
        <br>
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>
