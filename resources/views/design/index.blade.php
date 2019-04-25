@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">
        <a class="btn btn-primary" href="/design/create">Create</a>
      </div>
      @foreach($products as $product)
        @if($loop->index == 0 || $loop->index % 2 == 0)
          <div class="row">
        @endif
            <div class="col-md-6" style="padding: 20px;">
              <img width="100%" src="/products/{{ $product->file_name }}.png">
              <h4>{{ $product->created_at->format('Y-m-d') }}</h4>
            </div>
        @if($loop->index == 1 || $loop->index % 2 == 1)
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection
