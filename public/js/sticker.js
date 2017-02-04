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

    
    // ▼画像定義
    $(".image").click(function () {
        flag =false;
        var value = $(this).attr('value');
    	image_num++;
        console.log(value);
		var html = '<div id="image_' + image_num + '" class="ui-widget-content jquery-ui-draggable ' + value + '" style="background-color:transparent; border:0px; position:absolute;"></div>';
		$(html).draggable({containment: '#jquery-ui-draggable-wrap',scroll: false,}).appendTo('#jquery-ui-draggable-wrap');
		$('#image_' + image_num).css({'top': 0});
    });
    // ▲画像定義

    $("#save").click(function(){
        var text = $("#jquery-ui-draggable-wrap").html();
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
                        'html' : text
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

    $('#big').click(function () {
        rotateSet(0);
        
        var height = $('#image_' + image_num).height();
        var width = $('#image_' + image_num).width();
        height = height * 1.1;
        width = width * 1.1;
        $('#image_' + image_num).css({'height':height, 'width':width});
    });

    $('#small').click(function () {
        rotateSet(0);

        var height = $('#image_' + image_num).height();
        var width = $('#image_' + image_num).width();
        height = height * 0.9;
        width = width * 0.9;
        $('#image_' + image_num).css({'height':height, 'width':width});
    });

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
