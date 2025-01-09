<?php
    session_start();
    include("connect.php");

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT books.id, books.title, books.author, books.cover
            FROM books
            JOIN favorite_books ON books.id = favorite_books.book_id
            WHERE favorite_books.user_id = '$user_id'";
    $result = $conn -> query($sql);

    $favorites = [];
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()) {
            $favorites[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Books</title>
    <link rel="stylesheet" href="styleFavoriteBooks.css">
    <link rel="icon" type="image/x-icon" href="assets/icons8-book-32.png">
</head>
<body>
    <header>
        <h1>Your Favorite Books</h1>
    </header>
    <main>
    <section class="favorite-books-list">
        <?php if (count($favorites) > 0) { ?>
            <?php foreach ($favorites as $book) { ?>
                <div class="book">
                    <a href="bookDetails.php?id=<?php echo $book['id']; ?>" target="_blank">
                        <img src="<?php echo $book['cover']; ?>" alt="<?php echo $book['title']; ?> cover">
                    </a>
                    <section class="info">
                        <h3>
                            <a href="bookDetails.php?id=<?php echo $book['id']; ?>" target="_blank">
                                <?php echo $book['title']; ?>
                            </a>
                        </h3>
                        <p>By <?php echo $book['author']; ?></p>
                    </section>
                    <button onclick="borrowBook(<?php echo $book['id']; ?>)">Borrow</button>
                    <button onclick="removeFromFavorites(<?php echo $book['id']; ?>)">Remove</button>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No favorite books yet!</p>
        <?php } ?>
    </section>
    </main>
    <footer>
        <p>&copy; 2024 LMS. All rights reserved.</p>
    </footer>
    <script>
        function removeFromFavorites(bookId) {
            fetch('removeFromFavorites.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ book_id: bookId }) // Send the book ID as JSON
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert(data.message); // Show error message
                }
            });
        }

        function borrowBook(bookId) {
            fetch('borrowBook.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'book_id=' + bookId // Send the book ID as form data
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = 'borrowedBooks.php'; // Redirect to borrowed books page
                } else {
                    alert('Error borrowing book!'); // Show error message
                }
            });
        }
    </script>
</body>
</html>