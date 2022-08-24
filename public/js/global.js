/********************************
 * ドロップダウンリスト処理
 ********************************/
// イベント対象取得
var $parents = document.getElementsByClassName("nav__item");
$parents = Array.from($parents);

// クリックイベント登録
$parents.forEach( function(element) {
  element.addEventListener("click", hasOpenClass, false);
});

// ドロップダウン開閉するための処理
function hasOpenClass() {
    var $target = this.querySelector(".nav__item-child--dropdown");
    if ( !($target.classList.contains("open")) ) {
        $target.classList.add("open");
    } else {
          $target.classList.remove("open");
    };
}
