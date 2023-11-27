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
    '../../images/IMG_9790.png', 
    '../../images/IMG_9792.png', 
    '../../images/IMG_9794.png', 
    '../../images/IMG_9807.png', 
    '../../images/IMG_9809.png', 
    '../../images/IMG_9813.png', 
    '../../images/IMG_9826.png', 
    '../../images/IMG_9835.png', 
    '../../images/IMG_9839.png', 
    '../../images/IMG_9862.png', 
    '../../images/IMG_9867.png', 
    '../../images/IMG_9870.png',
    '../../images/IMG_9872.png',
    '../../images/IMG_9883.png',
    '../../images/IMG_9886.png',
    '../../images/IMG_9893.png',
    '../../images/IMG_9902.png',
    '../../images/IMG_9905.png',
    '../../images/IMG_9907.png',
    '../../images/IMG_9911.png',
    '../../images/IMG_9913.png',
    '../../images/IMG_9918.png',
    '../../images/IMG_9948.png',
    '../../images/IMG_9951.png',
    '../../images/IMG_9955.png',
    '../../images/IMG_9957.png',
    '../../images/IMG_9962.png',
    '../../images/IMG_9964.png',
    '../../images/IMG_9966.png',
    '../../images/IMG_9968.png',
    '../../images/IMG_9984.png',
    '../../images/IMG_9986.png',
    '../../images/IMG_9991.png'
]

const masonry = document.getElementById('masonry');

for (let i = 0; i < images.length; i++) {
    // Creating figure component
    const figure = document.createElement('figure')
    masonry.appendChild(figure);

    const button = document.createElement('button')
    button.id = `imageButton${i}`;
    figure.appendChild(button);
    
    const img = document.createElement('img');
    img.src = images[i];
    img.alt = "Open";
    img.width = 570;
    button.appendChild(img)

    // Creating modal component
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

    // Modal open and close logic
    button.onclick = function showModal() {
        imageModal.style.display = "block";
    }

    window.addEventListener("click", function(event) {
        if(event.target == imageModal | event.target == modalContent | event.target == bigImage) {
            imageModal.style.display = "none";
        }
    })
}