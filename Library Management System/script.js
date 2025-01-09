const goToSignup = document.getElementById("goToSignup");
const goToSignin = document.getElementById("goToSignin");
const signUpForm = document.getElementById("signup");
const signInForm = document.getElementById("signin");


goToSignup.addEventListener("click", function() {
    signInForm.style.display = "none";
    signUpForm.style.display = "flex";
});

goToSignin.addEventListener("click", function() {
    signUpForm.style.display = "none";
    signInForm.style.display = "flex";
});