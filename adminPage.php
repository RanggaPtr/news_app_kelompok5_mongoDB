<?php
include('database.php');

// Fetch all news articles from the database
// $news = $collection->find();
// Fetch news articles from the database, sorted by created_at in descending order
$news = $collection->find([], ['sort' => ['created_at' => -1]]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZonaBerita</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>ZonaBerita</h1>
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
    let input = document.getElementById('search').value.toLowerCase();
    let newsItems = document.querySelectorAll('.news-item'); 

    newsItems.forEach(function(item) {

      let title = item.querySelector('h3').textContent.toLowerCase();

      if (title.indexOf(input) > -1) {
        item.style.display = ''; 
      } else {
        item.style.display = 'none'; 
      }
    });
  }
</script>

</body>
</html>
