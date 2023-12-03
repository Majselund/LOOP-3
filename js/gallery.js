const images = [
    '../../images/gallery/IMG_0002.avif',
    '../../images/gallery/IMG_0006.avif',
    '../../images/gallery/IMG_0023.avif',
    '../../images/gallery/IMG_0026.avif',
    '../../images/gallery/IMG_0028.avif',
    '../../images/gallery/IMG_9656.avif',
    '../../images/gallery/IMG_9657.avif',
    '../../images/gallery/IMG_9658.avif',
    '../../images/gallery/IMG_9669.avif',
    '../../images/gallery/IMG_9674.avif',
    '../../images/gallery/IMG_9675.avif',
    '../../images/gallery/IMG_9685.avif',
    '../../images/gallery/IMG_9688.avif',
    '../../images/gallery/IMG_9693.avif',
    '../../images/gallery/IMG_9695.avif',
    '../../images/gallery/IMG_9696.avif',
    '../../images/gallery/IMG_9700.avif',
    '../../images/gallery/IMG_9702.avif',
    '../../images/gallery/IMG_9703.avif',
    '../../images/gallery/IMG_9705.avif',
    '../../images/gallery/IMG_9707.avif',
    '../../images/gallery/IMG_9709.avif',
    '../../images/gallery/IMG_9717.avif',
    '../../images/gallery/IMG_9724.avif',
    '../../images/gallery/IMG_9727.avif',
    '../../images/gallery/IMG_9736.avif',
    '../../images/gallery/IMG_9739.avif',
    '../../images/gallery/IMG_9747.avif',
    '../../images/gallery/IMG_9749.avif',
    '../../images/gallery/IMG_9780.avif',
    '../../images/gallery/IMG_9790.avif',
    '../../images/gallery/IMG_9792.avif',
    '../../images/gallery/IMG_9794.avif',
    '../../images/gallery/IMG_9807.avif',
    '../../images/gallery/IMG_9809.avif',
    '../../images/gallery/IMG_9813.avif',
    '../../images/gallery/IMG_9826.avif',
    '../../images/gallery/IMG_9835.avif',
    '../../images/gallery/IMG_9839.avif',
    '../../images/gallery/IMG_9862.avif',
    '../../images/gallery/IMG_9867.avif',
    '../../images/gallery/IMG_9870.avif',
    '../../images/gallery/IMG_9872.avif',
    '../../images/gallery/IMG_9883.avif',
    '../../images/gallery/IMG_9886.avif',
    '../../images/gallery/IMG_9893.avif',
    '../../images/gallery/IMG_9902.avif',
    '../../images/gallery/IMG_9905.avif',
    '../../images/gallery/IMG_9907.avif',
    '../../images/gallery/IMG_9911.avif',
    '../../images/gallery/IMG_9913.avif',
    '../../images/gallery/IMG_9918.avif',
    '../../images/gallery/IMG_9948.avif',
    '../../images/gallery/IMG_9951.avif',
    '../../images/gallery/IMG_9955.avif',
    '../../images/gallery/IMG_9957.avif',
    '../../images/gallery/IMG_9962.avif',
    '../../images/gallery/IMG_9964.avif',
    '../../images/gallery/IMG_9966.avif',
    '../../images/gallery/IMG_9968.avif',
    '../../images/IMG_9984.png',
    '../../images/IMG_9986.png',
    '../../images/IMG_9991.png'
]

const masonry = document.getElementById('masonry');
const imagesPerPage = 12;
let currentPage = 0;

function loadImages(startIndex, endIndex) {
    for (let i = startIndex; i < endIndex; i++) {
        const figure = document.createElement('figure');
        masonry.appendChild(figure);

        const button = document.createElement('button');
        button.id = `imageButton${i}`;
        figure.appendChild(button);

        const img = document.createElement('img');
        img.src = images[i];
        img.alt = "Open";
        img.width = 570;
        button.appendChild(img);

        const imageModal = document.createElement('div');
        imageModal.id = `imageModal${i}`;
        imageModal.className = "modal";
        masonry.appendChild(imageModal);

        const modalContent = document.createElement('div');
        modalContent.className = "modal-content";
        imageModal.appendChild(modalContent);

        const bigImage = document.createElement('img');
        bigImage.className = "modal-image";
        bigImage.src = images[i];
        modalContent.appendChild(bigImage);

        button.onclick = function showModal() {
            imageModal.style.display = "block";
        };

        window.addEventListener("click", function (event) {
            if (event.target == imageModal || event.target == modalContent || event.target == bigImage) {
                imageModal.style.display = "none";
            }
        });
    }
}

loadImages(0, imagesPerPage);

const loadMoreButton = document.getElementById('loadMoreButton');

loadMoreButton.addEventListener('click', function () {
    currentPage++;
    const startIndex = currentPage * imagesPerPage;
    const endIndex = startIndex + imagesPerPage;

    if (startIndex < images.length) {
        loadImages(startIndex, endIndex);
    } else {
        loadMoreButton.disabled = true;
    }
});
