let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

// Toggle navbar open/close on menu icon click
menu.onclick =() => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');

}
document.querySelectorAll('.faq-question').forEach((question) => {
    question.addEventListener('click', () => {
        const parent = question.parentElement;
        parent.classList.toggle('open'); // Toggle 'open' class to show/hide answer
    });
});
