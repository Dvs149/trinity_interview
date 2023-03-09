@extends('notes.layout.app')
@section('content')
    <div class="">
        <div class="serch-input m-5">
            <form action="{{ route('notes.store') }}" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="user_id" name="id" value="">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="exampleFormControlInput1"
                        placeholder="Title">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </div>
            </form>
        </div>
        <div class="d-flex flex-wrap card-list mx-5 my-5">
            @foreach ($notes as $note)
                <div class="card m-2" style="width: 18rem;">
                    <img src="{{ $note->image_url }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> {{ $note->title }} </h5>
                        <p class="card-text"> {{ $note->description }} </p>
                        <a href="{{ route('notes.edit', $note->id) }}" id="{{ $note->id }}"
                            class="btn btn-primary edit">Edit</a>
                        @if (!$note->is_pin)
                            <a href="JavaScript:void(0);" id="{{ $note->id }}" class="btn btn-primary pin">Pin</a>
                        @else
                            <a href="JavaScript:void(0);" id="{{ $note->id }}" class="btn btn-danger unpin">Un Pin</a>
                        @endif
                        <a href="JavaScript:void(0);" id="{{ $note->id }}" class="btn btn-danger delete">delete</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script>
        function myFunction() {
            let text = "Press a button!\nEither OK or Cancel.";
            if (confirm(text) == true) {
                text = "You pressed OK!";
            } else {
                text = "You canceled!";
            }
            document.getElementById("demo").innerHTML = text;
        }

        $(".pin").click(function() {
            var edit_id = $(this).attr("id")
            var pin_url = "{{ url('notes/pin') }}/" + edit_id;
            let text = "Press a OK to pin!\nPress Cancel to discard change.";
            if (confirm(text) == true) {
                text = "You pressed OK!";
                $.ajax({
                url: pin_url,
                success: function(result) {
                    alert('note pin to top');
                    location.reload();
                }
            });
            } else {
                text = "You canceled!";
            }
            // document.getElementById("demo").innerHTML = text;
        });


        $(".unpin").click(function() {
            var edit_id = $(this).attr("id")
            var pin_url = "{{ url('notes/unpin') }}/" + edit_id;
            let text = "Press a OK to unpin!\nPress Cancel to discard change.";
            if (confirm(text) == true) {
                text = "You pressed OK!";
                $.ajax({
                url: pin_url,
                success: function(result) {
                    alert('note un pin');
                    location.reload();
                }
            });
            } else {
                text = "You canceled!";
            }
            
        });

        $(".delete").click(function() {
            var edit_id = $(this).attr("id")
            var pin_url = "{{ url('notes/delete') }}/" + edit_id;
            let text = "Press a OK to Delete the note!\nPress Cancel to discard change.";
            if (confirm(text) == true) {
                text = "You pressed OK!";
                $.ajax({
                url: pin_url,
                success: function(result) {
                    alert('note deleted');
                    location.reload();
                }
            });
            } else {
                text = "You canceled!";
            }
            // document.getElementById("demo").innerHTML = text;
        });

        $('#form').validate({ // initialize the plugin
            errorElement: "span",
            rules: {
                title: {
                    required: true,
                },
                description: {
                    required: true,
                },
                image: {
                    required: false,
                    // minImageWidth: 720,
                    // minImageHeight: 1200,
                },

            },
        });
    </script>
@endsection
