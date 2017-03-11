var image_num = 0;
var num = 0;
var flag = false;
var angle = 0;
var transform_param = "rotate(" + angle + "deg)";

jQuery( function() {
   jQuery('.jquery-ui-draggable').draggable( {
        containment: '#jquery-ui-draggable-wrap',
        scroll: false,
    } );

    
    // 画像読み込み
    $(".image").click(function () {
        flag =false;
        var value = $(this).attr('value');
        image_num++;
        console.log(value);
        var html = '<div id="image_' + image_num + '" class="ui-widget-content jquery-ui-draggable ' + value + '" style="background-color:transparent; border:0px; position:absolute;"></div>';
        $(html).draggable({containment: '#jquery-ui-draggable-wrap',scroll: false,}).appendTo('#jquery-ui-draggable-wrap');
        $('#image_' + image_num).css({'top': 0});
        $('#image_' + image_num).height($('#image_' + image_num).height());
        $('#image_' + image_num).width($('#image_' + image_num).width());
    });

    // セーブ
    $("#save").click(function(){
        var text = $("#jquery-ui-draggable-wrap").html();
        var base64Image = $('#screen_image')[0].src;
        var tmp_text = text.replace(/\s+/g, "");
        console.log(text);
        if(tmp_text != ''){
            if(window.confirm('Is this Save?')){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: '/design',
                    data: {
                        'html' : text,
                        'base64Image' : base64Image
                    },
                    success: function(){

                    }
                })
            }
        }else{
            alert("No add sticker.");
        }
    });

    $('#scale').click(function () {
        
        
    });

    // 拡大
    $('#big').click(function () {
        rotateSet(0);
        resizeImage(1.1);
    });

    // 縮小
    $('#small').click(function () {
        rotateSet(0);
        resizeImage(0.9);
    });

    // 画像サイズ変更
    function resizeImage(_size_rate){

        var height = $('#image_' + image_num).height();
        var width = $('#image_' + image_num).width();
        height = height * _size_rate;
        width = width * _size_rate;
        $('#image_' + image_num).css({'height':height, 'width':width});
    }

    // 右回転
    $('#rotate_right').click(function () {
    	var obj = $('#image_' + image_num);
    	var matrix = obj.css("-webkit-transform") ||
        obj.css("-moz-transform")    ||
        obj.css("-ms-transform")     ||
        obj.css("-o-transform")      ||
        obj.css("transform");

        console.log(matrix);
        
        if(matrix !== 'none') {
            var values = matrix.split('(')[1].split(')')[0].split(',');
            var a = values[0];
            var b = values[1];
            var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
        } else { 
            var angle = 0; 
        }
        angle = (angle < 0) ? angle +=360 : angle;
        angle += 10;

        rotateSet(angle);
    });

    // 左回転
    $('#rotate_left').click(function () {
        var obj = $('#image_' + image_num);
        var matrix = obj.css("-webkit-transform") ||
        obj.css("-moz-transform")    ||
        obj.css("-ms-transform")     ||
        obj.css("-o-transform")      ||
        obj.css("transform");

        console.log(matrix);

        if(matrix !== 'none') {
            var values = matrix.split('(')[1].split(')')[0].split(',');
            var a = values[0];
            var b = values[1];
            angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
        } else { 
            angle = 0; 
        }
        angle = (angle < 0) ? angle +=360 : angle;
        angle -= 10;

        rotateSet(angle);
    });

    // 回転リセット
    $('#rotate_reset').click(function () {
        rotateSet(0);
    });

    function rotateSet(angle){
        transform_param = "rotate(" + angle + "deg)";
        $('#image_' + image_num).css({
            '-webkit-transform' : transform_param,
            '-moz-transform' : transform_param,
            '-ms-transform' : transform_param,
            'transform' : transform_param
        });
    }

    $("#delete").click(function () {
        $('#image_' + image_num).remove();
        if(image_num > 0){
            image_num--;
        }
    });

} );

function screenshot() {
    var element = $("#jquery-ui-draggable-wrap");
    // 画像の生成
    html2canvas(element, { onrendered: function(canvas) {
        var imgData = canvas.toDataURL();
        $('#screen_image')[0].src = imgData;
        $('#download')[0].href = imgData;
        $('#download')[0].innerHTML = "Download";
    }});
    // ポップアップの表示
    $('[data-remodal-id=modal]').remodal().open();
}

// 生成画像の削除
function erase_screenshot() {
    $('#screen_image')[0].src = "";
    $('#download')[0].href = "#";
    $('#download')[0].innerHTML = "";
}
