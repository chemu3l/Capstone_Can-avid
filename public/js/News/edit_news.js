document.addEventListener("DOMContentLoaded", function () {
    const editNewsModal = document.getElementById("EDITNews");
    const editNewsForm = editNewsModal.querySelector("form");
    const editNewsIdElement = editNewsForm.querySelector("#edit-news-id");
    const editNewsElement = editNewsForm.querySelector("#edit-news");
    const editNewsDescriptionElement = editNewsForm.querySelector("#edit-news-description");
    const editNewsScheduledElement = editNewsForm.querySelector("#edit-news-update");
    const imageContainer = editNewsForm.querySelector("#imageContainer");
    const editNewsImagesElement = editNewsForm.querySelector("#editNewsImagesElement");
    const assetBaseUrl = editNewsModal.getAttribute("data-asset-url");


    const editButtons = document.querySelectorAll(".action-user-btn");
    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const userData = JSON.parse(button.getAttribute("data-user"));
            editNewsIdElement.value = userData.id;
            editNewsElement.value = userData.news;
            editNewsDescriptionElement.value = userData.news_description;
            editNewsScheduledElement.value = userData.news_updated;
            editNewsImagesElement.value = JSON.stringify(userData.news_images);
            userData.news_images = JSON.parse(userData.news_images);
            // Clear previous media elements from imageContainer
            imageContainer.innerHTML = '';
            // Display images and videos in the imageContainer
            userData.news_images.forEach(function (imageUrl) {
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
            editNewsModal.style.display = 'block';
        });
    });

    // ... (rest of the code)
});
