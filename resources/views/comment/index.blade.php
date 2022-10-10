@extends('layouts.app')

@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Comments</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($movies as $movie)
                        <li class="list-group-item">
                            <div>
                                <div class="content mt-4 mb-2">
                                    <h2>{{$movie->title}}
                                        <small>[{{$movie->getComments()->count()}}]</small>
                                    </h2>
                                </div>

                                <ul class="list-group">
                                    @forelse($movie->getComments as $comment)
                                    <li class="list-group-item">
                                       <div>{{$comment->post}}</div>


                                        <div class="buttons">
                                            @if(Auth::user()->role >= 10)
                                            <form action="{{route('c_delete', $comment)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger mt-4 mb-2">Delete</button>
                                            </form>
                                            @endif
                                        </div>

                                    </li>
                                    @empty
                                    <li class="list-group-item">No comments found</li>
                                    @endforelse
                                </ul>

                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No categories found</li>
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