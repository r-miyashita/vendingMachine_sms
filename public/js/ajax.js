/********************************
 * イベント発火
 * 
 * phpからデータ取得
 * 
 * 初期テーブル削除
 * 
 * 結果テーブル作成
 ********************************/

$(function() {
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
            var $tag_detail = '<td class="table__data-row-cell table__data-row-cell--button"><a class="link--detail" href="{{ route(\'product.detail\', [\'id\'=>$product->id]) }}">Detail</a></td>';
            var $tag_destroy = '';

            for(var i in data) {
                $('#result').append('<tr class="table__data-row" id= "rowNum' + i + '">');

                $('#rowNum'+ i)
                .append($tag_td + data[i].id)
                .append($tag_td + '<img class="table__data-row-cell--img" src="storage/' + data[i].img_path + '">')
                .append($tag_td + data[i].product_name)
                .append($tag_td + data[i].price)
                .append($tag_td + data[i].stock)
                .append($tag_td + data[i].company_name)
                .append($tag_detail)
                .append($tag_destroy)
                .appendTo($('#result'));
            }

        }).fail(function(data) {
          console.log("通信失敗");
          console.log("取得データ：");
          console.log(data);
        });
    });
});


