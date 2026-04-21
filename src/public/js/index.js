const menu = document.querySelector('#header-site-menu');

const btn = document.querySelector('#toggle-menu-button');

btn.addEventListener('click', function () {
    menu.classList.toggle('open');
});

const param = new URLSearchParams(window.location.search);

const tab = param.get('tab');
const recommend = document.querySelector('.recommend');
const mylist = document.querySelector('.mylist');

if (tab == 'mylist') {
    mylist.classList.add('active');
    recommend.classList.remove('active');
}
