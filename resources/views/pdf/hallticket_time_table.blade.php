<!DOCTYPE html>
<html>
<head>
	<title>Exam Time Table</title>
</head>

<style type="text/css">
	table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  /*width: 100%;*/
}

td, th {
  border: 2px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #ffffe6;
 ;
}
</style>
</style>

<body>
	<div style="border:solid 2px;">
<div style="margin: 10px;">
 <h1 style="text-align: center;"><u>EXAM TIME TABLE</u></h1>


	<br>
	<table>


  <tr>
    <th>Student Name</th>
    <th>Student Subject</th>
    <th>Exam Date</th>
    <th>Batch Number</th>
    <th>Exam Start Time</th>
    <th>Exam End Time</th>
    <th>Day</th>
    <th>Center Name</th>
  </tr>
  
            @foreach($data as $key => $hallticket_value)
            <tr>
                <td>{{ $hallticket_value->student->user->name}} {{     $hallticket_value->student->father_name}} &nbsp;
                {{ $hallticket_value->student->lastname}} </td>
                <td>{{ $hallticket_value->subject->name }}</td>
                <td>{{ $hallticket_value->exam_date }}</td>
                <td>{{ $hallticket_value->batch }}</td>
                <td>{{ $hallticket_value->start_time }}</td>
                <td>{{ $hallticket_value->end_time }}</td>
                <td>{{ $hallticket_value->day }}</td>
                <td>{{ auth()->user()->name }}</td>

            </tr>
            @endforeach




   <tr>
    <th>Student Name</th>
    <th>Student Subject</th>
    <th>Exam Date</th>
    <th>Batch Number</th>
    <th>Exam Start Time</th>
    <th>Exam End Time</th>
    <th>Day</th>
    <th>Center Name</th>
  </tr>
</table>
</div>
	</div>
	</div>

</body>
</html>