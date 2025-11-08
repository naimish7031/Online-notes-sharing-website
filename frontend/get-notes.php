<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include __DIR__ . '/../backend/config.php';

$sql = "SELECT * FROM notes ORDER BY uploaded_on DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Available Notes</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #f7f9fc;
      margin: 0;
      padding: 0;
    }
    header {
      background: #0078ff;
      color: white;
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      padding: 15px 40px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    header h2 {
      margin: 0;
      font-size: 22px;
    }
    .btn {
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      color: white;
      font-weight: 500;
      cursor: pointer;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn:hover {
      opacity: 0.8;
    }
    .home-btn {
      background: #28a745;
    }
    .logout-btn {
      background: #dc3545;
    }
    .dash-btn{
      background:#28a728;
    }
    main {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      padding: 20px 40px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    .note-card {
      border: 1px solid #eee;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
      background: #fafafa;
      transition: 0.3s;
    }
    .note-card:hover {
      background: #f0f8ff;
    }
    .note-card h3 {
      color: #0078ff;
      margin-bottom: 5px;
    }
    .note-card p {
      margin: 5px 0 10px;
      color: #555;
    }
    .download-link {
      color: #0078ff;
      text-decoration: none;
      font-weight: 500;
    }
  </style>
</head>
<body>

<header>
  <a href="index.html" class="btn home-btn"> Home</a>
  <h2 style="text-align: center;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']);?>! </h2>
   <a href="../frontend/dashboard.php" class="btn dash-btn"> Dashboard</a>
  <a href="../backend/logout.php" class="btn logout-btn"> Logout</a>
  
</header>

<main>
  <h2 style="text-align:center;"> Available Notes</h2>
  <p style="text-align:center; color:#666;">Download the best handwritten and digital notes — easy to learn and revise!</p>
  <hr><br>

  <?php
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $file_name = $row['file_name'];
          $title = isset($row['Title']) ? $row['Title'] : 'Untitled';
          $description = isset($row['Description']) ? $row['Description'] : 'No description available.';
          $file_path = '../uploads/' . urlencode($file_name);

          echo "<div class='note-card'>
                  <h3>" . htmlspecialchars($title) . "</h3>
                  <p>" . htmlspecialchars($description) . "</p>
                  <a href='$file_path' download class='download-link'> Download</a>
                  
                </div>";
      }
  } else {
      echo "<p style='text-align:center;'>No notes uploaded yet!</p>";
  }
  
  ?>
</main>


</body>
</html>
