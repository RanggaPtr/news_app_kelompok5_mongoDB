<?php
include('database.php');

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; 

    // Fetch the article from the database by its ID
    $article = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

    // If the article is found
    if ($article) {
        // Format the created_at and updated_at fields (if exists)
        $createdAt = $article['created_at']->toDateTime()->format('Y-m-d H:i:s');
        $updatedAt = isset($article['updated_at']) ? $article['updated_at']->toDateTime()->format('Y-m-d H:i:s') : 'Not updated yet';

        // Display the article details
        echo "<h1>" . htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') . "</h1>";
        echo "<p><strong>Author:</strong> " . htmlspecialchars($article['author'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>Published on:</strong> " . $createdAt . "</p>";
        echo "<p><strong>Last updated on:</strong> " . $updatedAt . "</p>";
        echo "<div><strong>Summary:</strong><p>" . nl2br(htmlspecialchars($article['summary'], ENT_QUOTES, 'UTF-8')) . "</p></div>"; // Added summary for better details
        echo "<div><strong>Content:</strong><p>" . nl2br(htmlspecialchars($article['content'], ENT_QUOTES, 'UTF-8')) . "</p></div>";
    } else {
        echo "<p>Article not found!</p>";
    }
} else {
    echo "<p>No article ID provided!</p>";
}
?>
