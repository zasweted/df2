@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h2>New Movie</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('m_store')}}" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titleText" class="form-label">Title</label>
                            <input value="{{old('title')}}" name="title" type="text" class="form-control" id="titleText">
                        </div>
                        <div class="mb-3">
                            <label for="titleText" class="form-label">Price</label>
                            <input value="{{old('price')}}" name="price" type="text" class="form-control" id="titleText">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Price</label>
                            <input type="file" name="photo[]" multiple class="form-control">
                        </div>
                        
                        <select name="category_id" class="form-select mb-3">
                            <option value="0">Choose Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"@if($category->id == old('category_id')) selected @endif > {{ $category->title }}</option>
                            @endforeach
                        </select>
                        @csrf
                        <button type="submit" class="btn btn-warning">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
