function MyCanvas(stageWidth, stageHeight) {
  var stage = new Konva.Stage({
    container: 'input-canvas',
    width: stageWidth,
    height: stageHeight
  });

  var layer = new Konva.Layer();
  stage.add(layer);

  layer.batchDraw();

  this.layer = layer;
}

MyCanvas.prototype.addSticker = function(image, x, y) {
  var layer = this.layer;

  var rect = new Konva.Rect({
    x: x,
    y: y,
    width: image.width,
    height: image.height,
    name: 'rect',
    draggable: true,
    fillPatternImage: image,
    fillPatternRepeat: 'no-repeat'
  });
  layer.add(rect);

  var tr = new Konva.Transformer({
    anchorStroke: '#222222',
    anchorFill: '#F2F2F2',
    anchorSize: 20,
    borderStroke: '#222222',
    borderDash: [3, 3],
  });
  tr.attachTo(rect);

  layer.add(tr);
  layer.draw();
};

/**
 * 直前に追加した画像を削除
 */
MyCanvas.prototype.deleteSticker = function() {
  var layer = this.layer;

  // 削除して詰める
  var delIndex = layer.children.length - 2;
  layer.children.splice(delIndex, 2);

  layer.draw();
};

/**
 * 全ての画像を削除
 */
MyCanvas.prototype.resetSticker = function() {
  var layer = this.layer;
  layer.children = new Konva.Collection;
  layer.draw();
};

/**
 * 枠の表示/非表示
 * @param attachFlag
 */
MyCanvas.prototype.attachTransformer = function(attachFlag) {
  var layer = this.layer;

  if ( attachFlag ) {
    // 枠の表示
    layer.children.forEach(function(sticker) {
      if ( !(sticker instanceof Konva.Rect) ) {
        sticker.show();
      }
    });
  } else {
    // 枠の非表示
    layer.children.forEach(function(sticker) {
      if ( !(sticker instanceof Konva.Rect) ) {
        sticker.hide();
      }
    });
  }

  layer.draw();
};

// 初期化
var height = window.innerHeight * 0.9;
var width  = height * 1.463;
$('#input-canvas').attr('height', height);
var macCanvas = new MyCanvas(width, height);

/**
 * ステッカーの追加
 */
function addSticker(imageFileName) {
  var image = new Image();
  image.src = imageFileName;
  macCanvas.addSticker(image, 160, 10)
}

/**
 * ステッカーの追加: 位置指定あり
 */
function addSticker(imageFileName,x ,y) {
  var image = new Image();
  image.src = imageFileName;
  macCanvas.addSticker(image, x, y)
}

/**
 * ステッカーの削除
 */
function deleteSticker() {
  macCanvas.deleteSticker();
}

/**
 * ステッカーの全削除
 */
function resetSticker() {
  macCanvas.resetSticker();
}

/**
 * 画像選択モーダル表示
 */
function selectSticker() {
  $('[data-remodal-id=select-sticker-modal]').remodal().open();
}

/**
 * 保存選択モーダル表示
 */
function confirmSaveImage() {
  macCanvas.attachTransformer(false);
  // 画像の生成
  html2canvas($("#input-canvas"), { onrendered: function(canvas) {
    var imgData = canvas.toDataURL();
    $('#screen-image')[0].src = imgData;
    $('#download')[0].href = imgData;
    $('#download')[0].innerHTML = "Download";
    macCanvas.attachTransformer(true);
  }});

  $('[data-remodal-id=modal]').remodal().open();
}

$(function() {
  $("#save-image").click(function(){
    var base64Image = $('#screen-image')[0].src;
    if( true ){
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
            'base64Image' : base64Image
          },
          success: function(){

          }
        });
      }
    }else{
      alert("No add sticker.");
    }
  });
});
