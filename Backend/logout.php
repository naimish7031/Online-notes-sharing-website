<?php
session_start();
include 'config.php';


if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

 
    session_unset();
    session_destroy();
}


echo "<script>
    alert('User Successfully Logged Out!');
    window.location='../frontend/index.html';
</script>";
exit();
?>
