$(function () {

  $('.public-change-btn').click(function(){
    var btnSelector = $(this);
    var productId = $('.product-id-' + btnSelector.val()).val();

    // 公開状態更新リクエスト送信
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'post',
      url: '/design/change-public',
      data: {
        'product_id' : productId
      }

    }).done(function(responseDate) {
      if ( responseDate['public_flag'] ) {
        // 公開
        btnSelector.text('Public').addClass('btn-info').removeClass('btn-warning');
      } else {
        // 非公開
        btnSelector.text('Private').addClass('btn-warning').removeClass('btn-info');
      }
    });
  });

});
