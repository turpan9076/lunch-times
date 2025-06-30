//const openBtn = document.getElementById('openMealInfo');
const overlay = document.getElementById('mealInfoOverlay');
const closeBtn = document.getElementById('closeMealInfo');

// 開く
document.querySelectorAll('.open-meal-info').forEach(openBtn =>{
    openBtn.addEventListener('click', () => {
    overlay.classList.add('show');
    overlay.setAttribute('aria-hidden', 'false');
    const idx = openBtn.getAttribute('data-index');//idxを取得
    // フォーカスをモーダル内に移動
    closeBtn.focus();
    });
});

// 閉じる
closeBtn.addEventListener('click', closeModal);
overlay.addEventListener('click', (e) => {
  // オーバーレイの背景部分クリックで閉じる場合
  if (e.target === overlay) {
    closeModal();
  }
});

function closeModal() {
  overlay.classList.remove('show');
  overlay.setAttribute('aria-hidden', 'true');
  //openBtn.focus();
}

//日付表示
const today = new Date();
const month = today.getMonth() + 1;
const date = today.getDate();
const days = ['日','月','火','水','木','金','土']
const weekday = days[today.getDay()];
const dayText = `${month}/${date} (${weekday})`;

const todayEl= document.getElementById('today');
// DOM が読み込まれたタイミングで処理を実行
document.addEventListener('DOMContentLoaded', () => {
  todayEl.innerText=dayText;
});

document.addEventListener('DOMContentLoaded', () => {
  // 事前にターゲット要素を取得
  const target1 = document.getElementById('target1');
  const target2 = document.getElementById('target2');
  const target3 = document.getElementById('target3');
  const target4 = document.getElementById('target4');

  document.querySelectorAll('.nav-link').forEach(btn => {
    btn.addEventListener('click', () => {
      // data-index を読み取り
      const idx = btn.getAttribute('data-index');
      let target;
      switch (idx) {
        case "1":
          target = target1;
          break;
        case "2":
          target = target2;
          break;
        case "3":
          target = target3;
          break;
        case "4":
          target = target4;
          break;
        default:
          console.warn('不正な data-index:', idx);
          return;
      }
      if (!target) {
        console.warn('スクロール先要素が見つからない:', idx);
        return;
      }
      // 要素の位置を取得してスクロール
      const topPosition = target.getBoundingClientRect().top + window.pageYOffset;
      window.scrollTo({
        top: topPosition,
        behavior: 'smooth'
      });
    });
  });
});
