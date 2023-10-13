@extends('layouts.admin')

@section('title', 'typing practises')

@section('sidebar')

    @parent

@endsection

@section('content')

 <main>
    <div class="container-fluid"><br><br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"> Typing Practices </i>
                    <a href="{{ route('typingPractise.create') }}" class="btn btn-dark float-right">Add Typing Practices</a>
{{--                <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('deleteAll') }}">Delete All Selected</button>--}}
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
                        <th>Sr.no</th>
                        <th>Subject</th>
                        <th>Practise Type</th>
                        <th>created_at</th>
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($typingPractise as $key => $typingPractise_value)
                            <tr>
                                <td>{{ ++$key }}</td>
                            <td>{{ $typingPractise_value->subject->name }}</td>
                            <td>{{ $typingPractise_value->practise->name }}</td>
                            <td>{{ $typingPractise_value->created_at }}</td>
                            <td>{{ $typingPractise_value->typingdata }}</td>
                           <td>
                             <form method="POST" action="{{ route('typingPractise.destroy',[ $typingPractise_value->id ]) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <span class="glyphicon glyphicon-trash"></span>
                                 <button type="submit" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                         </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sr.No</th>
                        <th>Subject</th>
                        <th>Practise Type</th>
                        <th>created_at</th>
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@once
    @push('scripts')
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>
{{--      <script type="text/javascript">--}}
{{--          $(document).ready(function () {--}}


{{--              $('#master').on('click', function(e) {--}}
{{--                  if($(this).is(':checked',true))--}}
{{--                  {--}}
{{--                      $(".sub_chk").prop('checked', true);--}}
{{--                  } else {--}}
{{--                      $(".sub_chk").prop('checked',false);--}}
{{--                  }--}}
{{--              });--}}


{{--              $('.delete_all').on('click', function(e) {--}}


{{--                  var allVals = [];--}}
{{--                  $(".sub_chk:checked").each(function() {--}}
{{--                      allVals.push($(this).attr('data-id'));--}}
{{--                  });--}}


{{--                  if(allVals.length <=0)--}}
{{--                  {--}}
{{--                      alert("Please select row.");--}}
{{--                  }  else {--}}


{{--                      var check = confirm("Are you sure you want to delete this row?");--}}
{{--                      if(check == true){--}}


{{--                          var join_selected_values = allVals.join(",");--}}


{{--                          $.ajax({--}}
{{--                              url: $(this).data('url'),--}}
{{--                              type: 'DELETE',--}}
{{--                              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
{{--                              data: 'ids='+join_selected_values,--}}
{{--                              success: function (data) {--}}
{{--                                  if (data['success']) {--}}
{{--                                      $(".sub_chk:checked").each(function() {--}}
{{--                                          $(this).parents("tr").remove();--}}
{{--                                      });--}}
{{--                                      alert(data['success']);--}}
{{--                                  } else if (data['error']) {--}}
{{--                                      alert(data['error']);--}}
{{--                                  } else {--}}
{{--                                      alert('Whoops Something went wrong!!');--}}
{{--                                  }--}}
{{--                              },--}}
{{--                              error: function (data) {--}}
{{--                                  alert(data.responseText);--}}
{{--                              }--}}
{{--                          });--}}


{{--                          $.each(allVals, function( index, value ) {--}}
{{--                              $('table tr').filter("[data-row-id='" + value + "']").remove();--}}
{{--                          });--}}
{{--                      }--}}
{{--                  }--}}
{{--              });--}}


{{--              $('[data-toggle=confirmation]').confirmation({--}}
{{--                  rootSelector: '[data-toggle=confirmation]',--}}
{{--                  onConfirm: function (event, element) {--}}
{{--                      element.trigger('confirm');--}}
{{--                  }--}}
{{--              });--}}


{{--              $(document).on('confirm', function (e) {--}}
{{--                  var ele = e.target;--}}
{{--                  e.preventDefault();--}}


{{--                  $.ajax({--}}
{{--                      url: ele.href,--}}
{{--                      type: 'DELETE',--}}
{{--                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
{{--                      success: function (data) {--}}
{{--                          if (data['success']) {--}}
{{--                              $("#" + data['tr']).slideUp("slow");--}}
{{--                              alert(data['success']);--}}
{{--                          } else if (data['error']) {--}}
{{--                              alert(data['error']);--}}
{{--                          } else {--}}
{{--                              alert('Whoops Something went wrong!!');--}}
{{--                          }--}}
{{--                      },--}}
{{--                      error: function (data) {--}}
{{--                          alert(data.responseText);--}}
{{--                      }--}}
{{--                  });--}}


{{--                  return false;--}}
{{--              });--}}
{{--          });--}}
{{--      </script>--}}
    @endpush
@endonce
