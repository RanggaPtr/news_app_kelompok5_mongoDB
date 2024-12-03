<?php
include('database.php');

// Fetch all news articles from the database
$news = $collection->find();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page - Manage News</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Admin Panel</h1>
    <input type="text" id="search" placeholder="Search news..." onkeyup="searchNews()">
  </header>
  
  <main>
    <h2>Manage News Articles</h2>
    <nav>
      <a href="create.php">Create New Article</a>
    </nav>

    <div id="news-list">
      <?php
      if ($news->isDead()) {
          echo "<p>No articles available</p>";
      } else {
          foreach ($news as $article) {
              echo "<div class='news-item'>";
              echo "<h3><a href='news_detail.php?id=" . $article['_id'] . "'>" . htmlspecialchars($article['title']) . "</a></h3>";
              echo "<p>" . htmlspecialchars($article['summary']) . "</p>";
              echo "<a href='edit.php?id=" . $article['_id'] . "'>Edit</a> | ";
              echo "<a href='delete.php?id=" . $article['_id'] . "' onclick='return confirm(\"Are you sure you want to delete this article?\")'>Delete</a>";
              echo "</div>";
          }
      }
      ?>
    </div>
  </main>

  <script>
  function searchNews() {
    let input = document.getElementById('search').value.toLowerCase(); // Ambil nilai input
    let newsItems = document.querySelectorAll('.news-item'); // Pilih semua item berita

    newsItems.forEach(function(item) {
      // Ambil teks dari elemen <h3>
      let title = item.querySelector('h3').textContent.toLowerCase();

      // Cocokkan dengan input pencarian
      if (title.indexOf(input) > -1) {
        item.style.display = ''; // Tampilkan item jika cocok
      } else {
        item.style.display = 'none'; // Sembunyikan item jika tidak cocok
      }
    });
  }
</script>

</body>
</html>
