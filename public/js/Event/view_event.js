document.addEventListener("DOMContentLoaded", function () {
    const viewEventModal = document.getElementById("VIEWEvent");
    const viewEventForm = viewEventModal.querySelector("form");
    const viewEventIdElement = viewEventForm.querySelector("#view-event-id");
    const viewEventElement = viewEventForm.querySelector("#view-events");
    const viewEventDescriptionElement = viewEventForm.querySelector("#view-events-description");
    const viewEventScheduledElement = viewEventForm.querySelector("#view-events-scheduled");
    const viewEventUploadedElement = viewEventForm.querySelector("#view-events-uploaded");
    const viewEventPersonnelElement = viewEventForm.querySelector("#view-events-personnel");
    const imageContainer = viewEventForm.querySelector("#imageContainer");
    const viewEventImagesElement = viewEventForm.querySelector("#viewEventImagesElement");
    const assetBaseUrl = viewEventModal.getAttribute("data-asset-url");


    const viewButtons = document.querySelectorAll(".action-user-btn");
    viewButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const userData = JSON.parse(button.getAttribute("data-user"));
            viewEventIdElement.value = userData.id;
            viewEventElement.value = userData.events;
            viewEventDescriptionElement.value = userData.events_description;
            viewEventUploadedElement.value = userData.events_uploaded;
            viewEventScheduledElement.value = userData.events_scheduled;
            viewEventPersonnelElement.value = userData.profile.name;
            viewEventImagesElement.value = JSON.stringify(userData.events_images);
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
            viewEventModal.style.display = 'block';
        });
    });

    // ... (rest of the code)
});
