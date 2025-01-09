document.addEventListener('DOMContentLoaded', function() {
    const profile = document.getElementById("profile");
    const profileInfo = document.getElementById("profile-info");
    const changePasswordPage = document.querySelector(".change-password-page");
    const overlay = document.querySelector(".overlay");
    const changePasswordButton = document.getElementById("change-password");
    const changePasswordConfirm = document.getElementById("confirm");
    const changePasswordCancel = document.getElementById("cancel");
    let profileIsDown = false;

    profile.addEventListener("click", function() {
        profileInfo.style.transform = profileIsDown ? "translateY(-250px)" : "translateY(100px)";
        profileIsDown = !profileIsDown;
    });

    changePasswordButton.addEventListener("click", function() {
        changePasswordPage.style.display = "flex";
        overlay.style.display = "block";
    });

    changePasswordCancel.addEventListener("click", function() {
        changePasswordPage.style.display = "none";
        overlay.style.display = "none";
    }); 

    overlay.addEventListener("click", function() {
        changePasswordPage.style.display = "none";
        overlay.style.display = "none";
    });
});
