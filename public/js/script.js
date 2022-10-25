$(function(){
/********************************
 * ソート処理
 * ******************************
 * イベント テーブルヘッダをクリック
 * 
 * ヘッダ情報読み込み（列インデックス、ソートフラグ）
 * 
 * ソートフラグリフレッシュ
 * 
 * ソートフラグ設定
 * 
 * テーブルソート処理（列インデックス、ソートフラグ）
 * 
 ********************************/
    $('th').on('click',function(){
        // 情報取得
        var $ele = $(this).attr('id');
        var $sortFlag = $(this).data('sort');
        
        // リセット
        $('th').data('sort', "");
        
        // ソートフラグセット
        if ($sortFlag == "" || $sortFlag == "desc") {
            $sortFlag = "asc";
            $(this).data('sort', "asc");
        } else {
            $sortFlag = "desc";
            $(this).data('sort', "desc");
        }

        // テーブルソートメソッド
        sortTable($ele, $sortFlag);
    });

/********************************
 * テーブルソートメソッド
 * ******************************
 * 
 * @param $ele
 *
 * @param $sortFlag
 *
 ********************************/
    function sortTable($ele, $sortFlag) {
      var $arr = $('table tbody tr').sort(function (a, b) {
          // ソート対象が数値の場合
          if ($.isNumeric($(a).find('td').eq($ele).text())) {
              var $aNum = Number($(a).find('td').eq($ele).text());
              var $bNum = Number($(b).find('td').eq($ele).text());
              if ($sortFlag == "asc") {
                return $aNum - $bNum;
              } else {
                return $bNum - $aNum;
              }
          } else { // ソート対象が数値でない場合
              var $sortNum = 1;

              // 比較時は小文字に統一
              if ($(a).find('td').eq($ele).text().toLowerCase() > $(b).find('td').eq($ele).text().toLowerCase()) {
                  $sortNum = 1;
              } else {
                  $sortNum = -1;
              }
              if ($sortFlag == "desc") {
                $sortNum *= (-1);
              }

              return $sortNum;
          }
      });
      $('table tbody').html($arr);
    }
    
});

