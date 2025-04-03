document.querySelector('#navbarToggler').addEventListener('click', function () {
    const navMenu = document.querySelector('#navbarMenu');
    if (navMenu.classList.contains('navbar-menu-hidden')) {
        navMenu.classList.remove('navbar-menu-hidden');
    } else {
        navMenu.classList.add('navbar-menu-hidden');
    }
});