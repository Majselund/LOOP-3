const open = document.getElementById('hamburger-open');
const close = document.getElementById('hamburger-close');

const menu = document.getElementById('menu-mobile')

open.onclick = function showMenu() {
    menu.style.display = "block";
}

close.onclick = function hideMenu() {
    menu.style.display = "none";
}
