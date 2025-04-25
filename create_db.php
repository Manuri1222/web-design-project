<?php
// Create or open the SQLite database
$db = new SQLite3('feedback.db');  // This creates feedback.db in the same folder

// Create the feedback table if it doesn't exist
$query = "CREATE TABLE IF NOT EXISTS feedback (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$db->exec($query);

// Check if the table was created successfully
if ($db) {
    echo "Database and table created successfully!";
} else {
    echo "Error creating database or table.";
}

$db->close();
?>
