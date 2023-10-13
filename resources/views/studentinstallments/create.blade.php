@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4 mt-4">
                <li class="breadcrumb-item active">Student Installment Receipt</li>
                <a class="btn btn-dark" style="margin-left: 48em;"
                    href="{{ route('studentinstallments.index') }}">Back</a> </li>
            </ol>
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong>There were some problems with your input. <br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!--  <form action="{{ route('student.details') }}" method="POST">
          @csrf

                                <div class="form-group col-md-6">
                                   <label for="student_type">Student Type</label>
                                   <select id="student_type" class="form-control" name="student_type">
                                    <option value="" name="student_type" >Choose Student Type...</option>
    @foreach ($studentType as $key => $studentType_value)
    <option value="{{ $studentType_value->id }}">
                                     {{ $studentType_value->name }}
                                    </option>
    @endforeach
                                </select>


                                </div> -->

                            <form action="{{ route('studentinstallments.store') }}" method="POST"
                                onsubmit="setTimeout(function(){window.location.reload();},10);" target="_blank">
                                @csrf

                                <div class="row">
                                    <!-- <div class="form-group col-md-4">
          <label for="receipt_no">Receipt Number</label>
           <input type="text" name="receipt_no" class="form-control" value="{{ old('receipt_no') }}">
          </div>
          <div class="form-group col-md-4">
          <label for="date">Date</label>
           <input type="date" name="date" class="form-control">
          </div>
          <div class="form-group col-md-4">
          <label for="date">Student Type</label>
           <select id="student" class="form-control" name="sub30wpm">
         <option selected>Choose...</option>
         <option value="regular">Regular</option>
         <option value="repeater">Repeater</option>
         <option value="reappear">Reappear</option>
         </select>
          </div> -->

                                    <!--  <div class="form-group col-md-6">
         <label for="student_type">Student Type</label>
         <select id="student_type" class="form-control" name="student_type">
         <option value="" name="student_type" >Choose Student Type...</option>
                        @foreach ($studentType as $key => $studentType_value)
    <option value="{{ $studentType_value->id }}">
                                     {{ $studentType_value->name }}
                                            </option>
    @endforeach
                                        </select>


                                        </div> -->

                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Student User Name" id="student_name" autocomplete="off">

                                        <input type="hidden" name="user_id" id="user_id">

                                        <input type="hidden" name="student_id" id="student_id">



                                        <div id="resultData" class="card">
                                            <!-- <div class="row">
                                                    <div class="col-2">
                                                        <img src="" style="border-radius: 50%;" width="30" class="m-2" id="resultImage">
                                                    </div>
                                                    <p class="mt-2" id="resultName"></p>
                                                </div> -->

                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="installment_date">Installment Date</label>
                                        <input type="date" name="installment_date" class="form-control"
                                            value="{{ date('Y-m-d') }}" id="installment_date">
                                    </div>


                                    <!--  <div class="form-group col-md-6 mt-8">
                                                <button type="search" class="btn btn-dark">Search</button>
                                         </div> -->


                                </div>
                                <br>
                                <h3 class="text-center" style="background-color: grey; height: 30px;"><b> Occupied
                                        Courses </b></h3><br>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <p style="width: 30%;" class="text-danger">Total Fees : <strong
                                                    id="fees"></strong></p>
                                            <p style="width: 30%;" class="text-danger">Paid Fees : <strong
                                                    id="paid"></strong></p>
                                            <p style="width: 30%;" class="text-danger">UnPaid Fees : <strong
                                                    id="unpaid"></strong></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="course_id">Course</label>
                                        <input type="text" name="course_id" id="course_id" class="form-control" value=""
                                            disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="subject_id">Subject</label>
                                        <input type="text" name="subject_id" id="subject_id" class="form-control" value=""
                                            style="height: 100px;" disabled>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="amount_due">Total Amount Due</label>
                                        <input type="number" name="amount_due" id="amount_due" class="form-control"
                                            value="" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="amount_paid">Amount Paid</label>
                                        <input type="number" name="amount_paid" placeholder="Enter Paid amount"
                                            class="form-control" value="" id="amount_paid">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="amount_bal">Amount Balance</label>
                                        <input type="number" name="amount_bal" class="form-control" value=""
                                            id="amount_bal">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="payment_mode">Payment Mode</label>
                                        <select name="payment_mode" class="form-control" id="payment_mode">
                                            {{-- <option selected>Choose Payment mode</option> --}}
                                            <option value="1" selected>Cash</option>
                                            <option value="2">Cheque</option>

                                            <option value="3">Online</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="chequeno">
                                        <label for="cheque_no">Cheque Number</label>
                                        <input type="number" name="cheque_no" placeholder="Enter cheque no"
                                            class="form-control" value="">
                                    </div>
                                    <div class="form-group col-md-4" id="chequedate">
                                        <label for="check_date">Cheque Date</label>
                                        <input type="date" name="check_date" class="form-control" value="">
                                    </div>

                                    <div class="form-group col-md-4" id="transaction_id">
                                        <label for="transaction_id">Transaction ID</label>
                                        <input type="text" name="transaction_id" placeholder="Enter transaction ID"
                                            class="form-control" value="">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="next_installmentdate">Next Month Installment Date</label>
                                        <input type="date" name="next_installmentdate" class="form-control" value=""
                                            id="nextdate">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-dark" id="takeamount">Take Amount</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection

@once
    @push('scripts')
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="{{ url('public/js/scripts.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var student_name = document.getElementById("student_name");
            student_name.onkeyup = () => {

                var formData = new FormData();
                formData.append('name', student_name.value);
                formData.append('student_id', student_id.value);
                var response = "";

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        response = JSON.parse(this.responseText);
                        if (response.status) {

                            myFunction(response.data);

                        }
                    }
                }

                xhttp.open("POST", "{{ route('student.details') }}", true);
                xhttp.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').content);
                xhttp.send(formData);

            }
            // code for calculate fees
            var amount_paid = document.getElementById("amount_paid");
            amount_paid.addEventListener('keyup', function() {

                var unpaid = document.getElementById("unpaid");
                if (amount_paid.value && unpaid.innerHTML != 0) {
                    var amount_bal = document.getElementById("amount_bal");
                    amount_bal.value = unpaid.innerHTML - amount_paid.value;
                }
            });

            amount_paid.onkeyup = () => {

                if (amount_bal.value == 0) {

                    document.getElementById("nextdate").required = false;
                }


            }

            function myFunction(response) {

                var result = document.getElementById("resultData");
                result.innerHTML = "";

                response.forEach(function(item, index) {

                    var name = document.createElement('div');
                    name.className = 'row vv';

                    var column = document.createElement('div');
                    column.className = 'col-2';

                    var img = document.createElement('img');
                    img.className = 'm-2';
                    img.src = "{{ asset('public/images') }}/" + item.student.student_img;
                    img.style.borderRadius = '50%';
                    img.style.width = '4    0px';

                    column.appendChild(img);
                    name.appendChild(column);

                    var para = document.createElement('p');
                    para.className = 'mt-2';

                    para.innerHTML = item.name + ' ' + item.student.father_name + ' ' + item.student.lastname;
                    name.appendChild(para);
                    result.appendChild(name);

                    name.onclick = () => {

                        student_name.value = item.name + ' ' + item.student.father_name + ' ' + item.student
                            .lastname;
                        var fees = document.getElementById("fees");
                        fees.innerHTML = item.fess;
                        var paid = document.getElementById("paid");
                        paid.innerHTML = item.paid_fess;
                        var unpaid = document.getElementById("unpaid");
                        unpaid.innerHTML = item.unpaid_fess;
                        var subject_id = document.getElementById("subject_id");
                        console.log(item.subject_data);
                        subject_id.value = item.subject_data;
                        var course_id = document.getElementById("course_id");
                        course_id.value = item.course_data;
                        var amount_due = document.getElementById("amount_due");
                        amount_due.value = item.unpaid_fess;
                        var user_id = document.getElementById("user_id");
                        user_id.value =
                            item.id;

                        name.style.display = "none";

                    }

                });







                // resultData.onclick = ()=> {
                //       			var course_id = document.getElementById("course_id");
                //       			course_id.value = response.data.course_data;
                //       			var subject_id = document.getElementById("subject_id");
                //       			subject_id.value = response.data.subject_data;
                //
                //       			var fees = document.getElementById("fees");
                //       				fees.innerHTML = response.data.fess;
                //       			var paid = document.getElementById("paid");
                //       				paid.innerHTML = response.data.paid_fess;
                //       			var unpaid = document.getElementById("unpaid");
                //       				unpaid.innerHTML = response.data.unpaid_fess;
                //       			var user_id = document.getElementById("user_id");
                //       				user_id.value = response.data.id;
                //       			var student_id = document.getElementById("student_id");
                //       				student_id.value = response.data.student_id;
                //       			student_name.value = response.data.name + ' ' +response.data.student.father_name + ' ' +response.data.student.lastname;

                //       			resultData.style.display = "none";
                //       		}

            }

            var payment_mode = document.getElementById("payment_mode");
            var chequeno = document.getElementById("chequeno");
            var chequedate = document.getElementById("chequedate");
            var transaction_id = document.getElementById("transaction_id")

            chequeno.style.display = "none";
            chequedate.style.display = "none";
            transaction_id.style.display = "none";



            payment_mode.onchange = () => {

                if (payment_mode.value == 1) {

                    chequeno.style.display = "none";
                    chequedate.style.display = "none";
                    transaction_id.style.display = "none";


                } else if (payment_mode.value == 2) {
                    chequeno.style.display = "block";
                    chequedate.style.display = "block";
                    transaction_id.style.display = "none";

                } else if (payment_mode.value == 3) {

                    chequeno.style.display = "none";
                    chequedate.style.display = "none";
                    transaction_id.style.display = "block";

                }



            }
        </script>
    @endpush
@endonce
