<?php
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $author = $_POST['author'];  // New field for author
    $category = $_POST['category'];  // New field for category

    // Masukkan data ke dalam database MongoDB
    $collection->insertOne([
        'title' => $title,
        'summary' => $summary,
        'content' => $content,
        'author' => $author,  // Store the author
        'category' => $category,  // Store the category
        'created_at' => new MongoDB\BSON\UTCDateTime(),
        'updated_at' => new MongoDB\BSON\UTCDateTime()  // Add updated_at field
    ]);

    // Redirect ke halaman admin
    header("Location: adminPage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create News Article</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Create News Article</h1>
  </header>

  <main>
    <form action="create.php" method="POST">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" required>
      
      <label for="content">Content</label>
      <textarea id="content" name="content" required></textarea>
      
      <label for="summary">Summary</label>
      <textarea id="summary" name="summary" required></textarea>


      <label for="author">Author</label>
      <input type="text" id="author" name="author" required> <!-- New input for author -->

      <label for="category">Category</label>
      <input type="text" id="category" name="category" required> <!-- New input for category -->

      <button type="submit">Create Article</button>
    </form>
  </main>
</body>
</html>
