<?php
session_start();
include("connect.php");

$response = [];

// Read the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($_SESSION["user_id"]) && isset($data["book_id"])) {
    $user_id = $_SESSION["user_id"];
    $book_id = $data["book_id"];

    // Debugging output
    error_log("User  ID: $user_id, Book ID: $book_id");

    // Check if the book is already in the user's favorites
    $check_sql = "SELECT * FROM favorite_books WHERE user_id = '$user_id' AND book_id = '$book_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Book is already in your favorites';
    } else {
        // Insert the book into the user's favorites
        $insert_sql = "INSERT INTO favorite_books (user_id, book_id) VALUES ('$user_id', '$book_id')";
        if ($conn->query($insert_sql) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'Book added to favorites';
        } else {
            // Debugging output
            error_log("Error: " . $conn->error);
            $response['status'] = 'error';
            $response['message'] = 'Error adding book to favorites';
        }
    }
} else if (!isset($_SESSION['user_id'])) {
    $response['status'] = 'error';
    $response['message'] = 'User  not logged in';
} else if (!isset($data['book_id'])) {
    $response['status'] = 'error';
    $response['message'] = 'book ID missing';
}

// Debugging output
error_log("Response: " . json_encode($response));

header('Content-Type: application/json');
echo json_encode($response);
?>