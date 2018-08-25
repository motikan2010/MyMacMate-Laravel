@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create Sticker</div>
                <div class="panel-body">
                    <form action="/stickers" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="name" class="form-control" id="Name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="ImageFile">Image</label>
                            <input type="file" name="image_file" id="ImageFile">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Sticker</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
