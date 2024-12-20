<?php
include('database.php');
// Fetch news articles from the database, sorted by created_at in descending order
$news = $collection->find([], ['sort' => ['created_at' => -1]]);

// Fetch selected category from request
$selectedCategory = $_GET['category'] ?? '';

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
    <title>ZonaBerita</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="header-container">
            <h1>ZonaBerita</h1>
            <button id="top-right-button" onclick="loginAdmin()">Login Admin</button>
        </div>
        <div class="filter-buttons">
            <button class="filter-button" onclick="filterByCategory('')">All Categories</button>
            <?php
            foreach ($categories as $category) {
                $activeClass = $selectedCategory === $category ? 'active' : '';
                echo "<button class='filter-button $activeClass' onclick=\"filterByCategory('$category')\">$category</button>";
            }
            ?>
        </div>
        <input type="text" id="search" placeholder="Search news..." onkeyup="searchNews()">
    </header>

    <main class="wrapper">
        <div id="news-list">
        <?php
            foreach ($news as $article) {
                $createdAtUTC = $article['created_at']->toDateTime();
                $createdAtUTC->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $createdAt = $createdAtUTC->format('d M Y, H:i');

                echo "<div class='news-item'>";
                // Tampilkan gambar jika ada
                if (!empty($article['image'])) {
                    echo "<img src='" . htmlspecialchars($article['image']) . "' alt='" . htmlspecialchars($article['title']) . "' style='max-width: 440px; height: auto; margin-bottom: 10px;'>";
                }
                echo "<p>Views: " . htmlspecialchars($article['views'] ?? 0) . "</p>";
                echo "<h2><a href='news_detail.php?id=" . $article['_id'] . "'>" . htmlspecialchars($article['title']) . "</a></h2>";
                echo "<p><strong>Date:</strong> " . htmlspecialchars($createdAt) . " | <strong>Category:</strong> " . htmlspecialchars($article['category']) . "</p>";
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

    function loginAdmin() {
        let adminCode = prompt("Please enter the admin code:");
        if (adminCode === null || adminCode.trim() === '') return; // Handle cancel or empty input

        // Send the admin code to the PHP page for validation
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = 'connect2Admin.php'; // Ensure the validation script matches this file

        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'adminCode';
        input.value = adminCode;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    function filterByCategory(category) {
        const url = new URL(window.location.href);
        url.searchParams.set('category', category); // Set parameter for category
        window.location.href = url.toString(); // Redirect to the updated URL
    }
    </script>
</body>

</html>
