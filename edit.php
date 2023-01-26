<?php
session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header('Location: login.php');
    exit;
}

if(isset($_POST['submit'])) {
    include_once 'dbconfig.php';

    $username = $_SESSION['username'];
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($password)) {
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', password=MD5('$password') WHERE username='$username'";
    } else {
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email' WHERE username='$username'";
    }

    if(mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Account information updated successfully';
    } else {
        $_SESSION['message'] = 'Error updating account information';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account Information</title>
</head>
<body>
<a href="index.php">Home</a>
    <div>
        <?php
            if(isset($_SESSION['message'])) {
                echo "<p>{$_SESSION['message']}</p>";
                unset($_SESSION['message']);
            }
        ?>
    </div>

    <form method="post">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" required>
        <br>
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password">
        <br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
