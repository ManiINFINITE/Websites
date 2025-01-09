<?php
    session_start();
    include("connect.php");

    $bookId = $_SESSION['book_id'];
    
    if (isset($_POST['change'])) {
        $new_summary = $_POST['newInput'];

        $update_title_sql = "UPDATE books SET summary = '$new_summary' WHERE id = '$bookId'";
        
        if ($conn -> query($update_title_sql) == TRUE) {
            $_SESSION['book_summary'] = $new_summary;
            header("location: changeBookInfo.php");
            exit();
        }
    } else {
        echo "No change was made.";
    }
?>