<?php
    session_start();
    include("connect.php");

    if (isset($_POST["book_id"])) {
        $bookId = $_POST["book_id"];
        $userId = $_SESSION["user_id"];

        $delete_reserve_sql = "DELETE FROM reserved_books WHERE book_id = '$bookId' AND user_id = '$userId' AND status = 'reserved'";
        $conn -> query($delete_reserve_sql);

        header("Location: borrowedBooks.php");
        exit();
    } else {
        echo "Error canceling reservation!";
    }
?>