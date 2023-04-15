const navbarToggler = document.querySelector('.navbar-toggler');
const navbarLinks = document.querySelector('.navbar-links');

navbarToggler.addEventListener('click', () => {
  navbarLinks.classList.toggle('show');
});