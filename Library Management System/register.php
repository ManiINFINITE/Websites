<?php
include 'connect.php';
session_start();

if (isset($_POST["signUpButton"])) {
    $first_name = $_POST["firstName"];
    $last_name = $_POST["lastName"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]); // Hash the password using MD5
    $role = 'user';
    if (isset($_POST["role"])) {
        $role = 'staff';
    }
    
    // Check if email already exists
    $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check_email);

    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Insert new user
        $sql_insert_query = "INSERT INTO users (first_name, last_name, email, password, role)
                             VALUES ('$first_name', '$last_name', '$email', '$password', '$role')";
        if ($conn->query($sql_insert_query) === TRUE) {
            header("Location: index.php"); // Redirect to login page after successful registration
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST["signInButton"])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]); // Hash the input password with MD5

    // Find user by email and password
    $sql_find_user = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql_find_user);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["ID"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["last_name"] = $row["last_name"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["password"] = $row["password"]; // Store hashed password in session
        $_SESSION["role"] = $row["role"];


        header("Location: homepage.php");
        exit();
    } else {
        echo "Incorrect Email or Password";
    }
}

?>
