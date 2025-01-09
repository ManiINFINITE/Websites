const form = document.querySelector(".change-section");
const overlay = document.getElementById("overlay");
const changeHeading = document.getElementById("change-heading");
const newInput = document.getElementById("newInput");
const cancelChangeButton = document.getElementById("cancel-change");
const hiddenInput = document.getElementById("change-data");

const changeButtons = document.querySelectorAll(".change-button");


changeButtons.forEach(button => {
    button.addEventListener("click", function() {
        const changeType = this.getAttribute("data-change");
        form.style.display = "flex";
        overlay.style.display = "block";

        hiddenInput.value = changeType;

        switch (changeType) {
            case "title":
                changeHeading.textContent = "Change Title";
                form.setAttribute("action", "changeTitle.php");
                break;
            case "author":
                changeHeading.textContent = "Change Author";
                form.setAttribute("action", "changeAuthor.php");
                break;
            case "count":
                changeHeading.textContent = "Change Count";
                form.setAttribute("action", "changeCount.php");
                break;
            case "summary":
                changeHeading.textContent = "Change Summary";
                form.setAttribute("action", "changeSummary.php");
                break;
            case "cover":
                changeHeading.textContent = "Change Cover";
                form.setAttribute("action", "changeCover.php");
                break;
        }
        
    });
});

overlay.addEventListener("click", function() {
    form.style.display = "none";
    overlay.style.display = "none";
});

cancelChangeButton.addEventListener("click", function() {
    form.style.display = "none";
    overlay.style.display = "none";
});