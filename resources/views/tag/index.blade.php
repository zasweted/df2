@extends('layouts.app')

@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Tags</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($tags as $tag)
                        <li class="list-group-item">
                            <div class="categories-list">
                                <div class="content">
                                    <h2>{{$tag->title}}</h2>
                                    <small>[{{ $tag->getPivot()->count() }}]</small>
                                    
                                </div>
                                <div class="buttons">
                                    <a href="{{route('t_show', $tag)}}" class="btn btn-info">Show</a>
                                    @if(Auth::user()->role >= 10)
                                    <a href="{{route('t_edit', $tag)}}" class="btn btn-success">Edit</a>
                                    <form action="{{route('t_delete', $tag)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No tags found</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection