<?php
    session_start();
    include("connect.php");

    if (!isset($_SESSION["books_per_page"])) {
        $_SESSION['books_per_page'] = 15;
    }

    $books_per_page = $_SESSION['books_per_page'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $books_per_page;

    $search_term = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

    // Fetch books from database
    if ($search_term) {
        $sql = "SELECT * FROM books WHERE title LIKE '%$search_term%' OR author LIKE '%$search_term%' LIMIT $books_per_page OFFSET $offset";
    } else {
        $sql = "SELECT * FROM books LIMIT $books_per_page OFFSET $offset";
    }

    $result = $conn->query($sql);

    $books = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    }

    // Fetch total number of books for pagination
    if ($search_term) {
        $sql_count = "SELECT COUNT(*) as total FROM books WHERE title LIKE '%$search_term%' OR author LIKE '%$search_term%'";
    } else {
        $sql_count = "SELECT COUNT(*) as total FROM books";
    }

    $count_result = $conn->query($sql_count);
    $total_books = $count_result->fetch_assoc()['total'];

    $response = array(
        'books' => $books,
        'total_books' => $total_books,
        'books_per_page' => $books_per_page,
        'current_page' => $page
    );

    if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
        echo json_encode($response);
        exit();
    }

    $userRole = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Home</title>
    <link rel="stylesheet" href="styleHomepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/icons8-book-32.png">
</head>
<body>
    <header>
        <div class="profile" id="profile">
            <i class="fas fa-user"></i>
            <h3>Profile</h3>
        </div>
        <div class="profile-info" id="profile-info">
            <ul>
                <li><a href="userInfo.php">Info</a></li>
                <li><a href="borrowedBooks.php">History</a></li>
                <li><a href="favoriteBooks.php">Favorites</a></li>
                <li><a href="logout.php" style="color: red; text-shadow: 0 0 10px black">Log Out</a></li>
            </ul>
        </div>
        <h1>Library Books Showcase</h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="search-container">
            <form id="search-form">
                <input type="text" name="search" id="search" placeholder="Search by name or author" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" autocomplete="off">
                <input type="submit" id="submit-search" value="Search">
            </form>
        </div>
    </header>
    <main>
        <section class="book-list">
            <?php
            foreach ($books as $book) {
                echo '
                    <div class="book">
                        <a href="bookDetails.php?id=' . $book['id'] . '">
                            <img src="' . $book['cover'] . '" alt="' . $book['title'] . ' cover">
                            <h3>' . $book['title'] . '</h3>
                            <p>' . $book['author'] . '</p>
                            <button onclick="addToFavorites(' . $book['id'] . ')">
                                <i class="fas fa-heart"></i>
                            </button>
                        </a>
                    </div>
                ';
            }
            ?>
        </section>

        <section class="pagination">
            <!-- Pagination buttons will be displayed here -->
        </section>

        <section class="add-book" id="addBookSection" data-user-role="<?php echo $userRole; ?>">
            <h2>Add a New Book</h2>
            <form action="addBook.php" method="POST" id="add-book-form">
                <input type="text" name="title" placeholder="Book Title" required>
                <input type="text" name="author" placeholder="Author" required>
                <input type="text" name="cover" placeholder="Cover Image URL" required>
                <textarea name="summary" id="summary" placeholder="Summary" required></textarea>
                <input type="number" name="count" placeholder="Count" required>
                <button type="submit">Add Book</button>
                <button type="button" id="closeAddBookButton">Cancel</button>
            </form>
        </section>
        <button id="addNewBookButton" style="display: none;">Add new book</button>
        <div class="overlay" id="overlay"></div>
    </main>
    <footer>
        <p>&copy; 2024 LMS. All rights reserved.</p>
    </footer>
    <script src="scriptHomepage.js"></script> <!-- Ensure this script is properly linked -->
</body>
</html>
