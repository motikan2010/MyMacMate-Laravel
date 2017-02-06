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
    @foreach($stickers as $sticker)
    <li><a class="image" value="{{ $sticker->file_name }}">{{ $sticker->name }}</a></li>
    @endforeach
    </ul>
    <button id="save" class="btn btn-success span1">Save</button>
</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div id="jquery-ui-draggable-wrap" class="row-fluid ui-widget-content" style="position:relative; border: inset 0px;">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/sticker.js"></script>
@endsection

@section('sticker_css')
<style type="text/css">
@foreach($stickers as $sticker)
/* {{ $sticker->name }} */
.{{ $sticker->file_name }}{
    width : {{ $sticker->width }}px;
    height: {{ $sticker->height }}px;
    background-image: url("/stickers/{{ $sticker->file_name }}.{{ $sticker->extension }}");
    background-repeat: no-repeat;
    -moz-background-size:cover;
    background-size:cover;
}
@endforeach
</style>
@endsection




