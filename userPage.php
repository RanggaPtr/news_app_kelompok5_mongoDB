<?php
include('database.php');

// Fetch news articles from the database asc
// $news = $collection->find();

// Fetch news articles from the database, sorted by created_at in descending order
$news = $collection->find([], ['sort' => ['created_at' => -1]]);

// Ambil kategori yang dipilih dari request
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Jika kategori dipilih, filter berita berdasarkan kategori
if ($selectedCategory) {
    $news = $collection->find(['category' => $selectedCategory], ['sort' => ['created_at' => -1]]);
} else {
    // Jika tidak ada kategori yang dipilih, tampilkan semua berita
    $news = $collection->find([], ['sort' => ['created_at' => -1]]);
}

// Ambil semua kategori unik dari database
$categories = $collection->distinct('category');
?>
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
    </header>


    <main>
        <div id="news-list">
            <?php
            foreach ($news as $article) {
                $createdAtUTC = $article['created_at']->toDateTime();
                $createdAtUTC->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $createdAt = $createdAtUTC->format('d M Y, H:i');
                echo "<div class='news-item'>";
                echo "<h2><a href='news_detail.php?id=" . $article['_id'] . "'>" . $article['title'] . "</a></h2>";
                echo "<p><strong>Date:</strong> " . $createdAt . "</p>";
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

            newsItems.forEach(function (item) {
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
            if (adminCode === null) return; // User pressed cancel

            // Send the admin code to the PHP page for validation
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'adminPage.php';

            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'admin_code';
            input.value = adminCode;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        function filterByCategory() {
            const category = document.getElementById('category-select').value;
            const url = new URL(window.location.href);
            url.searchParams.set('category', category); // Set parameter kategori
            window.location.href = url.toString(); // Redirect ke URL baru
        }

    </script>
</body>

</html>