<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="dashboard-container">
    <div class="card">
        
      <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</h2>
       <h3 style="color:darkgoldenrod">“Learn smarter, revise faster, and master your subjects effortlessly with the best handwritten notes.”</h3>

      <div class="buttons">
        <button onclick="window.location.href='get-notes.php'">View Notes</button>
        
      </div>

    </div>
   
  </div>
</body>
</html>
