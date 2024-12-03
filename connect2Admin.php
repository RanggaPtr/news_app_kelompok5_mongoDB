<?php
// Admin code for validation
$validAdminCode = "12345"; // Change this to your desired code

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminCode = $_POST['adminCode'] ?? '';

    if ($adminCode === $validAdminCode) {
        // Redirect to admin page if the code is correct
        header('Location: adminPage.php');
        exit;
    } else {
        // Redirect back to the main page with an error message
        echo "<script>alert('Invalid admin code. Please try again.'); window.location.href = 'userPage.php';</script>";
    }
}
?>