const menu = document.querySelector('#header-site-menu');

const btn = document.querySelector('#toggle-menu-button');

btn.addEventListener('click', function () {
    menu.classList.toggle('open');
});
