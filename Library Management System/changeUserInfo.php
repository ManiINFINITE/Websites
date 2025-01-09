<?php
session_start();
include("connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login if user is not logged in
    exit();
}

$user_id = $_SESSION["user_id"];

if (isset($_POST["confirm"])) {
    $pre_password = $_POST["pre-password"];
    $new_password = $_POST["new-password"];
    $repeat_new_password = $_POST["repeat-new-password"];

    if (empty($pre_password) || empty($new_password) || empty($repeat_new_password)) {
        echo "Please fill out all inputs!";
    } else {
        $hashed_pre_password = md5($pre_password);

        if ($hashed_pre_password != $_SESSION["password"]) {
            echo "Your current password is incorrect!";
        } else {
            if ($new_password != $repeat_new_password) {
                echo "Your new password and repeated password do not match!";
            } else {
                $hashed_new_password = md5($new_password); // Hash the new password

                $sql = "UPDATE users SET password = '$hashed_new_password' WHERE ID = '$user_id'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION["password"] = $hashed_new_password; // Update session variable
                    header("location: userInfo.php");
                    exit();
                } else {
                    echo "Failed to change password: " . $conn->error; // Print SQL error
                }
            }
        }
    }
}
?>
