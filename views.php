<?php
require '../vendor/autoload.php'; 

$client = new MongoDB\Client("mongodb://localhost:27017"); 
$collection = $client->newsDatabase->newsCollection;

// Tambahkan field 'views' dengan nilai 0 jika belum ada
$collection->updateMany(
    ['views' => ['$exists' => false]],
    ['$set' => ['views' => 0]]
);

echo "View counters initialized.\n";
?>
