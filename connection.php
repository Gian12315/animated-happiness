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

function getTablesWithJoin($connection, $search) {
    // $stmt = $connection->prepare("SELECT * FROM mdl_block_simplecamera_analysis");
    // if (!$stmt) {
    //     return "Something went wrong";
    // }
    // $stmt->execute();
    // $res = $stmt->get_result()->fetch_assoc();
    // return $res ? $res : -1;

    $stmt = $connection->prepare(
        "SELECT mdl_user.username, mdl_block_simplecamera_analysis.sentiment, mdl_block_simplecamera_details.page, mdl_block_simplecamera_details.timestamp
FROM mdl_block_simplecamera_details
INNER JOIN mdl_block_simplecamera_analysis ON mdl_block_simplecamera_analysis.details = mdl_block_simplecamera_details.id
INNER JOIN mdl_user ON mdl_user.id = mdl_block_simplecamera_details.user_id WHERE mdl_user.username LIKE ? LIMIT 10");
    if (!$stmt) {
        return "Something went wrong";
    }
    $param = "%" . $search . "%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res;

}
