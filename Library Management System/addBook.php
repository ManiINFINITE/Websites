<?php
    session_start();
    include("connect.php");

    $books_per_page = isset($_SESSION['books_per_page']) ? $_SESSION['books_per_page'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $books_per_page;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle adding a new book
        $title = $conn->real_escape_string($_POST['title']);
        $author = $conn->real_escape_string($_POST['author']);
        $cover = $conn->real_escape_string($_POST['cover']);
        $summary = $conn->real_escape_string($_POST['summary']);
        $count = $_POST["count"];

        $sql = "INSERT INTO books (title, author, cover, count, summary) VALUES ('$title', '$author', '$cover', $count, '$summary')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to homepage after successful addition
            header("Location: homepage.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Handle fetching books for pagination
        $sql = "SELECT title, author, cover FROM books LIMIT $books_per_page OFFSET $offset";
        $result = $conn->query($sql);

        $books = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }

        // Get total number of books
        $total_books_sql = "SELECT COUNT(*) as total FROM books";
        $total_books_result = $conn->query($total_books_sql);
        $total_books = $total_books_result->fetch_assoc()['total'];

        $conn->close();

        $response = [
            'books' => $books,
            'total_books' => $total_books,
            'books_per_page' => $books_per_page,
            'current_page' => $page
        ];

        echo json_encode($response);
    }
?>
