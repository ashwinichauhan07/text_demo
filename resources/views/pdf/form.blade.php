
< !DOCTYPE html >
    <html>
        <head>
            <title>Student Admission Form</title>
            <style>

                .border
                {
                    outline - style: solid;
                outline-color: black;
                padding:50px;
      /*padding-left: 8em;*/
     }
                /* .form{

                    background - color: blue;
                width: 100%;
                height: 30px;
                color: #ffffff;
                font-weight: 600;
                border-radius: 10px;
                text-align: center;
                font-size: 25px;
    } */

            </style>
        </head>
        <body>

            <div class="border" style="width: 100%;">

                <div style="display: inline-block; float: right;  width: 10%;" >
                    <img src="{{asset('public/adminlogo')}}/{{ $data['inst_logo'] }}" style="width: 80px; height: 80px;">
                </div>
                <div style="display: inline-block; width: 80%; float: right;">
                    <h1 style="text-align: center; font-size: 25px; padding-left: 0.7em;">{{ auth()-> user() -> name}}</h1>
                    <br>
                    <h3 style="color: red; font-size: 20px;text-align: center;">  {{ $data['add'] }}</h3>
                </div>
                <div style="display: inline-block;  width: 10%;float: right; " >
                    <img src="{{asset('public/adminlogo')}}/{{ $data['inst_logo'] }}" style="width: 80px; height: 80px; ">
                </div>

                <div style="margin-top: 7em; border-radius: 10px; width: 100%;" >
                    <h4 style="text-align: center; font-size: 25px; width: 100%">Admission Form</h4>
                </div>
                <hr>
                    <div style=" margin-top: 15%;">
                        <div style="display: inline-block; width: 50%;" >
                            <label>Sr No : </label>
                            <label><b>{{ $data-> id}}</b></label>
                        </div>
                        <div style="display: inline-block;" >
                            <label>Gr No : </label>
                            <label>
                                <b>120</b>
                            </label>
                        </div>
                    </div>
                    <hr>

                        <div style=" margin-top: 5%;">

                            <div class="form-group col-md-2">
                                <div style="display: inline-block; width: 50%;" >
                                    <label>First Name : </label>
                                    <label><b>{{ $data['name'] }}</b></label>
                                </div>
                                <div style="display: inline-block;" >
                                    <label>Last Name : </label>
                                    <label>
                                        <b>{{ $data-> lastname}}</b>
                                    </label>
                                </div>
                            </div>
                            <br>
                                <div style=" margin-top: 2%;">
                                    <div class="form-group col-md-2">

                                        <div style="display: inline-block; width: 50%;" >
                                            <label>Father Name : </label>
                                            <label><b>{{ $data-> father_name}}</b></label>
                                        </div>
                                        <div style="display: inline-block;" >
                                            <label>Mother Name : </label>
                                            <label>
                                                <b>{{ $data-> mother_name}}</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                    <div style=" margin-top: 5%;">
                                        <div class="form-group col-md-2">
                                            <div style="display: inline-block; width: 50%;" >
                                                <label>Phone Number : </label>
                                                <label><b>{{ $data-> student_mob}}</b></label>
                                            </div>
                                            <div style="display: inline-block;" >
                                                <label>Email :</label>
                                                <label>
                                                    <b>{{ $data-> user -> email}}</b>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                        <div style=" margin-top: 10%;">
                                            <div class="form-group col-md-2">
                                                <div style="display: inline-block; width: 50%;" >
                                                    <label>Student Date Of Birth :</label>
                                                    <label><b>{{ $data-> dob}}</b></label>
                                                </div>
                                                <div style="display: inline-block;" >

                                                    <label>Address : </label>
                                                    <label><b>{{ $data-> address}}</b></label>

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                            <div style=" margin-top: 15%;">
                                                <div class="form-group col-md-2">
                                                    <div style="display: inline-block; width: 50%;" >

                                                        <label>School :</label>
                                                        <label>
                                                            <b>{{ $data-> school}}</b>
                                                        </label>

                                                    </div>
                                                    <div style="display: inline-block;" >
                                                        <label>Education : </label>
                                                        <label><b>{{ $data-> education}}</b></label>

                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                                <div style=" margin-top: 19%;">
                                                    <div class="form-group col-md-2">
                                                        <div style="display: inline-block; width: 50%;" >
                                                            <label>Gender : </label>
                                                            <label><b>{{ (isset($data -> gender) && $data -> gender == 0) ? "Male" : "Female"}}</b></label>
                                                        </div>
                                                        <div style="display: inline-block;" >
                                                            <label>Handicap :</label>
                                                            <label>
                                                                <b> {{ (isset($data -> handicap -> name) && $data -> handicap -> name == 0) ? $data -> handicap -> name : "No"}}</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                    <div style=" margin-top: 23%;">
                                                        <div class="form-group col-md-2">
                                                            <div style="display: inline-block; width: 50%;" >
                                                                <label>Student Identity :</label>
                                                                <label>
                                                                    <b>{{ $data-> document -> name}}</b>
                                                                </label>
                                                            </div>
                                                            <div style="display: inline-block;" >
                                                                <label>Student Identity Number :</label>
                                                                <label>
                                                                    <b>{{ $data-> identity_number}}</b>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <br>



                                                        <div style=" margin-top: 30%;">
                                                            <div class="form-group col-md-2">
                                                                <div style="margin-right:50px ;" >
                                                                    <label>Course Name : </label>
                                                                    <label><b> @foreach ($data->student_course as $key => $course_value)
                                                                        {{ $course_value-> course -> name}}&nbsp;,&nbsp;
                                                                        @endforeach</b></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                            <br>
                                                                <div style=" margin-top: 35%;">
                                                                    <div class="form-group col-md-2">
                                                                        <div style="display: inline-block; width: 50%;" >
                                                                            <label>Date of Addmission :</label>
                                                                            <label>
                                                                                <b>{{ $data-> doaddmission}}</b>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                               </div>
                                                                    <br>

                                                                    
                                                                        <div style=" margin-top: 40%;">
                                                                            <div style="display: inline-block; width: 100% ;" >
                                                                                <label>Subject Name :</label>
                                                                                <label>
                                                                                    <b>
                                                                                       @foreach ($data->student_subject as $key => $subject_value)
                                                                                        {{ $subject_value-> subject -> name}}&nbsp;,&nbsp;
                                                                                        @endforeach
                                                                                    </b>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                </div>

                                                                <br>
                                                                    <div style=" margin-top: 55%;">
                                                                        <div class="form-group col-2">
                                                                            <div style="display: inline-block; width: 50%;" >
                                                                                <label for="StudentPhoto">Student Photo :</label>
                                                                                <p class="alert alert-success">
                                                                                    <img src="{{asset('public/images')}}/{{ $data->student_img }}" id="previewImg" name="student_img" alt="" style="max-width:130px;margin-top: 20px;" />
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </body>
                                                            </html>