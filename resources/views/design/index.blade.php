@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach($products as $product)
                        <img width="50%" height="50%" src="/products/{{ $product->file_name }}.png">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
