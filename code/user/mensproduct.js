let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

// Toggle navbar open/close on menu icon click
menu.onclick =() => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');

}