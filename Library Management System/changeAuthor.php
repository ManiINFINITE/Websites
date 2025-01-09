<?php
    session_start();
    include("connect.php");

    $bookId = $_SESSION['book_id'];
    
    if (isset($_POST['change'])) {
        $new_author = $_POST['newInput'];

        $update_title_sql = "UPDATE books SET author = '$new_author' WHERE id = '$bookId'";
        
        if ($conn -> query($update_title_sql) == TRUE) {
            $_SESSION['book_author'] = $new_author;
            header("location: changeBookInfo.php");
            exit();
        }
    } else {
        echo "No change was made.";
    }
?>