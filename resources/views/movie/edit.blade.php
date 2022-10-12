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
                        <div class="mb-3 tags-cloud">

                            @forelse($tags as $tag)
                            <div class="form-check">
                                <input @if(in_array($tag->id, $checkedTags)) checked @endif class="form-check-input" name="tag[]" type="checkbox" value="{{ $tag->id }}" id="_{{ $tag->id }}">
                                <label class="form-check-label" for="_{{ $tag->id }}">
                                    {{ $tag->title }}
                                </label>
                            </div>
                            @empty
                            <h3>No tags...</h3>
                            @endforelse

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
