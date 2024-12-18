<?php
include('database.php');

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$inc' => ['views' => 1]]
    );
    $article = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

    if ($article) {
        $createdAt = $article['created_at']->toDateTime();
        $createdAt->setTimezone(new DateTimeZone('Asia/Jakarta')); // Convert to local timezone
        $createdAtFormatted = $createdAt->format('d F Y, H:i'); // Format: 03 December 2024, 17:45

        $updatedAt = isset($article['updated_at'])
            ? $article['updated_at']->toDateTime()->setTimezone(new DateTimeZone('Asia/Jakarta'))->format('d F Y, H:i')
            : 'Not updated yet';

        // Display the article details

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
            $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
            $username = 'Anonymous'; // Tetapkan username sebagai 'Anonymous'
        
            // Insert the comment into the `comments` collection
            $commentsCollection->insertOne([
                'article_id' => new MongoDB\BSON\ObjectId($id),
                'username' => $username,
                'comment' => $comment,
                'created_at' => new MongoDB\BSON\UTCDateTime()
            ]);
        }
        

        // Retrieve comments linked to the current article
        $comments = $commentsCollection->find(['article_id' => new MongoDB\BSON\ObjectId($id)]);
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
                    <strong>Last updated:</strong> <?php echo $updatedAt; ?> |
                    <strong>Views:</strong> <?php echo htmlspecialchars($article['views']); ?>
                </p>
                <p class="news-meta">
                    <strong>Author:</strong> <?php echo htmlspecialchars($article['author'], ENT_QUOTES, 'UTF-8'); ?> |
                    <strong>Category:</strong> <?php echo htmlspecialchars($article['category'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <div class="news-image">
                    <?php if (!empty($article['image'])) {
                        echo "<img src=" . htmlspecialchars($article['image'], ENT_QUOTES, 'UTF-8') . " alt='Article Image' class='article-image'>";
                    } else {
                        echo "<p>No image available for this article.</p>";
                    } ?>
                </div>



                <!-- Summary -->
                <div class="news-summary">
                    <p><strong>Summary:</strong>
                        <?php echo nl2br(htmlspecialchars($article['summary'], ENT_QUOTES, 'UTF-8')); ?></p>
                </div>

                <!-- Content -->
                <div class="news-content">
                    <?php echo nl2br(htmlspecialchars($article['content'], ENT_QUOTES, 'UTF-8')); ?>
                </div>

                <div class="comments-section">
                    <h2>Comments</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="username" value="Anonymous"> <!-- Input tersembunyi -->
                        <label for="comment">Comment:</label><br>
                        <textarea id="comment" name="comment" rows="5" required></textarea><br><br>
                        <button type="submit">Submit Comment</button>
                    </form>

                    <div class="comments-list">
                        <?php foreach ($comments as $comment) {
                            $commentDate = $comment['created_at']->toDateTime()->setTimezone(new DateTimeZone('Asia/Jakarta'))->format('d F Y, H:i');
                            ?>
                            <div class="comment">
                                <p><strong><?php echo htmlspecialchars($comment['username'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                    (<?php echo $commentDate; ?>):</p>
                                <p><?php echo nl2br(htmlspecialchars($comment['comment'], ENT_QUOTES, 'UTF-8')); ?></p>
                            </div>
                        <?php } ?>
                    </div>
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