function isVisibleInViewport(elem) {
    var y = elem.offsetTop;
    var height = elem.offsetHeight;
    
    while ( elem = elem.offsetParent )
    y += elem.offsetTop;

    var maxHeight = y + height;
    var isVisible = ( y < ( window.pageYOffset + window.innerHeight ) ) && ( maxHeight >= window.pageYOffset );

    return isVisible; 
}

var executed = false;
function resetScrollPosition() {
    if(!executed) {
        executed = true;
        window.scrollTo(0,0); 
    }
}

window.onscroll = function check() {
    var hero = document.getElementById("hero");

    if(!isVisibleInViewport(hero))
    sessionStorage.setItem("showImage", "false"),
    hero.style.display = "none",
    resetScrollPosition();
}

window.onload = function hideImage() {
    let showImage = sessionStorage.getItem("showImage")
    if(showImage === "false")
        document.getElementById("hero").style.display = "none";
}