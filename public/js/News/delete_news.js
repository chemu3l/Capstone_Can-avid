document.addEventListener("DOMContentLoaded", function () {
    const deleteNewsModal = document.getElementById("DELETENews");
    const deleteNewsForm = deleteNewsModal.querySelector("form");
    const deleteNewsIdElement = deleteNewsForm.querySelector("#delete-news-id");

    const deleteButtons = document.querySelectorAll(".action-user-btn");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const userData = JSON.parse(button.getAttribute("data-user"));
            deleteNewsIdElement.value = userData.id;
        });
    });
});





