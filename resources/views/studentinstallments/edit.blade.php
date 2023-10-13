@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')

    <main>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4 mt-4">
                <li class="breadcrumb-item active">Edit Student Installment Receipt</li>
                {{--  <a class="btn btn-dark" style="margin-left: 48em;"
                    href="{{ route('studentinstallments.show') }}">Back</a> </li>  --}}
                    <a class="btn btn-dark" style="margin-left: 48em;" onclick="history.back()">Back</a> </li>

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

                            <form action="{{ route('studentinstallments.update', $studentinstallment->id ) }}" method="POST"
                                onsubmit="setTimeout(function(){window.location.reload();},10);" target="_blank">
                                @csrf
                                @method('patch')

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
                                            placeholder="Enter Student User Name" id="student_name" value="{{ $studentinstallment->student->user->name }} {{ $studentinstallment->student->father_name }} {{ $studentinstallment->student->lastname }}" autocomplete="off">

                                        <input type="hidden" name="user_id" id="user_id">

                                        <input type="hidden" name="studentinstallment_id" id="studentinstallment_id" value="{{ $studentinstallment->id }}">

                                        <input type="hidden" name="student_id" id="student_id" value="{{ $studentinstallment->student_id }}">

                                        <input type="hidden" name="studentname" id="studentname" value="{{ $studentinstallment->student->user->name }}">



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
                                        {{--  <input type="text" name="installment_date" class="form-control"
                                            value="{{ $studentinstallment->installment_date }}" id="installment_date">  --}}

                                            <input type="date" name="installment_date" class="form-control" value="{{ $insatlldate }}">

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
                                            class="form-control" value="" id="cheque_no">
                                    </div>
                                    <div class="form-group col-md-4" id="chequedate">
                                        <label for="check_date">Cheque Date</label>
                                        <input type="date" name="check_date" class="form-control" value="" id="check_date">
                                    </div>

                                    <div class="form-group col-md-4" id="transaction_id">
                                        <label for="transaction_id">Transaction ID</label>
                                        <input type="text" name="transaction_id" placeholder="Enter transaction ID"
                                            class="form-control" value="" id="transactionid">
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
            var studentname = document.getElementById("studentname");

            var studentinstallment_id = document.getElementById("studentinstallment_id");




            {{--  student_name.onkeyup = () => {  --}}

                {{--  console.log(studentname.value);  --}}


                var formData = new FormData();
            var student_name = document.getElementById("student_name");
            formData.append('name', studentname.value);
                formData.append('student_id', student_id.value);
                formData.append('studentinstallment_id', studentinstallment_id.value);
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

                xhttp.open("POST", "{{ route('student.searchname') }}", true);
                xhttp.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').content);
                xhttp.send(formData);

            {{--  }  --}}
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

                console.log(response);


                {{--  response.forEach(function(item, index) {  --}}

                    var name = document.createElement('div');
                    name.className = 'row vv';

                    var column = document.createElement('div');
                    column.className = 'col-2';

                    var img = document.createElement('img');
                    img.className = 'm-2';
                    img.src = "{{ asset('public/images') }}/" + response.student.student_img;
                    img.style.borderRadius = '50%';
                    img.style.width = '40px';

                    column.appendChild(img);
                    name.appendChild(column);

                    var para = document.createElement('p');
                    para.className = 'mt-2';

                    para.innerHTML = response.name + ' ' + response.student.father_name + ' ' + response.student.lastname;
                    name.appendChild(para);
                    result.appendChild(name);

                    {{--  name.onclick = () => {  --}}

                        student_name.value = response.name + ' ' + response.student.father_name + ' ' + response.student
                            .lastname;

                        var fees = document.getElementById("fees");
                        fees.innerHTML = response.fess;
                        var paid = document.getElementById("paid");
                        paid.innerHTML = response.paid_fess;
                        var unpaid = document.getElementById("unpaid");
                        unpaid.innerHTML = response.unpaid_fess;
                        var subject_id = document.getElementById("subject_id");
                        console.log(response.subject_data);
                        subject_id.value = response.subject_data;
                        var course_id = document.getElementById("course_id");
                        course_id.value = response.course_data;
                        var amount_due = document.getElementById("amount_due");
                        amount_due.value = response.unpaid_fess;
                        var user_id = document.getElementById("user_id");
                        user_id.value =
                            response.id;

                            amount_paid.value = response.studentinstallmentsData.amount;

                            amount_bal.value = response.unpaid_fess;

                            var nextdate = document.getElementById("nextdate")
                            nextdate.value = response.next_installmentdate

                            payment_mode.value = response.payemnt_mode;

                            var cheque_no = document.getElementById("cheque_no");
                            cheque_no.value = response.studentinstallmentsData.check_number

                            var check_date = document.getElementById("check_date");
                            check_date.value = response.studentinstallmentsData.check_date

                            var transactionid = document.getElementById("transactionid");
                            transactionid.value = response.studentinstallmentsData.transaction_id


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


                            {{--  alert(response.next_installmentdate);  --}}


                        name.style.display = "none";

                    {{--  }  --}}

                {{--  });  --}}







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
