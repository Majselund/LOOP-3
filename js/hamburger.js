const open = document.getElementById('hamburger-open');
const close = document.getElementById('hamburger-close');

const menu = document.getElementById('menu-mobile')

open.onclick = function showMenu() {
    menu.style.display = "block";
    document.body.style.position = 'fixed';
}

close.onclick = function hideMenu() {
    menu.style.display = "none";
    document.body.style.position = '';
}

window.addEventListener("click", function (event) {
    if (event.target == menu | event.target == close) {
        menu.style.display = "none";
        document.body.style.position = '';
    }
})

function closeScrollBottom() {
    menu.style.display = "none";
    document.body.style.position = '';
    window.scrollTo(0, document.body.scrollHeight)
}