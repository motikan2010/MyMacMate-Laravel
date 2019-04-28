@extends('layouts.app')

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
  <div class="row">
    <div class="mx-auto">
      <div id="input-canvas" class=""></div>
    </div>
  </div>
</div>

<!-- 画像選択モーダル -->
<div class="remodal" data-remodal-id="select-sticker-modal">
  @foreach($stickers as $sticker)
    @if($loop->first || $loop->index % 3 == 0)
      <div class="row pb-1">
    @endif
        <div class="col-md-4">
          <button class="card" data-remodal-action="cancel" onclick="addSticker('/image/sticker/{{ $sticker->file_name }}.{{ $sticker->extension }}') ">
            <img class="card-img-top" src="/image/sticker/{{ $sticker->file_name }}.{{ $sticker->extension }}" alt="{{ $sticker->name }}">
            <div class="card-body p-2">
              <p class="card-title m-1">{{ $sticker->name }}</p>
            </div>
          </button>
        </div>
    @if($loop->last == 1 || $loop->index % 3 == 2)
      </div>
    @endif
  @endforeach
  <button data-remodal-action="cancel" class="remodal-cancel">Close</button>
</div>

<!-- 保存モーダル -->
<div class="remodal-bg"></div>
<div class="remodal" data-remodal-id="modal">
  <div id="output_screen">
    <img width="100%" height="100%" id="screen-image">
  </div>
  <button  data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
  <a id="download" class="remodal-confirm" href="#" download="mymacmate.png">Loading...</a>
  <button id="save-image" class="remodal-primary" >Save</button>
</div>
@endsection

@section('javascript')
  <script src="/js/konva.min.js"></script>
  <script src="/js/html2canvas.js"></script>
  <script src="/js/sticker.js"></script>
  <script src="/js/remodal.js"></script>
@endsection

@section('sticker_css')
<link rel="stylesheet" href="/css/remodal.css">
<link rel="stylesheet" href="/css/remodal-default-theme.css">
@endsection
