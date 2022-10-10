@extends('layouts.app')

@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Movies</h2>
                
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($movies as $movie)
                        <li class="list-group-item">
                            <div class="trucks-list">
                                <div class="content">
                                    <h2><span>Title: </span>{{$movie->title}}</h2>
                                    <h4><span>Price: </span>{{$movie->price}}</h4>
                                    
                                    @if($movie->getPhotos()->count())
                                    <h5><a href="{{ $movie->lastImageUrl() }}" target="_BLANK">Photos: {{ $movie->getPhotos()->count() }}</a></h5>
                                    @endif
                                </div>
                                <div class="buttons d-flex justify-content-around me-4">
                                    <h5><span>Rating: </span>{{$movie->rating ?? 'unrated'}}</h2>
                                    <form action="{{ route('rate', $movie) }}" method="post">
                                        <select name="rate">
                                            @foreach(range(1, 10) as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-warning">Rate</button>
                                    </form>

                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No movie Found</li>
                        @endforelse
                    </ul>
                </div>
                <div class="me-4 mx-4">
                    {{ $movies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
