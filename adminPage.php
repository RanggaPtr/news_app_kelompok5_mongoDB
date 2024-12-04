<?php
include('database.php');
// Fetch selected category from request
$selectedCategory = $_GET['category'] ?? '';

<<<<<<< HEAD
// Fetch all news articles from the database
// $news = $collection->find();

// Fetch news articles from the database, sorted by created_at in descending order
$news = $collection->find([], ['sort' => ['created_at' => -1]]);
// Fetch selected category from request
$selectedCategory = $_GET['category'] ?? '';

=======
>>>>>>> 748a18072065cf01fbf23f5233be058ef37b695d
// Query to fetch news articles based on selected category, sorted by created_at in descending order
$query = $selectedCategory ? ['category' => $selectedCategory] : [];
$news = $collection->find($query, ['sort' => ['created_at' => -1]]);

// Fetch all unique categories from the database
$categories = $collection->distinct('category');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZonaBerita - Admin</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
<<<<<<< HEAD
  <h1>ZonaBerita</h1>
=======
  <h1>ZonaBerita - Admin Page</h1>
>>>>>>> 748a18072065cf01fbf23f5233be058ef37b695d
  <div class="filter-container">
            <label for="category-select">Filter by Category:</label>
            <select id="category-select" onchange="filterByCategory()">
                <option value="">All Categories</option>
                <?php
                foreach ($categories as $category) {
                    $selected = $selectedCategory === $category ? 'selected' : '';
                    echo "<option value='$category' $selected>$category</option>";
                }
                ?>
            </select>
        </div>
  <input type="text" id="search" placeholder="Search news..." onkeyup="searchNews()">
  <a href="userPage.php" class="btn-user-page">Back to User Page</a>
  <style>
    
  .btn-user-page {
      display: inline-block;
      margin-left: 10px;
      padding: 10px 15px;
      background-color: #FFF;
      color: #34495e;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
  }

  .btn-user-page:hover {
    font-style: italic;
  }
</style>
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
              $createdAt = $article['created_at']->toDateTime()->format('d M Y, H:i'); // Format waktu
              echo "<div class='news-item'>";
              echo "<h3><a href='news_detail.php?id=" . $article['_id'] . "'>" . htmlspecialchars($article['title']) . "</a></h3>";
              echo "<p><strong>Summary:</strong> " . htmlspecialchars($article['summary']) . "</p>";
              echo "<p><strong>Date:</strong> " . $createdAt . "</p>";
              echo "<a href='edit.php?id=" . $article['_id'] . "' class='btn btn-primary'>Edit</a> | ";
              echo "<a href='delete.php?id=" . $article['_id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this article?\")'>Delete</a>";
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

  function filterByCategory() {
        const category = document.getElementById('category-select').value;
        const url = new URL(window.location.href);
        url.searchParams.set('category', category); // Set parameter for category
        window.location.href = url.toString(); // Redirect to the updated URL
    }
</script>

</body>
</html>
