document.addEventListener("DOMContentLoaded", function () {
    const viewNewsModal = document.getElementById("VIEWNews");
    const viewNewsForm = viewNewsModal.querySelector("form");
    const viewNewsIdElement = viewNewsForm.querySelector("#view-news-id");
    const viewNewsElement = viewNewsForm.querySelector("#view-news");
    const viewNewsDescriptionElement = viewNewsForm.querySelector("#view-news-description");
    const viewNewsScheduledElement = viewNewsForm.querySelector("#view-news-scheduled");
    const viewNewsUploadedElement = viewNewsForm.querySelector("#view-news-uploaded");
    const viewNewsPersonnelElement = viewNewsForm.querySelector("#view-news-personnel");
    const imageContainer = viewNewsForm.querySelector("#imageContainer");
    const viewNewsImagesElement = viewNewsForm.querySelector("#viewNewsImagesElement");
    const assetBaseUrl = viewNewsModal.getAttribute("data-asset-url");


    const viewButtons = document.querySelectorAll(".action-user-btn");
    viewButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const userData = JSON.parse(button.getAttribute("data-user"));
            viewNewsIdElement.value = userData.id;
            viewNewsElement.value = userData.news;
            viewNewsDescriptionElement.value = userData.news_description;
            viewNewsUploadedElement.value = userData.news_updated;
            viewNewsScheduledElement.value = userData.news_uploaded;
            viewNewsPersonnelElement.value = userData.profile.name;
            viewNewsImagesElement.value = JSON.stringify(userData.news_images);
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
            viewNewsModal.style.display = 'block';
        });
    });

    // ... (rest of the code)
});
