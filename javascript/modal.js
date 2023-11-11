const images = [
    '../../images/IMG_0002.png', 
    '../../images/IMG_0006.png', 
    '../../images/IMG_0023.png', 
    '../../images/IMG_0026.png', 
    '../../images/IMG_0028.png', 
    '../../images/IMG_9656.png', 
    '../../images/IMG_9657.png', 
    '../../images/IMG_9658.png', 
    '../../images/IMG_9669.png', 
    '../../images/IMG_9674.png', 
    '../../images/IMG_9675.png', 
    '../../images/IMG_9685.png', 
    '../../images/IMG_9688.png', 
    '../../images/IMG_9693.png', 
    '../../images/IMG_9695.png', 
    '../../images/IMG_9696.png', 
    '../../images/IMG_9700.png', 
    '../../images/IMG_9702.png', 
    '../../images/IMG_9703.png', 
    '../../images/IMG_9705.png', 
    '../../images/IMG_9707.png', 
    '../../images/IMG_9709.png', 
    '../../images/IMG_9717.png', 
    '../../images/IMG_9724.png', 
    '../../images/IMG_9727.png', 
    '../../images/IMG_9736.png', 
    '../../images/IMG_9739.png', 
    '../../images/IMG_9747.png', 
    '../../images/IMG_9749.png', 
    '../../images/IMG_9780.png', 
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

    const closeImage = document.createElement('div');
    closeImage.id = `closeImage${i}`
    closeImage.className = "close";
    modalContent.appendChild(closeImage);

    const iconSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    iconSvg.setAttribute('stroke', 'currentColor');
    iconSvg.setAttribute('fill', 'currentColor');
    iconSvg.setAttribute('stroke-width', '0');
    iconSvg.setAttribute('viewBox', '0 0 512 512');
    iconSvg.setAttribute('height', '1em');
    iconSvg.setAttribute('width', '1em');
    closeImage.appendChild(iconSvg);
    
    const iconPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    iconPath.setAttribute('d', 'M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z');
    iconSvg.appendChild(iconPath);

    const bigImage = document.createElement('img');
    bigImage.className = "modal-image";
    bigImage.src = images[i];
    // bigImage.width = 1400;
    modalContent.appendChild(bigImage);

    // Modal open and close logic
    button.onclick = function showModal() {
        imageModal.style.display = "block";
    }

    closeImage.onclick = function() {
        imageModal.style.display = "none";
    }

    window.onclick = function(event) {
        if(event.target == imageModal) {
            imageModal.style.display = "none";
        }
    }
}
