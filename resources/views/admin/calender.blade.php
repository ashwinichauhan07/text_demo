@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')
<style>
  body
  {
    text-align: center;

  }
  * {
  margin: 0;
  padding: 0;
}

.container {
  margin-top: 40px;
}

th {
  height: 20px;
  text-align: center;
  font-weight: 700;
}

td {
  height: 100px;
}

.today {

  background-color: #ffd480;
  text-align: center;


}
.month-year
{
  background-color: #e69900;
  text-align: center;
  width: 90%;
  font-weight: 900;
  color: white;
}

th:nth-of-type(7),
td:nth-of-type(7) {
  /*font-weight: bold;*/
}

th:nth-of-type(1),
td:nth-of-type(1) {
  font-weight: bold;
  color: red;

}
</style>
 <main>
                    <div class="container-fluid">

                        <ol class="breadcrumb mb-4 mt-4">


  <!-- If want show all error in one place  -->

                        <li class="breadcrumb-item active">Calendar</li>
                        </ol>

                        <div class="row mt-4">

                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-body">
 <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<div class="container">
 <!--  <i class="prev-month fa fa-chevron-left fa-3x"></i> <i class="next-month fa fa-chevron-right fa-3x"></i>
  <br> -->
  <div class="month-year text-center">
    <h3></h3></div>
  <table class="table table-bordered" style="width: 90%;">
    <tr>
      <th style="text-align: center;">SUN</th>
      <th style="text-align: center; font-weight: bold;">MON</th>
      <th style="text-align: center; font-weight: bold;">TUES</th>
      <th style="text-align: center; font-weight: bold;">WED</th>
      <th style="text-align: center; font-weight: bold;">THURS</th>
      <th style="text-align: center; font-weight: bold;">FRI</th>
      <th style="text-align: center; font-weight: bold;">SAT</th>
    </tr>
  </table></div>
                <h6 class="card-subtitle"></h6>
                <form id="example-form" action="#" class="m-t-40">
                    <div>
                        <section>
                            <div id="calendar">

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
      {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/chart-area-demo.js') }}"></script>
        <script src="{{ url('public/chartJs/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('public/chartJs/datatables-demo.js') }}"></script>

<script>
  var CURRENT_DATE = new Date();
var d = new Date();

var content = 'January February March April May June July August September October November December'.split(' ');
var weekDayName = 'SUN MON TUES WED THURS FRI'.split(' ');
var daysOfMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

// Returns the day of week which month starts (eg 0 for Sunday, 1 for Monday, etc.)
function getCalendarStart(dayOfWeek, currentDate) {
  var date = currentDate - 1;
  var startOffset = (date % 7) - dayOfWeek;
  if (startOffset > 0) {
    startOffset -= 7;
  }
  return Math.abs(startOffset);
}

// Render Calendar
function renderCalendar(startDay, totalDays, currentDate) {
  var currentRow = 1;
  var currentDay = startDay;
  var $table = $('table');
  var $week = getCalendarRow();
  var $day;
  var i = 1;

  for (; i <= totalDays; i++) {
    $day = $week.find('td').eq(currentDay);
    $day.text(i);
    if (i === currentDate) {
      $day.addClass('today');
    }

    // +1 next day until Saturday (6), then reset to Sunday (0)
    currentDay = ++currentDay % 7;

    // Generate new row when day is Saturday, but only if there are
    // additional days to render
    if (currentDay === 0 && (i + 1 <= totalDays)) {
      $week = getCalendarRow();
      currentRow++;
    }
  }
}

// Clear generated calendar
function clearCalendar() {
  var $trs = $('tr').not(':eq(0)');
  $trs.remove();
  $('.month-year').empty();
}

// Generates table row used when rendering Calendar
function getCalendarRow() {
  var $table = $('table');
  var $tr = $('<tr/>');
  for (var i = 0, len = 7; i < len; i++) {
    $tr.append($('<td/>'));
  }
  $table.append($tr);
  return $tr;
}

function myCalendar() {
  var month = d.getUTCMonth();
  var day = d.getUTCDay();
  var year = d.getUTCFullYear();
  var date = d.getUTCDate();
  var totalDaysOfMonth = daysOfMonth[month];
  var counter = 1;

  var $h3 = $('<h3>');

  $h3.text(content[month] + ' ' + year);
  $h3.appendTo('.month-year');

  var dateToHighlight = 0;

  // Determine if Month && Year are current for Date Highlight
  if (CURRENT_DATE.getUTCMonth() === month && CURRENT_DATE.getUTCFullYear() === year) {
    dateToHighlight = date;
  }

  //Getting February Days Including The Leap Year
  if (month === 1) {
    if ((year % 100 !== 0) && (year % 4 === 0) || (year % 400 === 0)) {
      totalDaysOfMonth = 29;
    }
  }

  // Get Start Day
  renderCalendar(getCalendarStart(day, date), totalDaysOfMonth, dateToHighlight);
};

function navigationHandler(dir) {
  d.setUTCMonth(d.getUTCMonth() + dir);
  clearCalendar();
  myCalendar();
}

$(document).ready(function() {
  // Bind Events
  $('.prev-month').click(function() {
    navigationHandler(-1);
  });
  $('.next-month').click(function() {
    navigationHandler(1);
  });
  // Generate Calendar
  myCalendar();
});
</script>    @endpush
@endonce
