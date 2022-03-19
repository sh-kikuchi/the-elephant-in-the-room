const menu_btn = document.getElementById('menu-btn');
const menu = document.getElementById('menu');

menu_btn.onclick = function () {
  menu.classList.toggle('is-active');
}
