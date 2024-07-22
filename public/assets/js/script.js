
/*********************************
* hamburger-menu
*********************************/
const hamburger = document.querySelector('#js-hamburger');
const nav = document.querySelector('#js-nav');

hamburger.addEventListener('click', function () {
  hamburger.classList.toggle('active');
  nav.classList.toggle('active');
});

/*********************************
* tab
*********************************/
const tabItem    = document.querySelectorAll(".tab-item");
const tabContent = document.querySelectorAll(".tab-content");

for (let i = 0; i < tabItem.length; i++) {
  tabItem[i].addEventListener("click", tabToggle);
}

function tabToggle() {
  for (let i = 0; i < tabItem.length; i++) {
    tabItem[i].classList.remove("active");
  }
  for (let i = 0; i < tabContent.length; i++) {
    tabContent[i].classList.remove("active");
  }
  this.classList.add("active");

  const aryTabs = Array.prototype.slice.call(tabItem);

  const index = aryTabs.indexOf(this);

  tabContent[index].classList.add("active");
}
/*********************************
* Modal
*********************************/
const btn = document.querySelector('.modal-btn');
const modal = document.querySelector('.modal');
const closeBtn = document.querySelector('.close');
const overlay = document.querySelector('.overlay');

btn.addEventListener('click', function(e){
  e.preventDefault();
  modal.classList.add('active');
  overlay.classList.add('active');
});

closeBtn.addEventListener('click', function(){
  modal.classList.remove('active');
  overlay.classList.remove('active');
});

overlay.addEventListener('click', function() {
  modal.classList.remove('active');
  overlay.classList.remove('active');
});
