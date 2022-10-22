$(function() {
/********************************
 * 検索処理
 * ******************************
 * phpからデータ取得
 * 
 * 初期テーブル削除
 * 
 * 結果テーブル作成
 ********************************/

    $('#ajaxSearch').on('click',function(e){
        var keyword = $('#keyword').val();
        var filter = $('#filter option:selected').val();
        var minPrice = $('#minPrice').val();
        var maxPrice = $('#maxPrice').val();
        var minStock = $('#minStock').val();
        var maxStock = $('#maxStock').val();

        // デフォルトの処理をキャンセル
        e.preventDefault();

        $.ajax({
            type: 'GET',
            url: 'list/search/' + keyword + filter + minPrice + maxPrice + minStock + maxStock,
            dataType: 'json',
            data: {
                "keyword": keyword,
                "filter": filter,
                "minPrice": minPrice,
                "maxPrice": maxPrice,
                "minStock": minStock,
                "maxStock": maxStock
            }

        }).done(function(data) {
            $('#result').remove();
            $('.table').append('<tbody class="table__body"  id="result">');

            var $tag_td = '<td class="table__data-row-cell">';
            var $tag_td_id = '<td class="table__data-row-cell td-id">';
            var $tag_td_btn = '<td class="table__data-row-cell table__data-row-cell--button">';

            for(var i in data) {
                var $rowNum = parseInt(i) + 1;
                $('#result').append('<tr class="table__data-row" id= "rowId' + $rowNum + '">');
                 
                $('#rowId'+ $rowNum)
                .append($tag_td_id + data[i].id)
                .append($tag_td + '<img class="table__data-row-cell--img" src="storage/' + data[i].img_path + '">')
                .append($tag_td + data[i].product_name)
                .append($tag_td + data[i].price)
                .append($tag_td + data[i].stock)
                .append($tag_td + data[i].company_name)
                .append($tag_td_btn + '<a class="link--detail" href="' + 'detail/' + data[i].id + '">Detail</a>')
                .append($tag_td_btn + '<button class="link--destroy" type="submit" value="">Destroy</button>')
                ;
                $rowNum++;
            }

        }).fail(function(data) {
          console.log("通信失敗");
          console.log("取得データ：");
          console.log(data);
        });
    });

/********************************
 * 削除処理
 * ******************************
 * phpからデータ取得
 * 
 * 初期テーブル削除
 * 
 * 結果テーブル作成
 ********************************/

    $(document).on('click', '.link--destroy', function(){
        if(confirm("本当に削除しますか？")) {
            // クリックされた行要素取得(要素のidは 「'rowId' + 商品ID」 で設定されている)
            var $target = $(this).parent().parent();
            // ターゲットから商品IDを取得
            var $id = $target.find('.td-id').text();
            // 商品IDに紐づく商品を削除
            // ajax
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'destroy/' + $id,
                datatype: 'json',
                data: {
                    "id": $id
                }
            }).done(function(data) {
                console.log('削除成功' + 'ID:' + $id);
                $target.remove();
            }).fail(function(data) {
                console.log('削除失敗' + 'ID:' + $id);
            });
        }else {
            return false;
        }
    });

});
