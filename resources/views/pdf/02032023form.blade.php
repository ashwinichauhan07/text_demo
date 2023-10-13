
<!DOCTYPE html>
<html>
<head>
  <title>Student Admission Form</title>
  <style>

     .border
     {
      outline-style: solid;
      outline-color: black;
      padding:50px;
      /*padding-left: 8em;*/
     }
     /* .form*/
     /*{*/
     /*   background-color: blue;*/
     /*   width: 100%;*/
     /*   height: 30px;*/
     /*   color: #ffffff;*/
     /*   font-weight: 600;*/
     /*   border-radius: 10px;*/
     /*   text-align: center;*/
     /*   font-size: 25px;*/
     /*}*/

  </style>
  </head>
  <body>

    <div class="border" style="width: 100%;">

      <div style="display: inline-block; float: right;  width: 10%;" >
          <img src="{{asset('public/adminlogo')}}/{{ $data['inst_logo'] }}" style="width: 80px; height: 80px;">
            </div>
        <div style="display: inline-block; width: 80%; float: right;">
            <h1 style="text-align: center; font-size: 25px; padding-left: 0.7em;">{{ auth()->user()->name }}</h1>
            <h3 style="color: red; font-size: 20px;text-align: center;">  {{ $data['add'] }}</h3>
        </div>
        <div style="display: inline-block;  width: 10%;float: right; " >
            <img src="{{asset('public/adminlogo')}}/{{ $data['inst_logo'] }}" style="width: 80px; height: 80px; ">
        </div>

     <div style="margin-top: 7em; background-color: blue; color: whitesmoke; border-radius: 10px; width: 100%;" >
         <h4 style="text-align: center; font-size: 25px; width: 100%">Admission Form</h4>
     </div>
        <div style="display: inline-block; width: 50%;" >
              <label>Sr No : </label>
           <label><b>{{ $data->id }}</b></label>
         </div>
         <div style="display: inline-block;" >
           <label>Gr No : </label>
           <label>
            <b>120</b>
          </label>
         </div>
        <hr>


        <div class="form-group col-md-2">
          <div style="display: inline-block; width: 50%;" >
        <label>First Name : </label>
       <label><b>{{ $data['name'] }}</b></label>
     </div>
     <div style="display: inline-block;" >
       <label>Last Name : </label>
       <label>
        <b>{{ $data->lastname }}</b>
      </label>
     </div>
            <hr>
               <div class="form-group col-md-2">

                    <div style="display: inline-block; width: 50%;" >
                      <label>Father Name : </label>
                   <label><b>{{ $data->father_name }}</b></label>
                 </div>
                 <div style="display: inline-block;" >
                   <label>Mother Name : </label>
                   <label>
                    <b>{{ $data->mother_name }}</b>
                  </label>
                 </div>
                  </div>
             <hr>
                   <div class="form-group col-md-2">
                    <div style="display: inline-block; width: 50%;" >
                    <label>Phone Number : </label>
                   <label><b>{{ $data->student_mob }}</b></label>
                 </div>
                  <div style="display: inline-block;" >
                   <label>Email :</label>
                   <label>
                    <b>{{ $data->user->email }}</b>
                  </label>
                 </div>
                  </div>
            <hr>
            <div class="form-group col-md-2">
                <div style="display: inline-block; width: 50%;" >
                    <label>Student Date Of Birth :</label>
                    <label><b>{{ $data->dob }}</b></label>
                </div>
                <div style="display: inline-block;" >

                            <label>Address : </label>
                           <label><b>{{ $data->address }}</b></label>

                </div>
            </div>

            <hr>
                    <div class="form-group col-md-2">
                    <div style="display: inline-block; width: 50%;" >

                        <label>School :</label>
                        <label>
                            <b>{{ $data->school }}</b>
                        </label>

                 </div>
                  <div style="display: inline-block;" >
                      <label>Education : </label>
                      <label><b>{{ $data->education }}</b></label>

                 </div>
                  </div>
                    <hr>

            <div class="form-group col-md-2">
                <div style="display: inline-block; width: 50%;" >
                    <label>Gender : </label>
                    <label><b>{{ (isset($data->gender) && $data->gender == 0) ? "Male" : "Female"}}</b></label>
                </div>
                <div style="display: inline-block;" >
                    <label>Handicap :</label>
                    <label>
                        <b> {{ (isset($data->handicap->name) && $data->handicap->name == 0) ? $data->handicap->name : "No" }}</b>
                    </label>
                </div>
            </div>
            <hr>
                     <div class="form-group col-md-2">
                    <div style="display: inline-block; width: 50%;" >
                        <label>Student Identity :</label>
                        <label>
                            <b>{{ $data->document->name }}</b>
                        </label>
                 </div>
                  <div style="display: inline-block;" >
                   <label>Student Identity Number :</label>
                   <label>
                    <b>{{ $data->identity_number }}</b>
                  </label>
                 </div>
                  </div>

                    <hr>
                 <div class="form-group col-md-2">
                <div style="margin-right:50px;" >
                <label>Course Name : </label>
               <label><b> @foreach ($data->student_course as $key => $course_value)
                           {{ $course_value->course->name }}&nbsp;,&nbsp;
                         @endforeach</b></label>
             </div>
             <br>
              <div style="" >
               <label>Subject Name :</label>
               <label>
                <b>
                        @foreach ($data->student_subject as $key => $subject_value)
                           {{ $subject_value->subject->name }}&nbsp;,&nbsp;
                         @endforeach
                </b>
              </label>
             </div>
              </div>
                <hr>


            <div class="form-group col-md-2">
                <div style="display: inline-block; width: 50%;" >
                    <label>Date of Addmission :</label>
                    <label>
                        <b>{{ $data->doaddmission }}</b>
                    </label>
                </div>
                <hr>
                {{--                  <div style="display: inline-block;" >--}}
                {{--                      <label>Other Identity Name : </label>--}}
                {{--                      <label><b>{{ $data->otherdocument }}</b></label>--}}

            </div>
        </div>
                <div class="form-group col-2">
                    <div style="display: inline-block; width: 50%;" >
                        <label for="StudentPhoto">Student Photo :</label>
                        <p class="alert alert-success">
                            <img src="{{asset('public/images')}}/{{ $data->student_img }}" id="previewImg" name="student_img" alt="" style="max-width:130px;margin-top: 20px;"/>
                        </p>
                    </div>
                </div>


        </div>
    </div>










{{--         <div class="form-group col-md-2">--}}
{{--        <div style="display: inline-block; width: 50%;" >--}}
{{--        <label>Other Identity Name : </label>--}}
{{--       <label><b>{{ $data->otherdocument }}</b></label>--}}
{{--     </div>--}}
{{--      <div style="display: inline-block;" >--}}
{{--       <label>Student Identity Number :</label>--}}
{{--       <label>--}}
{{--        <b>{{ $data->identity_number }}</b>--}}
{{--      </label>--}}
{{--     </div>--}}
{{--      </div>--}}
{{--        <hr>--}}



{{--         <div class="form-group col-md-2">--}}
{{--        <div style="display: inline-block; width: 50%;" >--}}
{{--        <label>Student Type : </label>--}}
{{--       <label><b>--}}
{{--                        @if($data->student_type == 0)--}}
{{--                                                 Regular--}}
{{--                        @elseif($data->student_type == 1)--}}
{{--                                   Repeat--}}
{{--                        @elseif($data->student_type == 2)--}}
{{--                                   Reappear--}}
{{--                        @endif--}}
{{--       </b></label>--}}
{{--     </div>--}}
{{--      <div style="display: inline-block;" >--}}
{{--       <label>Student Fees :</label>--}}
{{--       <label>--}}
{{--        <b>{{ $data->coursefee_id }}</b>--}}
{{--      </label>--}}
{{--     </div>--}}
{{--      </div>--}}
{{--        <hr>--}}



{{--        <div class="form-group col-md-2">--}}
{{--        <div style="display: inline-block; width: 50%;" >--}}
{{--        <label>Session :</label>--}}
{{--       <label><b>{{ $data->isession->start_session }}&nbsp;to&nbsp;--}}
{{--            {{ $data->isession->end_session }}</b></label>--}}
{{--     </div>--}}
{{--      <div style="display: inline-block;" >--}}
{{--       <label>Student Session Year :</label>--}}
{{--       <label>--}}
{{--        <b>{{ $data->year }}</b>--}}
{{--      </label>--}}
{{--     </div>--}}
{{--      </div>--}}
{{--        <hr>--}}
{{--        <br>--}}
{{--        <div class="form-group col-md-2">--}}
{{--        <div style="display: inline-block; margin-right:50px;" >--}}
{{--          <br>--}}
{{--        <label>Student Photo :</label>--}}
{{--         <label style="margin-left: 12.7em;">Student Identity Photo :</label>--}}
{{--         <br><br>--}}
{{--       <img src="C:\xampp\htdocs\ESwiftProject\public\images/{{ $data->student_img }}" style="width: 150px; height: 120px">--}}
{{--     </div>--}}

{{--      <div style="display: inline-block;" >--}}
{{--       <!-- <label>Student Identity Photo :</label> -->--}}

{{--        <img src="C:\xampp\htdocs\ESwiftProject\public\identitimages/{{ $data->identity_img }}" style="width: 150px; height: 120px">--}}

{{--     </div>--}}
{{--      </div>--}}
{{--        <hr>--}}
{{--      </div>--}}




{{--                    <!-- <div class="form-group col-6" style="padding: 5PX;">--}}
{{--                      <label for="studentName" style="padding-left: 10px;">Session :</label>--}}
{{--                        <input type="text" value="{{ $data->isession->start_session }}&nbsp;to&nbsp;--}}
{{--            {{ $data->isession->end_session }}" style="width: 170px; margin-left: 7em">--}}
{{--                            <br><br>--}}
{{--                      <label for="studentName" style="padding-left: 9px;">Student Session Year : </label>--}}
{{--                        <input type="text" value="{{ $data->year }}" style="width: 170px; margin-left: 7em">--}}
{{--                    </div> -->--}}

{{--                   <!-- {{ $data->student_img }} -->--}}







</body>

</html>
