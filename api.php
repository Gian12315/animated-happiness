<?php
require_once("connection.php");

function getHTML() {
    $output = "";
    $records  = getTablesWithJoin();

    foreach($records as $record) {
        $output = "{$output}<tr><td>{$record->username}</td><td>{$record->sentiment}</td><td>{$record->page}</td><td>{$record->timestamp}</td></tr>";
    }

    $records->close();
    return $output;
}
