<?php
include('database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus berita dari database
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    // Redirect ke halaman admin setelah artikel dihapus
    header("Location: adminPage.php");
    exit();
}
?>
