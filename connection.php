<?php
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function getConnection(information) {
   $dbHost = $_ENV['DB_HOST'];
   $dbName = $_ENV['DB_NAME']; // We don't need the name, we're going to query two tables.
   $dbUser = $_ENV['DB_USER'];
   $dbPass = $_ENV['DB_PASSWORD'];

   $connection = new mysqli($dbHost, $dbUser, $dbPass)

   if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
   }
   return $connection
}

function getTablesWithJoin(connection) {
    $stmt = $connection->prepare("SELECT * FROM mdl_block_simplecamera_analysis");
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    return $res ? $res : -1;
}
