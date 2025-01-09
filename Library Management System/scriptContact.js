const profile = document.getElementById("profile");
const profileInfo = document.getElementById("profile-info");
let profileIsDown = false;

profile.addEventListener("click", function() {
    profileInfo.style.transform = profileIsDown ? "translateY(-250px)" : "translateY(100px)";
    profileIsDown = !profileIsDown;
});