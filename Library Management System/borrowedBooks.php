<?php
    session_start();
    include("connect.php");

    $userId = $_SESSION["user_id"]; // Assuming the user is logged in and their user_id is stored in session

    // Fetch borrowed books
    $borrowedBooksSql = "
        SELECT books.id, books.title, books.author, books.cover, borrowed_books.borrowed_date, borrowed_books.return_date 
        FROM borrowed_books 
        JOIN books ON borrowed_books.book_id = books.id 
        WHERE borrowed_books.user_id = '$userId'
    ";
    $borrowedBooksResult = $conn->query($borrowedBooksSql);

    // Fetch reserved books
    $reservedBooksSql = "
        SELECT books.id, books.title, books.author, books.cover, reserved_books.reserved_date, reserved_books.status 
        FROM reserved_books 
        JOIN books ON reserved_books.book_id = books.id 
        WHERE reserved_books.user_id = '$userId'
    ";
    $reservedBooksResult = $conn->query($reservedBooksSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Borrowed and Reserved Books</title>
    <link rel="stylesheet" href="styleBorrowedBooks.css">
    <link rel="icon" type="image/x-icon" href="assets/icons8-book-32.png">
</head>
<body>
    <header>
        <h1>My Borrowed and Reserved Books</h1>
    </header>
    <main>
        <section class="borrowed-books">
            <h2>Borrowed Books</h2>
            <ul>
                <?php while($book = $borrowedBooksResult->fetch_assoc()) { ?>
                    <li>
                        <aside class="image">
                            <img src="<?php echo $book['cover']; ?>" alt="<?php echo $book['title']; ?> cover">
                        </aside>
                        <aside class="info">
                            <h3><?php echo $book['title']; ?></h3>
                            <p>Author: <?php echo $book['author']; ?></p>
                            <p>Borrowed Date: <?php echo $book['borrowed_date']; ?></p>
                            <p>Return Date: <?php echo $book['return_date'] ? $book['return_date'] : 'Not Returned'; ?></p>
                        </aside>
                        <aside class="btn">
                            <?php if ($book['return_date'] == null) { ?>
                                <form action="returnBook.php" method="POST">
                                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                    <button type="submit" name="return-book">Return Book</button>
                                </form>
                            <?php } else { ?>
                                <div class="returned">Returned</div>
                            <?php } ?>
                        </aside>
                    </li>
                <?php } ?>
            </ul>
        </section>
        
        <section class="reserved-books">
            <h2>Reserved Books</h2>
            <ul>
                <?php while($book = $reservedBooksResult->fetch_assoc()) { ?>
                    <li>
                        <aside class="image">
                            <img src="<?php echo $book['cover']; ?>" alt="<?php echo $book['title']; ?> cover">
                        </aside>
                        <aside class="info">
                            <h3><?php echo $book['title']; ?></h3>
                            <p>Author: <?php echo $book['author']; ?></p>
                            <p>Reserved Date: <?php echo $book['reserved_date']; ?></p>
                            <p>Status: <?php echo $book['status']; ?></p>
                        </aside>
                        <aside class="btn">
                            <form action="cancelReservation.php" method="POST">
                                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                <button type="submit" name="cancel-reserve">Cancel Reservation</button>
                            </form>
                        </aside>
                    </li>
                <?php } ?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Library. All rights reserved.</p>
    </footer>
</body>
</html>
