n<?php
require_once("vendor/autoload.php");
require_once("connection.php");

function getHTML() {
    $connection = getConnection();
    $output = "";
    $res  = getTablesWithJoin($connection, "");
    if ($res) {
        while($row = $res->fetch_assoc()) {
            // $output = $output . "<tr><td>" . $row['page'] . "</td></tr>";
            $output = "{$output}<tr><td>{$row['username']}</td><td>{$row['sentiment']}</td><td>{$row['page']}</td><td>{$row['timestamp']}</td></tr>";
        }
        $res->free();
    }
    return $output;
}
