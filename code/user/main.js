 let next = document.querySelector('.next')
let prev = document.querySelector('.prev')

next.addEventListener('click', function(){
    let items = document.querySelectorAll('.item')
    document.querySelector('.slide').appendChild(items[0])
})

prev.addEventListener('click', function(){
    let items = document.querySelectorAll('.item')
    document.querySelector('.slide').prepend(items[items.length - 1]) 
})
setInterval(function() {
    let items = document.querySelectorAll('.item');
    document.querySelector('.slide').appendChild(items[0]);
}, 5000);     


// document.addEventListener("DOMContentLoaded", function () {
//     const buttons = document.querySelectorAll('.some-button-class');
//     buttons.forEach(button => {
//         button.addEventListener('click', () => {
//             // Your onclick code here
//         });
//     });
// });

let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick =() => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');

}