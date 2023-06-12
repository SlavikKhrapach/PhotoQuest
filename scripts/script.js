var main = document.querySelector('.intro');
var nav = document.querySelector('.nav');
var topnav = document.querySelector('.top-nav');

// Check if the previous page was scrolled to the top
var isScrolledToTop = localStorage.getItem('isScrolledToTop') === 'true';

// Attach event listener to all anchor tags on the page
var links = document.querySelectorAll('a');

links.forEach(function(link) {
    link.addEventListener('click', function(event) {
        // Check if the previous page was scrolled to the top
        if (isScrolledToTop) {
            // If scrolled to top, smoothly scroll to the selected section
            event.preventDefault();

            var targetSection = link.getAttribute('data-section');
            var targetElement = document.getElementById('content');
            var offset = targetElement.offsetTop;

            window.scrollTo({
                top: offset,
                behavior: 'smooth'
            });

            // Wait for the scroll animation to finish
            setTimeout(function() {
                // Navigate to the new page
                window.location.href = link.href;
            }, 1000); // Adjust the delay as needed
        } else {
            // If not scrolled to top, load the new page instantly scrolled to the selected section
            // The default behavior of the link will be used
            localStorage.setItem('isScrolledToTop', 'false');
        }
    });
});

// Save the scroll position of the current page
window.addEventListener('beforeunload', function() {
    var isAtTop = window.scrollY === 0;
    localStorage.setItem('isScrolledToTop', isAtTop ? 'true' : 'false');
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
