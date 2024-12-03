<?php
include('database.php');

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $article = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

    if ($article) {
        $createdAt = $article['created_at']->toDateTime();
        $createdAt->setTimezone(new DateTimeZone('Asia/Jakarta')); // Convert to local timezone
        $createdAtFormatted = $createdAt->format('d F Y, H:i'); // Format: 03 December 2024, 17:45

        $updatedAt = isset($article['updated_at'])
            ? $article['updated_at']->toDateTime()->setTimezone(new DateTimeZone('Asia/Jakarta'))->format('d F Y, H:i')
            : 'Not updated yet';

        // Display the article details
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></title>
            <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS -->
        </head>
        <body class="detail">
            <div class="container">
                <h1 class="news-title"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="news-meta">
                    <strong>Published on:</strong> <?php echo $createdAtFormatted; ?> |
                    <strong>Last updated:</strong> <?php echo $updatedAt; ?>
                </p>
                <p class="news-meta"><strong>Author:</strong> <?php echo htmlspecialchars($article['author'], ENT_QUOTES, 'UTF-8'); ?></p>

                <!-- Summary -->
                <div class="news-summary">
                    <p><strong>Summary:</strong> <?php echo nl2br(htmlspecialchars($article['summary'], ENT_QUOTES, 'UTF-8')); ?></p>
                </div>

                <!-- Content -->
                <div class="news-content">
                    <?php echo nl2br(htmlspecialchars($article['content'], ENT_QUOTES, 'UTF-8')); ?>
                </div>

                <!-- Back Link -->
            </div>
            <a href="userPage.php" class="back-link">← Back to News List</a>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Article not found!</p>";
    }
} else {
    echo "<p>No article ID provided!</p>";
}
?>