document.addEventListener("DOMContentLoaded", function () {
    const deleteUserModal = document.getElementById("DELETEUser");
    const deleteserIdElement = deleteUserModal.querySelector("#delete-user-id");
    const deleteFilePathInput = document.querySelector("#delete-file-path");

    const deleteButton = document.querySelectorAll(".action-user-btn");
    deleteButton.forEach((button) => {
        button.addEventListener("click", function () {
            const userData = JSON.parse(button.getAttribute("data-user"));
            deleteserIdElement.value = userData.id;
            deleteFilePathInput.value = userData.images;
        });
    });
});





