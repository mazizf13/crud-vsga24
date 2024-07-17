<?php 

session_start();

// restrict pages before logging 
if(!isset($_SESSION["login"])) {
    echo 
      "<script>
      alert('login dulu dong');
        document.location.href = 'login.php';
      </script>";
  
    exit;
}

// delete $_SESSION user login
$_SESSION = [];

session_unset();
session_destroy();

header("Location: login.php");

?>