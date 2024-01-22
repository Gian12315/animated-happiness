<?php
require_once(__DIR__ . '../../../config.php');
    
function getSentimentsRecords() {
    global $DB;

    $records = $DB->get_recordset_sql(
        "SELECT {user}.username, {block_simplecamera_analysis}.sentiment, {block_simplecamera_details}.page, {block_simplecamera_details}.timestamp
FROM {block_simplecamera_details}
INNER JOIN {block_simplecamera_analysis} ON {block_simplecamera_analysis}.details = {block_simplecamera_details}.id
INNER JOIN {user} ON {user}.id = {block_simplecamera_details}.user_id");

    return $records;
}

