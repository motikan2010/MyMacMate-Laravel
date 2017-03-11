@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-primary" href="{{ url('/design/create') }}">Create</a>
            </div>
            <?php $i = 0; ?>
            @foreach($products as $product)
            @if($i == 0 || $i % 2 == 0)
            <div class="row">
            @endif
                <div class="col-md-6" style="padding: 20px;">
                    <img width="100%" src="/products/{{ $product->file_name }}.png">
                    <p>{{ $product->created_at->format('Y年m月d日') }}</p>
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
