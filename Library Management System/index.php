<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="styleSignInUp.css">
    <link rel="icon" type="image/x-icon" href="assets/icons8-book-32.png">
</head>
<body>
    <!-- SIGN UP FORM -->
    <div class="container" id="signup" style="display: none;">
        <aside class="left">
            <img src="assets/landscape-purple-5120x2880-19680.jpg" alt="image">
        </aside>
        <form action="register.php" method="post" class="right">
            <h1 class="signup-title">Create an account</h1>
            <p class="have-account">
                Already have an account?&nbsp;
                <button id="goToSignin">Log in</button>
            </p>
            <div class="input-group">
                <input type="text" name="firstName" id="firstName" placeholder="First name" required autocomplete="off">
                <input type="text" name="lastName" id="lastName" placeholder="Last name" required autocomplete="off">
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required autocomplete="off">
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required autocomplete="off">
                <div class="hideShow"><i class="fas fa-eye"></i></div>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="chkbx" id="chkbx">&nbsp;&nbsp;&nbsp;
                I agree to the &nbsp;<a href="#">Terms & Conditions</a>
            </div>
            <div class="checkbox1">
                <input type="checkbox" name="role" id="role">&nbsp;&nbsp;&nbsp;
                I am a staff
            </div>
            <div class="input-group">
                <input type="submit" name="signUpButton" id="signUpButton" value="Create account">
            </div>
            <p class="or">
                <sup>__________________&nbsp;</sup> Or register with <sup>&nbsp;__________________</sup>
            </p>
            <div class="icons">
                <i class="fab fa-google"></i>&nbsp;
                Google
            </div>
            <div class="icons">
                <i class="fab fa-apple"></i>&nbsp;
                Apple
            </div>
        </form>
    </div>
    <!-- SIGN IN FORM -->
    <div class="container" id="signin">
        <aside class="left">
            <img src="assets/landscape-purple-5120x2880-19680.jpg" alt="image">
        </aside>
        <form action="register.php" method="post" class="right">
            <h1 class="signup-title">Sign in</h1>
            <p class="have-account">
                Don't have an account yet?&nbsp;
                <button id="goToSignup">Register now</button>
            </p>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required autocomplete="off">
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required autocomplete="off">
                <div class="hideShow"><i class="fas fa-eye"></i></div>
            </div>
            <div class="input-group">
                <input type="submit" name="signInButton" id="signInButton" value="Sign in">
            </div>
            <p class="or">
                <sup>__________________&nbsp;</sup> Or sign in with <sup>&nbsp;__________________</sup>
            </p>
            <div class="icons">
                <i class="fab fa-google"></i>&nbsp;
                Google
            </div>
            <div class="icons">
                <i class="fab fa-apple"></i>&nbsp;
                Apple
            </div>
        </form>
    </div>


    <script src="script.js"></script>
</body>
</html>
