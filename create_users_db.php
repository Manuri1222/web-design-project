<?php
require 'db_connect.php';

$query = "
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
);
";

$db->exec($query);
echo "User database created successfully.";
?>
