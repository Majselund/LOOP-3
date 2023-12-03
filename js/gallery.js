const masonry = document.getElementById('masonry');

for (let i = 1; i < 100; i++) {
    const button = document.getElementById(`imageButton${i}`)
    const imageModal = document.getElementById(`imageModal${i}`);
    const modalContent = document.getElementById(`modalContent${i}`);
    const bigImage = document.getElementById(`bigImage${i}`);

    // Modal open and close logic
    button.onclick = function showModal() {
        imageModal.style.display = "block";
    }

    window.addEventListener("click", function (event) {
        if (event.target == imageModal | event.target == modalContent | event.target == bigImage) {
            imageModal.style.display = "none";
        }
    })
}