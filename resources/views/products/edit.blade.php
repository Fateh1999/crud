@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card mt-3 p-3">
                <h3>Product Edit #{{ $product->name }}</h3>
                <form method="POST" action="/products/{{$product->id}}/update" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="from-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name',$product->name) }}">
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}"></span>
                    @endif

                    <div class="from-group mt-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description',$product->description) }}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}"></span>
                    @endif

                    <div class="from-group mt-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                    </div>
                    @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}"></span>
                    @endif

                    <button type="submit" class="btn btn-dark mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
