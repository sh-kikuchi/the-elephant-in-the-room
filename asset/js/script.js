
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

  // tabItemを配列にする
  // [<li class="tab-item active">About</li>, <li class="tab-item">Works</li>, <li class="tab-item">Contact</li>]
  const aryTabs = Array.prototype.slice.call(tabItem);

  // 配列に格納したキーワードと最初一致したインデックスを格納
  // <li class="tab-item active">About</li>の場合は「0」が返ってくる
  const index = aryTabs.indexOf(this);

  // インデックスに対応したtabContentに.activeを追加
  tabContent[index].classList.add("active");
}
/*********************************
* Modal
*********************************/
const btn = document.querySelector('.modal-btn');
const modal = document.querySelector('.modal');
const closeBtn = document.querySelector('.close');
const overlay = document.querySelector('.overlay');

// ボタンをクリックしたら、モダルとオーバーレイに.activeを付ける
btn.addEventListener('click', function(e){
  // aタグのデフォルトの機能を停止する
  e.preventDefault();
  　// モーダルとオーバーレイにactiveクラスを付与する
  modal.classList.add('active');
  overlay.classList.add('active');
});

// モダルの閉じるボタンをクリックしたら、モダルとオーバーレイのactiveクラスを外す
closeBtn.addEventListener('click', function(){
  modal.classList.remove('active');
  overlay.classList.remove('active');
});

// オーバーレイをクリックしたら、モダルとオーバーレイのactiveクラスを外す
overlay.addEventListener('click', function() {
  modal.classList.remove('active');
  overlay.classList.remove('active');
});