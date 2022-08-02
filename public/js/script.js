function deleteCheck(event) {
  if(confirm("本当に削除しますか？")) {
    // そのままsubmit処理
    return true;
  } else {
    // キャンセル
    event.stopPropagation();
    event.preventDefault();
  }
};

// ↓↓↓ イベントリスナー ↓↓↓

// ★削除イベント ↓↓↓
var $delete_buttons = document.querySelectorAll(".table__del-btn");

$delete_buttons.forEach(function($value){
  $value.addEventListener("submit", deleteCheck);
});
// ★削除イベント ↑↑↑

// ↑↑↑ イベントリスナー ↑↑↑

