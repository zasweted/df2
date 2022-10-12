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
                            @error('title')
                            <div class="error-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="titleText" class="form-label">Price</label>
                            <input value="{{old('price')}}" name="price" type="text" class="form-control" id="titleText">
                            @error('price')
                            <div class="error-red">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 tags-cloud">

                            @forelse($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" name="tag[]" type="checkbox" value="{{ $tag->id }}" id="_{{ $tag->id }}">
                                <label class="form-check-label" for="_{{ $tag->id }}">
                                    {{ $tag->title }}
                                </label>
                            </div>
                            @empty
                                <h3>No tags...</h3>
                            @endforelse

                        </div>


                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo[]" multiple class="form-control">
                            @error('photo[]')
                            <div class="error-red">{{ $message }}</div>
                            @enderror
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-warning">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
