<?php
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];

    // Update data berita di MongoDB
    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($id)],
        ['$set' => [
            'title' => $title,
            'summary' => $summary,
            'content' => $content,
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ]]
    );

    // Redirect ke halaman admin
    header("Location: adminPage.php");
    exit();
}

$id = $_GET['id'];
$article = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit News Article</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Edit News Article</h1>
  </header>

  <main>
    <form action="edit.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $article['_id']; ?>">

      <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>

      <label for="summary">Summary</label>
      <textarea id="summary" name="summary" required><?php echo htmlspecialchars($article['summary']); ?></textarea>

      <label for="content">Content</label>
      <textarea id="content" name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>

      <button type="submit">Update Article</button>
    </form>
  </main>
</body>
</html>
