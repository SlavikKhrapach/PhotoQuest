var main = document.querySelector('.intro');
var nav = document.querySelector('.nav');
var topnav = document.querySelector('.top-nav');


window.onscroll = function () {

    if (window.pageYOffset > (main.offsetHeight - nav.offsetHeight)) {
        nav.classList.remove('bottom-nav');
        nav.classList.add('top-nav');
        topnav.setAttribute("background", "url('../images/intro2.png') no-repeat 50% 50%;")
    } else {
        nav.classList.add('bottom-nav');
        nav.classList.remove('top-nav');
    }
}
