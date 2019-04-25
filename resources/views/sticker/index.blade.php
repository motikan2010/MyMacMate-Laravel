@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">
        <a class="btn btn-primary" href="{{ url('/sticker/create') }}">Upload Sticker</a>
      </div>
        <?php $i = 0; ?>
      @foreach($stickers as $sticker)
        @if($i == 0 || $i % 2 == 0)
          <div class="row">
        @endif
            <div class="col-md-6" style="padding: 20px;">
              <img width="70%" src="/stickers/{{ $sticker->file_name }}.{{ $sticker->extension }}">
              <div class="row" style="padding: 10px;">
                <div class="col-md-6">
                  <h4>{{ $sticker->created_at->format('Y-m-d') }}</h4>
                </div>
                <div class="col-md-6">
                  <!-- Delete -->
                  <form action="{{ route('sticker.destroy', $sticker->id) }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete Image?');">Delete</button>
                    {{ csrf_field() }}
                  </form>
                </div>
              </div>
            </div>
            @if($i == 1 || $i % 2 == 1)
          </div>
            @endif
            <?php $i++; ?>
      @endforeach
    </div>
  </div>
</div>
@endsection
