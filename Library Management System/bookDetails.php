<?php
    session_start();
    include("connect.php");

    if (isset($_GET['id'])) {
        $bookId = $conn->real_escape_string($_GET['id']);

        $sql = "SELECT * FROM books WHERE id = '$bookId'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $book = $result->fetch_assoc();

            $_SESSION['book_id'] = $bookId;
            $_SESSION['book_title'] = $book['title'];
            $_SESSION['book_author'] = $book['author'];
            $_SESSION['book_cover'] = $book['cover'];
            $_SESSION['book_summary'] = $book['summary'];
            $_SESSION['book_count'] = $book['count'];

        } else {
            echo "Book not found!";
            exit();
        }
    } else {
        echo "No book ID provided!";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $book['title']; ?></title>
    <link rel="stylesheet" href="styleBookDetails.css">
    <link rel="icon" type="image/x-icon" href="assets/icons8-book-32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <header>
        <h1><?php echo $book['title']; ?></h1>
    </header>
    <main>
        <aside class="left">
            <img src="<?php echo $book['cover']; ?>" alt="<?php echo $book['title']; ?>">
        </aside>
        <aside class="right">
            <section class="book-info">
                <h2><?php echo $book['title']; ?></h2>
                <h3><?php echo "By <strong>{$book['author']}</strong>" ?></h3>
                <h4><?php echo "Available: " . $book['count']; ?></h4>
            </section>
            <section class="book-description">
                <label>Description: </label>
                <p><?php echo $book['summary']; ?></p>
            </section>
            <section class="borrow-reserve">
                <?php if ($book['count'] > 0) { ?>
                    <form action="borrowBook.php" method="post">
                        <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                        <button type="submit">Borrow Book</button>
                    </form>
                <?php } else { ?>
                    <form action="reserveBook.php" method="post">
                        <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                        <button type="submit">Reserve Book</button>
                    </form>
                    <p style="color: red;">This book is currently unavailable. Click below to reserve it and be notified when it becomes available!</p>
                <?php } ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'staff') { ?>
                    <button id="go-to-change-book-info">
                        <a href="changeBookInfo.php">Change book info</a>
                    </button>
                <?php } ?>
            </section>
        </aside>
    </main>
    <footer>
        <p>&copy; 2024 LMS. All rights reserved.</p>
    </footer>
    <script src="scriptBookDetails.js"></script>
</body>
</html>
