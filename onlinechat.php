<?php
session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header('Location: login.php');
    exit;
}

include_once 'dbconfig.php';

$query = "SELECT * FROM messages ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if(isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";

    if(mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Message sent';
    } else {
        $_SESSION['message'] = 'Error sending message';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <style>
        #chat-container {
  width: 500px;
  margin: 0 auto;
}

#messages {
  height: 300px;
  overflow-y: scroll;
  padding: 10px;
  background-color: #f5f5f5;
}

.message {
  margin-bottom: 10px;
}

.username {
  font-weight: bold;
}

#input-container {
  padding: 10px;
  background-color: #f5f5f5;
}

#message-input {
   
  width: 50%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

#send-button {
   background-color: green;
   color:white;

  padding: 10px;
  border-radius: 60px;
  border: 1px solid #ccc;
}

    </style>
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
    <div id="messages">
    <div id="chat">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <span class="username">   <strong><?php echo $row['username']; ?>:</strong></span>
            <span class="message-text">  <p> <?php echo $row['message']; ?></p></span>
        <?php } ?>
    </div>
    </div>
    <form method="post">

    <div id="input-container">
 
    <textarea name="message" type="text" id="message-input" placeholder="Type your message here"></textarea>



        <input type="submit" id="send-button" onclick="refresh()" name="submit" value="Send">

  
  
  
  </div>
        
        
    </form>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.18.0/ckeditor.js" integrity="sha512-woYV6V3QV/oH8txWu19WqPPEtGu+dXM87N9YXP6ocsbCAH1Au9WDZ15cnk62n6/tVOmOo0rIYwx05raKdA4qyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        function refresh(){
       
            window.location.replace("https://abidgurbanov0.alwaysdata.net/onlinechat/onlinechat.php");

        }
</script>


</html>
