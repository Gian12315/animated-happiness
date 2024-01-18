<?php
require_once("vendor/autoload.php");
require_once("connection.php");

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") {
    $conn = getConnection();
    $res = getTablesWithJoin($conn, $_POST['search']);
    $output = "";
    if ($res) {
        while($row = $res->fetch_assoc()) {
            // $output = $output . "<tr><td>" . $row['page'] . "</td></tr>";
            echo "<tr><td>{$row['username']}</td><td>{$row['sentiment']}</td><td>{$row['page']}</td><td>{$row['timestamp']}</td></tr>";
        }
        $res->free();
    }
}

if ($method == "GET") {
echo "HELLO";
}
