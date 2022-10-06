@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Movie</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('m_update', $movie)}}" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="titleText" class="form-label">Title</label>
                            <input value="{{old('title', $movie->title)}}" name="title" type="text" class="form-control" id="titleText">
                        </div>
                        <div class="mb-3">
                            <label for="titleText" class="form-label">price</label>
                            <input value="{{old('price', $movie->price)}}" name="price" type="text" class="form-control" id="titleText">
                        </div>
                        <div class="mb-3 img-small-ch">
                            @forelse($movie->getPhotos as $photo)
                            <div class="img">
                                <div class="">
                                    <label class="label-custom" for="{{ $photo->id }}-del-photo"> X </label>
                                    <input class="mx-2" type="checkbox" value="{{ $photo }}" id="{{ $photo->id }}-del-photo" name="delete_photo[]">
                                    <img class="w-50 mb-3 mt-3" src="{{ $photo->url }}" alt="">
                                </div>
                            </div>
                            @empty
                            <h2>No Photos To Delete</h2>
                            @endforelse
                        </div>
                        <select name="category_id" class="form-select mb-3">
                            <option value="0">Choose category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == old('category_id', $movie->category_id)) selected @endif> {{ $category->title }}</option>
                            @endforeach
                        </select>
                        @csrf
                        @method('put')
                        @if(Auth::user()->role >= 10)
                        <button type="submit" class="btn btn-warning">Save</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
