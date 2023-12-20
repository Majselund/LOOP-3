//løkkestrukturen kører igennem 100 gange uaset antallet af billeder (dog max de 100)
for (let i = 1; i < 100; i++) {
    const button = document.getElementById(`imageButton${i}`)
    const imageModal = document.getElementById(`imageModal${i}`);
    const modalContent = document.getElementById(`modalContent${i}`);
    const bigImage = document.getElementById(`bigImage${i}`);

    // når man trykker på knappen som er thumbnailbilledet, så sætter man image modal til diplay = block
    button.onclick = function showModal() {
        imageModal.style.display = "block";
    }
    // Hvis man trykker imagemodal, modalcontent eller bigimage, så lukker det store billede
    window.addEventListener("click", function (event) {
        if (event.target == imageModal | event.target == modalContent | event.target == bigImage) {
            imageModal.style.display = "none";
        }
    })
}