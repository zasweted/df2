@extends('layouts.app')

@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Movie</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($movies as $movie)
                        <li class="list-group-item">
                            <div class="movies-list d-flex justify-content-between">
                                <div class="content d-flex flex-row">
                                    <h2><span>Title: </span>{{$movie->title}}</h2>
                                    <h4><span>Price: </span>{{$movie->price}}</h4>
                                    @if($movie->getPhotos()->count())
                                    <h5><a href="{{$movie->lastImageUrl()}}" target="_BLANK">Photos: {{$movie->getPhotos()->count()}}</a></h5>
                                    @endif
                                    @if($movie->getTags()->count())
                                        <div class="all-tags">
                                            @foreach($movie->getTags as $tag)
                                                <a href="{{ route('t_show', $tag) }}"><span>#{{ $tag->title }}</span></a>
                                            @endforeach
                                        </div> 
                                    @endif
                                </div>
                                <div class="buttons d-flex justify-center align-items-center ">
                                    <a href="{{route('m_show', $movie)}}" class="btn btn-info me-2">Show</a>
                                    @if(Auth::user()->role >= 10)
                                    <a href="{{route('m_edit', $movie)}}" class="btn btn-success me-2">Edit</a>
                                    <form action="{{route('m_delete', $movie)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No movies found</li>
                        @endforelse
                    </ul>
                </div>
                <div class="me-3 mx-3">
                    {{ $movies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
