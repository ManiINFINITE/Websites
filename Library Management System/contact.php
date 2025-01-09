<?php
    session_start();
    include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styleContact.css"> 
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
                <li><a href="logout.php" style="color: red; text-shadow: 0 0 10px black">Log Out</a></li>
            </ul>
        </div>
        <h1>Contact Us</h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="sendMessage.php" method="post">
            <label for="email">Your Email:</label>
            <input type="email" name="email" required>
            
            <label for="subject">Subject:</label>
            <input type="text" name="subject" required>

            <label for="app-password">App-specific password:</label>
            <input type="password" name="app-password" required>
            
            <label for="message">Message:</label>
            <textarea name="message" required></textarea>
            
            <input type="submit" value="Send Message">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 LMS. All rights reserved.</p>
    </footer>
    <script src="scriptContact.js"></script>
</body>
</html>
