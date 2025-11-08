<?php
include 'config.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    
    if($stmt->execute()) {
        echo "<script>
                alert('User Successfully Registered!');
                window.location='../frontend/login.html';
              </script>";
    } else {
        echo "<script>
                alert('Error: Could not register user. Try again!');
                window.location='../frontend/register.html';
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
