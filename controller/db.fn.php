<?php
require_once dirname(__DIR__) . 'config.php';

function connect()
{
    global $dbConfig;

    $conn = mysqli_connect($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}
