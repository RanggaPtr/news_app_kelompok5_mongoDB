<?php
include('database.php');

// Fetch news articles from the database
$news = $collection->find();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News Website</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>News Website</h1>
    <input type="text" id="search" placeholder="Search news..." onkeyup="searchNews()">
  </header>

  <main>
    <div id="news-list">
      <?php
      foreach ($news as $article) {
        echo "<div class='news-item'>";
        echo "<h2><a href='news_detail.php?id=" . $article['_id'] . "'>" . $article['title'] . "</a></h2>";
        echo "<p>" . $article['summary'] . "</p>";
        echo "</div>";
      }
      ?>
    </div>
  </main>

  <script>
    function searchNews() {
      let input = document.getElementById('search').value.toLowerCase();
      let newsItems = document.querySelectorAll('.news-item');

      newsItems.forEach(function(item) {
        let title = item.querySelector('h2').textContent.toLowerCase();
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
