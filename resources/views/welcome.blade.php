@extends('layouts.app')

@section('create_navbar')
<li>
  <div class="btn-group">
    <button id="rotate_reset" class="btn btn-info span2"><i class="icon-repeat icon-white"></i>Rotate</button>
    <button id="rotate_left" class="btn btn-primary span1">Left</button>
    <button id="rotate_right" class="btn btn-primary span1">Right</button>
  </div>
</li>
<li>
  <div class="btn-group">
    <button id="scale" class="btn btn-info span1" style="margin:auto auto auto 4px;"><i class="icon-zoom-in icon-white"></i>Scale</button>
    <button id="small" class="btn btn-primary span1">Small</button>
    <button id="big" class="btn btn-primary span1" style="margin:auto 4px auto auto;">Big</button>
  </div>
</li>
<li class="dropdown">
  <button href="#" class="dropdown-toggle btn" data-toggle="dropdown">On Sticker<span class="caret"></span></button>
  <ul class="dropdown-menu scrollable-menu" style="text-align: center;">
    <li><a class="image" value="d">D</a></li>
    <li><a class="image" value="e">E</a></li>
    <li><a class="image" value="m">M</a></li>
    <li><a class="image" value="o">O</a></li>
  </ul>
  <button id="delete" class="btn btn-warning">Delete</button>
  <button class="btn btn-success glyphicon glyphicon-camera" onclick="screenshot()">Take</button>
</li>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 video_box">
      <center>
        <h3>How to "Make Sticker Design"</h3>
        <iframe src="//player.vimeo.com/video/94033871?title=0&amp;byline=0&amp;portrait=0" width="550" height="308" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> <p><a href="http://vimeo.com/94033871">My-Mac-Mate_01_2014/05/06</a> from <a href="http://vimeo.com/user25159137">@motikan2010</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
      </center>
    </div>
    <div class="col-md-6 video_box">
      <center>
        <h3>How to "Add Sticker"</h3>
        <iframe src="//player.vimeo.com/video/94049360?title=0&amp;byline=0&amp;portrait=0" width="550" height="308" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> <p><a href="http://vimeo.com/94049360">My-Mac-Mate_02_2014/05/06</a> from <a href="http://vimeo.com/user25159137">@motikan2010</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
      </center>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div id="jquery-ui-draggable-wrap" class="row-fluid ui-widget-content" style="position:relative; border: inset 0px;">
          <img src="/images/base.jpg" class="img-responsive">
          <div class="ui-widget-content jquery-ui-draggable d" style="background-color:transparent; border:0px; position:absolute; top:20px; left:40px;"></div>
          <div class="ui-widget-content jquery-ui-draggable e" style="background-color:transparent; border:0px; position:absolute; top:50px; left:200px;"></div>
          <div class="ui-widget-content jquery-ui-draggable m" style="background-color:transparent; border:0px; position:absolute; top:70px; left:550px;"></div>
          <div class="ui-widget-content jquery-ui-draggable o" style="background-color:transparent; border:0px; position:absolute; top:150px; left:800px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- TakeView -->
<div class="remodal-bg"></div>
<div class="remodal" data-remodal-id="modal">
  <div id="output_screen">
    <img width="100%" height="100%" id="screen_image">
  </div>
  <hr/>
  <br>
  <button  data-remodal-action="cancel" onclick="erase_screenshot()" class="remodal-cancel">Cancel</button>
  <a id="download" class="remodal-confirm" href="#" download="demoImage.png">Loading...</a>
</div>

@endsection

@section('javascript')
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/html2canvas.js"></script>
<script src="/js/sticker.js"></script>
<script src="/js/remodal.js"></script>
@endsection

@section('sticker_css')
<link rel="stylesheet" href="/css/remodal.css">
<link rel="stylesheet" href="/css/remodal-default-theme.css">
<style type="text/css">
.d{
  width : 200px;
  height: 200px;
  background-image: url("/demo-stickers/d.png");
  background-repeat: no-repeat;
  -moz-background-size:cover;
  background-size:cover;
}

.e{
  width : 300px;
  height: 300px;
  background-image: url("/demo-stickers/e.png");
  background-repeat: no-repeat;
  -moz-background-size:cover;
  background-size:cover;
}

.m{
  width : 200px;
  height: 200px;
  background-image: url("/demo-stickers/m.png");
  background-repeat: no-repeat;
  -moz-background-size:cover;
  background-size:cover;
}

.o{
  width : 200px;
  height: 200px;
  background-image: url("/demo-stickers/o.png");
  background-repeat: no-repeat;
  -moz-background-size:cover;
  background-size:cover;
}
</style>
@endsection
