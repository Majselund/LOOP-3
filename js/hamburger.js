//registrerer hamburger icon som variablen open
const open = document.getElementById('hamburger-open');
// registrerer X icon som variablen close
const close = document.getElementById('hamburger-close');

//registrerer menumobile elementet som menu
const menu = document.getElementById('menu-mobile')

//Når man klikker på hamburgermenu (open) køres funktionen showmenu
open.onclick = function showMenu() {
    // Menuen sættes til display=block
    menu.style.display = "block";
    // Body sættes til position fixed for at forhindre at man kan scrolle med siden bagved menuen
    document.body.style.position = 'fixed';
}

// når man klikker på x iconet (close) køres funktionen hidemenu
close.onclick = function hideMenu() {
    // Menuen sættes til display=none
    menu.style.display = "none";
    // Body bliver sat tilbage til position blank, så man igen kan scrolle
    document.body.style.position = '';
}

// Registrerer om der foretages et klik og hvis man klikker på menu køres if.
window.addEventListener("click", function (event) {
    if (event.target == menu) {
        //men bliver sat til display=none
        menu.style.display = "none";
        // Body bliver sat til position blank så man igen kan scrolle
        document.body.style.position = '';
    }
})

//nedenstående funktion bruges til mobil menuen
// når man klikker på kontakt linket lukkes menuen og der scrolles ned til bunden af siden, hvor kontaktinformation er.
function closeScrollBottom() {
    menu.style.display = "none";
    document.body.style.position = '';
    window.scrollTo(0, document.body.scrollHeight)
}