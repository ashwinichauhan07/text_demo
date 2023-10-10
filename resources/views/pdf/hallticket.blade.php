<!DOCTYPE html>
<html>
<head>
	<title>Admission Card</title>
</head>
<style type="text/css">
	.head{
		border:solid 5px;
		border-radius: 12px;
	}
</style>
<body>

	<div class="head">
		<div>
			<h2 style="text-align: center;">ADMISSION CARD</h2>
		</div>
		<div style="margin: 10px;">

			<div style="display: inline-block; ">
			    <img src="C:\xampp\htdocs\ESwiftProject\public\adminlogo/{{ $data['inst_logo'] }}" style="width: 80px; height: 80px;padding:5px;">
		        </div>

		        <div style="display: inline-block; padding-left: 25em; ">
			    <img src="C:\xampp\htdocs\ESwiftProject\public\images/{{ $data->studentData->student_img }}" style="width: 80px; height: 80px;border:solid 1px; padding:5px;">
		        </div>

			<div style="margin: 10px;">
				<div style="display: inline-block; width: 30%;">
				<label><b>SEAT NO :</b></label>
				</div>
			    <div style="display: inline-block;">
			    <label style="border:solid 2px; padding: 2em;">{{ $data->studentData->student_grno->student_grno }}</label>
		        </div>
		       <!--  <div style="display: inline-block; padding-left: 17em; ">
			    <img src="C:\xampp\htdocs\ESwiftProject\public\images/{{ $data->studentData->student_img }}" style="width: 80px; height: 80px;border:solid 1px; padding:5px;">
		        </div> -->
		</div>
		<div style="margin: 10px;">
			    <div style="display: inline-block; width: 30%;">
				<label><b>CANDIDATE'S NAME :</b></label>
				</div>
				<div style="display: inline-block;">
			    <label><b>{{ $data->studentData->user->name }} {{ $data->studentData->father_name }}
			    	{{ $data->studentData->lastname }}</b></label>
		        </div>
		</div>

		<div style="margin: 10px;">
			    <div style="display: inline-block; width: 30%;">
				<label><b>MOTHER'S NAME :</b></label>
				</div>
				<div style="display: inline-block;">
			    <label><b>{{ $data->studentData->mother_name }} </b></label>
		        </div>
		</div>

		<div style="margin: 10px;">
			    <div style="display: inline-block; width: 30%;">
				<label><b>INSTITUTE CODE :</b></label>
				</div>
				<div style="display: inline-block;">
			    <label style="border:solid 2px; padding: 2em;">{{ $data->instituteData->institute_code }}</label>
		        </div>
		</div>

		<div style="margin: 10px;">
			    <div style="display: inline-block; width: 30%;">
				<label><b>CENTER NAME & ADDRESS :</b></label>

				</div>
				<div style="display: inline-block;">
					<div style="width: 65%;">
			     <br>
			    <label><b> {{ $data->instituteData->address }}</b></label>
			        </div>
		        </div>
		   </div>
		   <!-- <hr> -->

		    <div style="margin: 10px;">
			    <div style="display: inline-block; width: 30%;">
				<label><b>SUBJECT :</b></label>
				</div>
				<div style="display: inline-block;">
			    <label><b>{{ $data->subject->name }}</b></label>
		        </div>
		        </div>

		<div style="margin: 10px;">
			    <div style="display: inline-block; width: 30%;">
				<label><b>Handicap</b></label>
				</div>
				<div style="display: inline-block; width: 20%">
			    <label><b>
			    	@if($data->studentData->handicap_id == 0)
					      NO
					@elseif($data->studentData->handicap_id == 1)
					      YES
					@endif    

			    </b></label>
		        </div>

		        <div style="display: inline-block; width: 20%;">
				<label><b>BATCH :</b></label>
				</div>
				<div style="display: inline-block; ">
			    <label style="border:solid 2px; padding: 2em;">{{ $data->batch }}</label>
		        </div>
		    </div>
		<!-- </div> -->

		       

		<div style="margin: 10px;">
			    <div style="display: inline-block; width: 30%;">
				<label><b>DATE :</b></label>
			    </div>
				<div style="display: inline-block; width: 20%">
			    <label><b>{{ $data->exam_date }}</b></label>
		        </div>

		         <div style="display: inline-block; width: 20%;">
				 <label><b>DAY :</b></label>
				 </div>
				 <div style="display: inline-block; ">
			    <label><b>{{ $data->day }}</b></label>
		        </div>
		    </div>

		    <div style="margin: 10px;">
			    <div style="display: inline-block; width: 30%;">
				<label><b>START TIME :</b></label>
			    </div>
				<div style="display: inline-block; width: 20%">
			    <!-- <label><b>{{ $data->start_time }}</b></label> -->
			    <input type="time" value="{{ $data->start_time }}" disabled><b>{{ $data->start_time }}</b>
		        </div>

		         <div style="display: inline-block; width: 20%;">
				 <label><b>END TIME :</b></label>
				 </div>
				 <div style="display: inline-block; ">
			     <input type="time" value="{{ $data->end_time }}" disabled><b>{{ $data->end_time }}</b>
		        </div>
		    </div>
		    <br>

		    <div style="margin-top: 2em;">
		    	<!-- <div style="text-align: right; padding: 1em;"> -->
		    		<div style="text-align: right; margin-right: 1em">
		    		<label><b>SIGN OF HEAD OF INSTITUTE /</b><br></label>
		    	    </div>
		    	    <div style="text-align: right; margin-right: 3.5em;">
		    		<label><b>PRINCIPAL & STAMP</b></label>
		    	    </div>

		    	</div>
		    <!-- </div> -->

		
	</div>

</body>
</html>