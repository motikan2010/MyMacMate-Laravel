@extends('layouts.app')

@section('create_navbar')
  <li class="dropdown">
    <button class="btn btn-info" onclick="selectSticker()">Select Image</button>
    <button class="btn btn-warning" onclick="deleteSticker()">Delete</button>
    <button class="btn btn-success" onclick="confirmSaveImage()">Save</button>
    <button class="btn btn-danger" onclick="resetSticker()">Reset</button>
  </li>
@endsection

@section('create_navbar')
  <li class="dropdown">
    <button class="btn btn-info" onclick="selectSticker()">Select Image</button>
    <button class="btn btn-warning" onclick="deleteSticker()">Delete</button>
    <button class="btn btn-success" onclick="confirmSaveImage()">Save</button>
    <button class="btn btn-danger" onclick="resetSticker()">Reset</button>
  </li>
@endsection

@section('content')
<div class="container">
  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Tutorial Movie</h5>
      <div class="row p-3">
        <div class="col-md-6">
          <h5>1. Make Sticker Design</h5>
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="//player.vimeo.com/video/94033871?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
          </div>
          <p><a href="http://vimeo.com/94033871">My-Mac-Mate_01_2014/05/06</a> from <a href="http://vimeo.com/user25159137">@motikan2010</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
        </div>
        <div class="col-md-6">
          <h5>2. Add Sticker</h5>
          <div  class="embed-responsive embed-responsive-16by9">
            <iframe src="//player.vimeo.com/video/94049360?title=0&amp;byline=0&amp;portrait=0" width="100%" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
          </div>
          <p><a href="http://vimeo.com/94049360">My-Mac-Mate_02_2014/05/06</a> from <a href="http://vimeo.com/user25159137">@motikan2010</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
        </div>
      </div>
    </div>
    <div class="card mt-2">
      <h5 class="card-header">Demo</h5>
      <div class="row">
        <div class="mx-auto center-block">
          <div id="input-canvas" class="center-block"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 画像選択モーダル -->
<div class="remodal" data-remodal-id="select-sticker-modal">
  <div class="row pb-1">
    @foreach($stickers as $sticker)
    <div class="col-md-3">
      <button class="card" data-remodal-action="cancel" onclick="addSticker('/image/demo_sticker/{{ $sticker[0] }}.png')">
        <img class="card-img-top" src="/image/demo_sticker/{{ $sticker[0] }}.png" alt="Demo {{ $sticker[1] }}">
        <div class="card-body p-2">
          <p class="card-title m-1">{{ $sticker[1] }}</p>
        </div>
      </button>
    </div>
    @endforeach
  </div>
  <button data-remodal-action="cancel" class="remodal-cancel">Close</button>
</div>

<!-- 保存モーダル -->
<div class="remodal-bg"></div>
<div class="remodal" data-remodal-id="modal">
  <div id="output_screen">
    <img width="100%" height="100%" id="screen-image" />
  </div>
  <button  data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
  <a id="download" class="remodal-confirm" href="#" download="mymacmate.png">Loading...</a>
  <button class="remodal-primary" onclick="demoSave()">Save</button>
</div>
@endsection

@section('javascript')
  <script src="/js/konva.min.js"></script>
  <script src="/js/html2canvas.js"></script>
  <script src="/js/sticker.js"></script>
  <script src="/js/remodal.js"></script>
  <script src="/js/demo-page.js"></script>
@endsection

@section('sticker_css')
<link rel="stylesheet" href="/css/remodal.css">
<link rel="stylesheet" href="/css/remodal-default-theme.css">
@endsection
