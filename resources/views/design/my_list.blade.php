@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-12">
      <div class="panel panel-default">
        @foreach($products as $product)
          @if( $loop->first || $loop->index % 3 == 0 )
            <div class="row">
              @endif
              <div class="col-md-4">
                <img width="100%" src="/image/product/{{ $product->file_name }}.png">
                <span>{{ $product->created_at->format('Y-m-d') }}</span>
              </div>
              @if($loop->last || $loop->index % 3 == 2)
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
@endsection
