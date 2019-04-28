@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-12">
      @foreach( $products as $product )
        @if($loop->first || $loop->index % 3 == 0)
          <div class="row pb-3">
        @endif
            <div class="col-md-4">
              <div class="card">
                <img class="card-img-top p-2" src="/image/product/{{ $product->file_name }}.png">
                <div class="card-body p-2">
                  <button id="public-change-btn-{{ $loop->index }}" class="btn {{ ($product->private_flag) ? 'btn-warning' : 'btn-info' }} public-change-btn"
                          value="{{ $loop->index }}">{{ ($product->private_flag) ? 'Private' : 'Public' }}</button>
                  <span class="card-title m-1">{{ $product->created_at->format('Y-m-d') }}</span>
                </div>
              </div>
              <input class="product-id-{{ $loop->index }}" type="hidden" value="{{ $product->id }}"/>
            </div>
        @if($loop->last == 1 || $loop->index % 3 == 2)
          </div>
        @endif
      @endforeach
    </div>
  </div>
@endsection

@section('javascript')
  <script src="/js/my-list.js"></script>
@endsection
