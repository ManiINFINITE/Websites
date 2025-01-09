<?php
session_start();
include("connect.php");

$response  = [];

// Read the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($_SESSION["user_id"]) && isset($data["book_id"])) {
    $user_id = $_SESSION["user_id"];
    $book_id = $data["book_id"];

    $delete_sql = "DELETE FROM favorite_books WHERE user_id = '$user_id' AND book_id = '$book_id'";
    if ($conn->query($delete_sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Book removed from favorites';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error removing book from favorites';
    }
} else if (!isset($_SESSION['user_id'])) {
    $response['status'] = 'error';
    $response['message'] = 'User  not logged in';
} else if (!isset($data['book_id'])) {
    $response['status'] = 'error';
    $response['message'] = 'book ID missing';
}

header('Content-Type: application/json');
echo json_encode($response);
?>