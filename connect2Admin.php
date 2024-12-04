<?php
$Code = "12345"; // Define your admin code

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminCode = $_POST['adminCode'] ?? '';

    if ($adminCode === $Code) {
        header('Location: adminPage.php'); // Redirect to the admin page
        exit;
    } else {
        echo "<script>
                alert('Invalid admin code. Please try again.');
                window.location.href = 'userPage.php'; // Redirect back to the homepage
              </script>";
        exit;
    }
}
?>