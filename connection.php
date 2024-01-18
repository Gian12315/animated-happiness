<?php
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function getConnection() {
   $dbHost = $_ENV['DB_HOST'];
   $dbName = $_ENV['DB_NAME'];
   $dbUser = $_ENV['DB_USER'];
   $dbPass = $_ENV['DB_PASSWORD'];

   $connection = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

   if ($connection->connect_error) {
       die("Connection failed: " . $connection->connect_error);
   }
   return $connection;
}

function getTablesWithJoin($connection) {
    // $stmt = $connection->prepare("SELECT * FROM mdl_block_simplecamera_analysis");
    // if (!$stmt) {
    //     return "Something went wrong";
    // }
    // $stmt->execute();
    // $res = $stmt->get_result()->fetch_assoc();
    // return $res ? $res : -1;

    $stmt = $connection->query("SELECT * FROM mdl_block_simplecamera_analysis LIMIT 10");
    if (!$stmt) {
        return "Something went wrong";
    }
    $res = $stmt;
    return $res ? $res : -1;

}
