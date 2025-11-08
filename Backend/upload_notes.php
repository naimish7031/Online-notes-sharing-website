<?php
include __DIR__ . '/config.php';

if (isset($_POST['upload'])) {
    $title = $_POST['title'] ?? 'Untitled';
    $description = $_POST['description'] ?? '';

    if (isset($_FILES['noteFile'])) {
        $file_name = $_FILES['noteFile']['name'];
        $file_tmp = $_FILES['noteFile']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed = ['pdf', 'doc', 'docx', 'txt', 'pptx'];
        if (in_array($file_ext, $allowed)) {
            $upload_dir = __DIR__ . '/../uploads/';

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $new_file_name = time() . '_' . str_replace(' ', '_', $file_name);

            if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                $sql = "INSERT INTO notes (title, description, file_name) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $title, $description, $new_file_name);

                if ($stmt->execute()) {
                    echo "<script>
                        alert('Notes uploaded successfully!');
                        setTimeout(function(){
                            window.location.href = '../frontend/index.html';
                        }, 1500);
                    </script>";
                    exit();
                } else {
                    echo "<script>alert('Database error: " . addslashes($stmt->error) . "');</script>";
                }
            } else {
                echo "<script>alert('Failed to move uploaded file!');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type! Only PDF, DOC, DOCX, TXT, PPTX allowed.');</script>";
        }
    } else {
        echo "<script>alert('Please select a file to upload.');</script>";
    }
}
?>
