document.addEventListener("DOMContentLoaded", function () {
    const deleteEventModal = document.getElementById("DELETEEvent");
    const deleteEventForm = deleteEventModal.querySelector("form");
    const deleteEventIdElement = deleteEventForm.querySelector("#delete-event-id");

    const deleteButtons = document.querySelectorAll(".action-user-btn");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const userData = JSON.parse(button.getAttribute("data-user"));
            deleteEventIdElement.value = userData.id;
        });
    });
});





