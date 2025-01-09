<?php
    session_start();
    include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change <?php echo $_SESSION['book_title']; ?> info</title>
    <link rel="stylesheet" href="styleChangeBookInfo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="assets/icons8-book-32.png">
</head>
<body>
    <header>
        <h1><?php echo $_SESSION['book_title']; ?></h1>
    </header>
    <main>
        <aside class="left">
            <img src="<?php echo $_SESSION['book_cover']; ?>" alt="<?php $_SESSION['book_title'] ?> cover">  
            <button type="button" class="change-button" data-change="cover" id="change-cover">Change cover</button>
        </aside>
        <aside class="right">
            <form action="changeInformation.php" method="post" class="change-info">
                <input type="hidden" name="changeData" id="change-data" value="">
                <div id="title">
                    <aside class="information">
                        <h2><strong style="color: #6e54b5;">Title:</strong> <?php echo $_SESSION['book_title']; ?></h2>
                    </aside>
                    <aside class="btn">
                        <button type="button" class="change-button" data-change="title" id="change-title">Change title</button>
                    </aside>
                </div>
                <div id="author">
                    <aside class="information">
                        <h2><strong style="color: #6e54b5;">Author:</strong> <?php echo $_SESSION['book_author']; ?></h2>
                    </aside>
                    <aside class="btn">
                        <button type="button" class="change-button" data-change="author" id="change-author">Change author</button>
                    </aside>
                </div>
                <div id="count">
                    <aside class="information">
                        <h2><strong style="color: #6e54b5;">Count:</strong> <?php echo $_SESSION['book_count']; ?></h2>
                    </aside>
                    <aside class="btn">
                        <button type="button" class="change-button" data-change="count" id="change-count">Change count</button>
                    </aside>
                </div>
            </form>
            <section class="change-summary">
                <div id="summary">
                    <aside class="information">
                        <h2><strong style="color: #6e54b5;">Summary:</strong> <?php echo $_SESSION['book_summary']; ?>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo voluptatum libero est cupiditate magni quibusdam provident reiciendis dolores rem ullam. Ad atque inventore ratione quos voluptatem vitae expedita. Aperiam facere impedit voluptatum numquam autem praesentium excepturi voluptates, minus asperiores sit distinctio accusantium eaque expedita rem consectetur aliquid sapiente iste quidem atque perferendis, veniam laboriosam! Id assumenda reiciendis illum consectetur, alias quasi excepturi, nihil neque nesciunt optio, et quis voluptas sint officia adipisci doloribus. Blanditiis, adipisci. Illo adipisci quo quasi, consequatur, quod sunt placeat a deleniti optio deserunt quidem explicabo in molestiae perferendis accusantium! Quae eius soluta mollitia consequuntur optio illum?</h2>
                    </aside>
                    <aside class="btn">
                        <button type="button" class="change-button" data-change="summary" id="change-summary-btn">Change summary</button>
                    </aside>
                </div>
            </section>
        </aside>
    </main>
    <form class="change-section" action="" method="post">
        <h2 id="change-heading"></h2>
        <textarea name="newInput" id="newInput" required></textarea>
        <input type="submit" name="change" id="change" value="Change">
        <div id="cancel-change">Cancel</div>
    </form>
    <div class="overlay" id="overlay"></div>
    <footer>
        <p>&copy; 2024 LMS. All rights reserved.</p>
    </footer>
    
    <script src="scriptChangeBookInfo.js"></script>
</body>
</html>