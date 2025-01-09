<?php
    session_start();
    include("connect.php");

    $bookId = $_SESSION['book_id'];
    
    if (isset($_POST['change'])) {
        $new_count = $_POST['newInput'];

        $update_title_sql = "UPDATE books SET count = '$new_count' WHERE id = '$bookId'";
        
        if ($conn -> query($update_title_sql) == TRUE) {
            $_SESSION['book_count'] = $new_count;
            header("location: changeBookInfo.php");
            exit();
        }
    } else {
        echo "No change was made.";
    }
?>