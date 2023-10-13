@extends('layouts.admin')

@section('title', 'Create Typing Word Practices')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item active">Edit Typing Word Practices</li>
                        </ol>

                        <!-- Show Errors -->

                        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Show Message -->
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
                     

                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('typing_word_practices.update',[$typingWordPractices->id]) }}" method="POST">
                                          {{ csrf_field() }}
                                          @method('PATCH')

                                  <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="inputEmail4">Word Practices </label>
                                    <textarea id="instruction" name="wordpractice">{{ $typingWordPractices->wordpractice }}</textarea>
                                    <!-- if want show error in single  -->
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                  </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                  <button type="submit" class="btn btn-dark">update</button>
                                </div>
    

                                </form>

                            </div>
                        </div>

                    </div>
                </main>




@endsection

@once
    @push('scripts')

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    


    <script>
        $('#input').datetimepicker({
            uiLibrary: 'bootstrap4',
            modal: true,
            footer: true
        });

        $('#input1').datetimepicker({
            uiLibrary: 'bootstrap4',
            modal: true,
            footer: true
        });

        // CKEDITOR.replace( 'instruction' );
        ClassicEditor
            .create( document.querySelector( '#instruction' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>


    @endpush
@endonce
