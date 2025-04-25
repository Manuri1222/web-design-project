<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Connect to the SQLite database
try {
    $db = new SQLite3('feedback.db');

    // Query to fetch all feedback
    $result = $db->query('SELECT name, message, created_at FROM feedback ORDER BY created_at DESC');

    // Fetch all rows into an array
    $feedbacks = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $feedbacks[] = $row;
    }

    // Return feedback as JSON
    echo json_encode($feedbacks);
} catch (Exception $e) {
    // Handle errors
    echo json_encode(['error' => 'Error fetching feedback: ' . $e->getMessage()]);
} finally {
    // Close the database connection
    $db->close();
}
?>
