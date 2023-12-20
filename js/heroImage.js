// Funktionen tjekker om elementet der bliver parsed ind er synligt i det aktuelle visningsområde (viewport).
function isVisibleInViewport(elem) {
    var y = elem.offsetTop;
    var height = elem.offsetHeight;

    while (elem = elem.offsetParent)
        y += elem.offsetTop;

    var maxHeight = y + height;

    var isVisible = (y < (window.pageYOffset + window.innerHeight)) && (maxHeight >= window.pageYOffset);

    return isVisible;
}

// executed sættes til false som standard
var executed = false;
function resetScrollPosition() {
    //Hvis excecute er false kører vi videre
    if (!executed) {
        executed = true;
        //sætter window scroll position til 0.
        window.scrollTo(0, 0);
    }
}

// man registrerer hver gang der bliver scrollet og kører funktionen check.
window.onscroll = function check() {
    //Først tages der fat i hero elementet fra forsiden
    var hero = document.getElementById("hero");

    //tjekker om hero elementet er i viewporten
    //Hvis hero ikke er i viewport så går man til if strukturen
    if (!isVisibleInViewport(hero))
        //Der sættes en session storage kaldet showImage=false
        sessionStorage.setItem("showImage", "false"),
            // Hero sættes til display=none via CSS
            hero.style.display = "none",
            //Kører funktionen "reset scroll position". Der er oprettet en funktion for at sikrer at denne kun bliver kørt første gang.
            // Dette gøres ved at sætte executed til true første gang funktionen er kørt.
            // Gør man ikke dette vil man ikke kunne scrolle nedad på siden så snart hero er udenfor viewporten, da scroll position vil blive sat til 0 hver gang man scroller.
            resetScrollPosition();
}

// Når index siden loader køres hideImage funktionen, som tjekker for vores session storage showImage.
// Er showImage=false sætter vi heroen til display=none.
window.onload = function hideImage() {
    let showImage = sessionStorage.getItem("showImage")
    if (showImage === "false")
        document.getElementById("hero").style.display = "none";
}