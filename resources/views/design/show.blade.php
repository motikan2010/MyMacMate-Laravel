@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div id="jquery-ui-draggable-wrap" class="row-fluid ui-widget-content" style="position:relative; border: inset 0px;">
                    @foreach($designs as $design)
                    <div class="{{ $design->sticker->file_name }}" style="background-color:transparent; border:0px; position:absolute; top:{{ $design->img_top }}px; left:{{ $design->img_left }}px; height:{{ $design->img_height }}px; width:{{ $design->img_width }}px;  -webkit-transform:{{ $design->transform }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
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
