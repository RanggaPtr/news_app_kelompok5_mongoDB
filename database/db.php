<?php
require '../vendor/autoload.php';
function getDB()
{
    $client = new MongoDB\Client("mongodb://localhost:27017");
    return $client->news_database; // Nama database 
}
?>