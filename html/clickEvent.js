const openBtn = document.getElementById('openModal');
const overlay = document.getElementById('modalOverlay');
const closeBtn = document.getElementById('closeModal');

// 開く
openBtn.addEventListener('click', () => {
  overlay.classList.add('show');
  overlay.setAttribute('aria-hidden', 'false');
  // フォーカスをモーダル内に移動
  closeBtn.focus();
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
  openBtn.focus();
}
