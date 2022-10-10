@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Movie</h2>
                </div>
                <div class="card-body">
                    <div class="movie-show">
                        <div class="line"><small>Title: </small></div>
                        <h5>{{$movie->title}}</h5>
                    </div>
                    <div class="line"><small>Price: </small>
                        <h5>{{$movie->price}}</h5>
                    </div>
                    @forelse($movie->getPhotos as $photo)
                    <div class="img mt-4 mb-4">
                        <img class="w-50" src="{{ $photo->url }}" alt="img">
                    </div>
                    @empty
                    <h2>No photos...</h2>
                    @endforelse
                    {{-- <div class="img">
                        @if($movie->photo)
                        <img class="w-100" src="{{ $movie->photo }}" alt="img">

                    @endif
                </div> --}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
