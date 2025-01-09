<?php
    session_start();
    include("connect.php");

    if (isset($_POST["book_id"])) {
        $bookId = $_POST["book_id"];
        $userId = $_SESSION["user_id"];

        $update_borrow_sql = "UPDATE borrowed_books SET return_date = NOW() WHERE book_id = '$bookId' AND user_id = '$userId' AND return_date IS NULL";
        $conn -> query($update_borrow_sql);

        $update_book_sql = "UPDATE books SET count = count + 1 WHERE id = '$bookId'";
        $conn -> query($update_book_sql);

        $check_reservation_sql = "SELECT user_id FROM reserved_books
        WHERE book_id = '$bookId' ORDER BY reserved_date ASC LIMIT 1";
        $reservation_result = $conn -> query($check_reservation_sql);

        if ($reservation_result -> num_rows > 0) {
            $reservation = $reservation_result -> fetch_assoc();
            $reservationId = $reservation['user_id'];

            $borrow_sql = "INSERT INTO borrowed_books (book_id, user_id, borrowed_date, return_date)
            VALUES ('$bookId', '$userId', NOW(), NULL)";
            $conn -> query($borrow_sql);

            $delete_reservation_sql = "DELETE FROM reserved_books WHERE book_id = '$bookId' AND user_id = '$reservationId'";
            $conn -> query($delete_reservation_sql);
        }
        header("Location: borrowedBooks.php");
        exit();

    } else {
        echo "Error returning book!";
    }
?>