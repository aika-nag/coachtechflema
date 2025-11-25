const param = new URLSearchParams(window.location.search);

const mypage = param.get('page');

if (mypage == 'buy') {
    document.getElementById('sell-item').style.color = "#5F5F5F";
    document.getElementById('buy-item').style.color = "#FF0000";

}
