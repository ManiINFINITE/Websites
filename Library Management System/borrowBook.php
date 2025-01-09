<?php
    session_start();
    include("connect.php");

    if (isset($_POST["book_id"])) {
        $bookId = $_POST["book_id"];
        $userId = $_SESSION["user_id"];

        // Update book count
        $update_sql = "UPDATE books SET count = count - 1 WHERE id = '$bookId'";
        $conn -> query($update_sql);

        // Insert book into borrowed_books
        $borrow_sql = "INSERT INTO borrowed_books (book_id, user_id, borrowed_date, return_date) VALUES
        ('$bookId', '$userId', NOW(), NULL)";
        $conn -> query($borrow_sql);

        header("Location: borrowedBooks.php");
        exit();
    } else {
        echo "Error borrowing book!";
    }
?>