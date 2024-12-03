<?php
require '../vendor/autoload.php'; // Use Composer for MongoDB driver

// MongoDB Connection
$client = new MongoDB\Client("mongodb://localhost:27017"); // Replace with your MongoDB URI
$collection = $client->newsDatabase->newsCollection; // Database and collection
?>
