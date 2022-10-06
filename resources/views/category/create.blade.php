@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h2>New Category</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('c_store')}}" method="post">
                        <div class="mb-3">
                            <label for="titleText" class="form-label">Title</label>
                            <input value="{{old('title')}}" name="title" type="text" class="form-control" id="titleText">
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
