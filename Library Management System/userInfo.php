<?php
    session_start();
    include("connect.php");

    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link rel="stylesheet" href="styleUserInfo.css">
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
        <h1>Library Books Showcase</h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="information">
            <div class="group">
                <label>First Name</label>
                <div class="info" id="fName">
                    <p><?php echo $first_name; ?></p>
                </div>
            </div>
            <div class="group">
                <label>Last Name</label>
                <div class="info" id="lName">
                    <p><?php echo $last_name; ?></p>
                </div>
            </div>
            <div class="group">
                <label>Email</label>
                <div class="info" id="email">
                    <p><?php echo $email; ?></p>
                </div>
            </div>
            <button class="change-password" id="change-password">Change Password</button>
        </section>
    </main>
    <form class="change-password-page" action="changeUserInfo.php" method="post">
        <h3>Change Password</h3>
        <input type="password" name="pre-password" id="pre-password" placeholder="Current password" required>
        <input type="password" name="new-password" id="new-password" placeholder="New password" required>
        <input type="password" name="repeat-new-password" id="repeat-new-password" placeholder="Repeat new password" required>
        <input type="submit" name="confirm" id="confirm" value="Confirm">
        <input type="submit" name="cancel" id="cancel" value="Cancel">
    </form>
    <div class="overlay"></div>
    <footer>
        <p>&copy; 2024 LMS. All rights reserved.</p>
    </footer>
    <script src="scriptUserInfo.js"></script>
</body>
</html>
