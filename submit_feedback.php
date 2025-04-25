<?php
// Turn on error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the name and feedback from the POST request
    $name = $_POST['name'] ?? '';
    $message = $_POST['feedback'] ?? '';

    // Validate input
    if (empty($name) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Name and feedback are required!']);
        exit;
    }

    // Connect to SQLite database
    try {
        $db = new SQLite3('feedback.db');

        // Prepare and execute the insert query
        $stmt = $db->prepare('INSERT INTO feedback (name, message) VALUES (:name, :message)');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':message', $message, SQLITE3_TEXT);
        $stmt->execute();

        // Return success response
        echo json_encode(['success' => true, 'message' => 'Feedback submitted successfully!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error saving feedback: ' . $e->getMessage()]);
    } finally {
        // Close the database connection
        $db->close();
    }
}
?>
