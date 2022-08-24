/********************************
 * データ削除処理
 ********************************/
// イベント対象取得
var $delete_buttons = document.querySelectorAll(".table__del-btn");

// 確認イベント登録
$delete_buttons.forEach(function($value){
  $value.addEventListener("submit", deleteCheck);
});

// 確認ダイアログ（削除）処理
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
