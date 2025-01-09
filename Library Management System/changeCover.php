<?php
    session_start();
    include("connect.php");

    $bookId = $_SESSION['book_id'];

    if (isset($_POST['change'])) {
        $new_cover = $_POST['newInput'];
        $sql = "UPDATE books SET cover = '$new_cover' WHERE id = '$bookId'";

        if ($conn -> query($sql) == TRUE) {
            $_SESSION['book_cover'] = $new_cover;
            header("Location: changeBookInfo.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error: No change was made.";
    }
?>