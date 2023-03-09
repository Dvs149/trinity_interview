@extends('notes.layout.app')
@section('content')
    <div class="">
        <div class="serch-input m-5">
            <form action="{{ route('notes.store') }}" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="user_id" name="id" value="{{$note->id}}">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="exampleFormControlInput1"
                        placeholder="Title" value="{{$note->title}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$note->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                </div>
                <img src="{{$note->image_url}}" alt="{{$note->image}}">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </div>
            </form>
        </div>
        {{-- <div class="d-flex flex-wrap card-list mx-5 my-5">
            @foreach ($notes as $note)
                <div class="card m-2" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> {{ $note->title }} </h5>
                        <p class="card-text"> {{ $note->description }} </p>
                        <a href="{{route('notes.edit',$note->id)}}" id="{{ $note->id }}" class="btn btn-primary edit">Edit</a>
                        <a href="JavaScript:void(0);" class="btn btn-primary">Pin</a>
                    </div>
                </div>
            @endforeach
        </div> --}}
    </div>
@endsection