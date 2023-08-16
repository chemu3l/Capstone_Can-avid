document.addEventListener("DOMContentLoaded", function () {
    const editEventModal = document.getElementById("EDITEvent");
    const editEventForm = editEventModal.querySelector("form");
    const editEventIdElement = editEventForm.querySelector("#edit-event-id");
    const editEventElement = editEventForm.querySelector("#edit-events");
    const editEventDescriptionElement = editEventForm.querySelector("#edit-events-description");
    const editEventScheduledElement = editEventForm.querySelector("#edit-events-scheduled");
    const imageContainer = editEventForm.querySelector("#imageContainer");
    const editEventImagesElement = editEventForm.querySelector("#editEventImagesElement");
    const assetBaseUrl = editEventModal.getAttribute("data-asset-url");


    const editButtons = document.querySelectorAll(".action-user-btn");
    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const userData = JSON.parse(button.getAttribute("data-user"));
            editEventIdElement.value = userData.id;
            editEventElement.value = userData.events;
            editEventDescriptionElement.value = userData.events_description;
            editEventScheduledElement.value = userData.events_scheduled;
            editEventImagesElement.value = JSON.stringify(userData.events_images);
            userData.events_images = JSON.parse(userData.events_images);
            // Clear previous media elements from imageContainer
            imageContainer.innerHTML = '';
            // Display images and videos in the imageContainer
            userData.events_images.forEach(function (imageUrl) {
                    const mediaElement = imageUrl.endsWith('.mp4') || imageUrl.endsWith('.avi') || imageUrl.endsWith('.mov')
                        ? document.createElement('video')
                        : document.createElement('img');

                    mediaElement.src = assetBaseUrl + '/' + imageUrl;
                    mediaElement.alt = imageUrl.endsWith('.mp4') || imageUrl.endsWith('.avi') || imageUrl.endsWith('.mov')
                        ? 'Video'
                        : 'Image';

                    if (mediaElement.tagName === 'VIDEO') {
                        mediaElement.controls = true;
                        const source = document.createElement('source');
                        source.src = assetBaseUrl + '/' + imageUrl;
                        source.type = 'video/mp4';
                        mediaElement.appendChild(source);
                    }

                    mediaElement.style.height = '100px';
                    mediaElement.style.width = '100px';
                    mediaElement.style.borderRadius = '50%';

                    imageContainer.appendChild(mediaElement);
            });



            // Display the modal
            editEventModal.style.display = 'block';
        });
    });

    // ... (rest of the code)
});
