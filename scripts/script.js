let main = document.querySelector('.intro');
let nav = document.querySelector('.nav');
let topnav = document.querySelector('.top-nav');

window.addEventListener('load', function() {
    let targetDiv = document.getElementById('content');
    let offset = targetDiv.offsetTop - 100;

    // Smooth scroll animation
    window.scrollTo({
        top: offset,
        behavior: 'smooth'
    });
});

// Attach event listener to all anchor tags on the page
let links = document.querySelectorAll('.nav a');

links.forEach(function(link) {
    link.addEventListener('click', function(event) {
        // Prevent the default click behavior
        event.preventDefault();

        // Scroll to the top of the page
        window.scrollTo({
            top: 0,
            behavior: 'auto'
        });

        // Wait for the scroll animation to finish
        setTimeout(function() {
            // Navigate to the new page
            window.location.href = link.href;
        }, 1000); // Adjust the delay as needed
    });
});


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
