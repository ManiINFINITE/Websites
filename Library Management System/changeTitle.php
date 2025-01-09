<?php
    session_start();
    include("connect.php");

    $bookId = $_SESSION['book_id'];
    
    if (isset($_POST['change'])) {
        $new_title = $_POST['newInput'];

        $update_title_sql = "UPDATE books SET title = '$new_title' WHERE id = '$bookId'";
        
        if ($conn -> query($update_title_sql) == TRUE) {
            $_SESSION['book_title'] = $new_title;
            header("location: changeBookInfo.php");
            exit();
        }
    } else {
        echo "No change was made.";
    }
?>