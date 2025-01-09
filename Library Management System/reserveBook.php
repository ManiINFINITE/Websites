<?php
    session_start();
    include("connect.php");

    if (isset($_POST["book_id"])) {
        $bookId = $_POST["book_id"];
        $userId = $_SESSION["user_id"];

        // Insert into reserved_books
        $reserve_sql = "INSERT INTO reserved_books (book_id, user_id, reserved_date, status) VALUES
        ('$bookId', '$userId', NOW(), 'reserved')";
        $conn -> query($reserve_sql);

        header("Location: borrowedBooks.php");
        exit();
    } else {
        echo "Error reserving book!";
    }
?>