$(function () {

  $('.public-change-btn').click(function(){
    var btnSelector = $(this);
    var productId = $('.product-id-' + btnSelector.val()).val();

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
    }).done(function(responseDate, statusCode, xhr) {
      if ( responseDate['public_flag'] ) {
        // 公開
        btnSelector.text('Public').addClass('btn-info').removeClass('btn-warning');
      } else {
        // 非公開
        btnSelector.text('Private').removeClass('btn-info').addClass('btn-warning');
      }
    });
  });

});
