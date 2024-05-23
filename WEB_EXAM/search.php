<?php
include('connection.php');

if (isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'courses' => "SELECT course_name FROM courses WHERE course_name LIKE '%$searchTerm%'",
        'enrollments' => "SELECT enrollment_date FROM enrollments WHERE enrollment_date LIKE '%$searchTerm%'",
        'instructors' => "SELECT first_name FROM instructors WHERE first_name LIKE '%$searchTerm%'",
        'messages' => "SELECT message_text FROM messages WHERE  message_text LIKE '%$searchTerm%'",
        'modules' => "SELECT module_name FROM modules WHERE module_name LIKE '%$searchTerm%'",
        'payments' => "SELECT payment_method FROM payments WHERE payment_method LIKE '%$searchTerm%'",
        'progress' => "SELECT progresstracking FROM progress WHERE progresstracking LIKE '%$searchTerm%'",
        'reviews' => "SELECT review_text FROM reviews WHERE review_text LIKE '%$searchTerm%'",
        'students' => "SELECT first_name FROM students WHERE first_name LIKE '%$searchTerm%'",
        'tags' => "SELECT tag_name FROM tags WHERE tag_name LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
