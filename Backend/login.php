<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            
            
            header("Location: ../frontend/dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.location='../frontend/login.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location='../frontend/register.html';</script>";
    }
}
?>
