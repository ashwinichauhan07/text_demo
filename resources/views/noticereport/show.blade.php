@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Notice List </i>
            </div>
            <div class="col-xl-12">
                <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Student Name</th>
                    <th>Notice</th>
                    <th>Profile Photo</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($custemNotification as $key => $notification_value)

                    <tr>
                        <td>{{ $key++ }}</td>
                        <!-- <td>{{ $notification_value->id }}</td> -->
                        <td>{{ $notification_value->subject }}</td>
                        <!-- <td>{{ $notification_value->notifiable_type }}</td> -->
                        <td>{{ $notification_value->name }}</td>
                        <td>{{ $notification_value->data }}</td>
                        <td>{{ $notification_value->read_at }}</td>
                        <td>{{ $notification_value->created_at }}</td>
                    </tr>
                    <form method="POST" action="{{ route('custemNotification.destroy',[ $notification_value->id ]) }}">
                        {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                        <span class="glyphicon glyphicon-trash"></span>
                            <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                    </form>
                </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <!-- <th>id</th> -->
                        <th>Type</th>
                        <!-- <th>notifiable_type</th> -->
                        <th>notifiable_id</th>
                        <th>data</th>
                        <th>read_at</th>
                        <th>created_at</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </tfoot>
            </table><br><br><
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"> Notice List </i>
                </div>
                <div class="col-xl-12">
                   <div class="card-body">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Send Notice</button>
                    <br><br>
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="upper_check" onclick="check()"></th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userData as $key => $user_value)
                        <tr>
                            <td><input type="checkbox" name="user_id" value="{{ $user_value->id }}" class="check"></td>
                            <td>{{ $key++ }}</td>
                            <td>{{ $user_value->name }}</td>
                            <td>{{ $user_value->email }}</td>
                            <!-- <td>{{ $user_value->userType }}</td> -->
                            <td>
                             @if($user_value->userType == 4)
                                Student
                            @elseif ($user_value->userType == 1)
                                SuperAdmin
                            @elseif ($user_value->userType == 2)
                                Institute
                            @elseif ($user_value->userType == 3)
                                Instructor    
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" class="check"></th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                        </tr>
                    </tfoot>
                </table>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Subject</span>
                      </div>
                      <input type="text" class="form-control" placeholder="subject" aria-label="subject" aria-describedby="basic-addon1" id="subject">
                    </div>
                    
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Message</span>
                      </div>
                      <input type="text" class="form-control" placeholder="message" aria-label="message" aria-describedby="basic-addon2" id="message">
                    </div>

                    <p class="font-weight-bold text-success text-center" style="display: none;" id="please">Please Wait...</p>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_notice_submit">Submit</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</main>


@endsection

@once
    @push('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
            

            // custem code for check box
            function check() {
                var upper_check = document.getElementById('upper_check');

                if (upper_check.checked) {
                    checkAll();
                } else {
                    uncheckAll();
                }

            }        

            function checkAll() {
               var checkbox = document.querySelectorAll(".check");
                 for (var i = 0; i < checkbox.length; i++) { 
                    checkbox[i].checked = true; 
                    }                 
            }

            function uncheckAll() {
               var checkbox = document.querySelectorAll(".check");
                 for (var i = 0; i < checkbox.length; i++) { 
                    checkbox[i].checked = false; 
                    }                 
            }


            document.getElementById("btn_notice_submit").onclick = ()=> {
                var checkbox = document.querySelectorAll(".check");
                var message = document.getElementById('message');
                var subject = document.getElementById('subject');
                var please = document.getElementById('please');
                please.style.display = "block";

                var id = [];
                for (var i = 0; i < checkbox.length; i++) { 
                    if (checkbox[i].checked) {
                        id.push(checkbox[i].value);
                    } 
                }

                let formData = new FormData();
                formData.append('message',message.value);
                formData.append('subject',subject.value);
                formData.append('user_id',id);

                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                     var myObj = JSON.parse(this.responseText);
                    // document.getElementById("demo").innerHTML = myObj.name;
                    $('#exampleModal').modal('hide');
                     location.reload(); 
                  }
                };
                xmlhttp.open("POST", "{{ route('custemNotification.store') }}", true);
                xmlhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementsByName("csrf-token")[0].content);
                xmlhttp.send(formData); 

            }

        </script>

        </script>
        
        
    @endpush
@endonce