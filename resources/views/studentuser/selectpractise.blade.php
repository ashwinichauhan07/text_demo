@extends('layouts.admin')

@section('title', 'Page Admin')

@section('sidebar')

    @parent

@endsection

@section('content')
    <style>

        .bluebox{
            height: 60PX;
            width: 85%;
            margin: 20px;
            color: white;
            font-weight: 600;
            background-color:#527a7a;
            text-align: center;
            padding:10px 10px 10px 10px;
            border-radius: 5px;
            font-size: 30px;


        }
        .bluebox1{
            height: 60PX;
            width: 85%;
            margin: 20px;
            background-color:#527a7a;
            color: white;
            font-weight: 600;
            text-align: center;
            padding:10px 10px 10px 10px;
            border-radius: 5px;
            font-size: 30px;
        }
        .box{
            background-color:#2e2e1f;
            color: white;
            height: 50px;
            width: 25%;
            text-align: center;
            display: inline-block;
            padding:4px 4px 4px 4px;
            margin-bottom: 2%;
            margin-left:3%;
            border-radius: 5px;
            font-size: 20px;
            padding-left: 1.5em;

        }
        .box1{
            background-color:#2e2e1f;
            color: white;
            height: 50px;
            width: 25%;
            display: inline-block;
            padding:4px 4px 4px 4px;
            margin-bottom: 2%;
            margin-left:3%;
            border-radius: 5px;
            font-size: 20px;
            padding-left: 1.5em;

        }
        .box2{
            background-color:#2e2e1f;
            color: white;
            height: 50px;
            width: 25%;
            text-align: center;
            display: inline-block;
            padding:4px 4px 4px 4px;
            margin-bottom: 2%;
            margin-left:3%;
            border-radius: 5px;
            font-size: 20px;
            padding-left: 1.5em;
        }
        .box3{
            background-color:#2e2e1f;
            color: white;
            height: 50px;
            width: 25%;
            text-align: center;
            display: inline-block;
            padding:4px 4px 4px 4px;
            margin-bottom: 2%;
            margin-left:3%;
            border-radius: 5px;
            font-size: 20px;
            padding-left: 1.5em;
        }
        .box4{
            background-color:#3d3d29;
            color: white;
            height: 50px;
            width: 25%;
            text-align: center;
            padding:4px 4px 4px 4px;
            margin-bottom: 2%;
            margin-left:3%;
            border-radius: 5px;
            font-size: 20px;
            padding-left: 1.5em;

        }
        .box5{
            background-color:#2e2e1f;
            color: white;
            height: 50px;
            width: 25%;
            text-align: center;
            display: inline-block;
            padding:4px 4px 4px 4px;
            margin-bottom: 2%;
            margin-left:3%;
            border-radius: 5px;
            font-size: 20px;
            padding-left: 1.5em;


        }
    </style>

    <main>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="container-fluid">
            <div class="col-xl-12">
                <div class="card-body">
                    <div style="background-color: gray; border-radius: 10px; margin-left: 20px; margin-right: 10em; padding: 10px;">
                        <label style="color: whitesmoke; font-weight: 500; font-size: 20px;">Please minimise the browser and open the exe from desktop for practise of <b class="text-dark">Passage, Letter, Statement and Email</b> using otp :- <strong class="text-dark">{{ auth()->user()->otp }}</strong></label>
                    </div>


                    <input type="text" name="token" id="token" value="{{ auth()->user()->token }}" hidden>

                    <input type="text" id="user_id" name="user_id" value={{ auth()->id() }}" hidden>

         @foreach($subject_arr as $subject_value)
                        <div class="bluebox"><h2>{{ $subject_value->subject->name }}</h2></div>

                {{--<label>{{ auth()->user()->otp }}</label>--}}


            @foreach($practiseType as $key=> $practiseType_value)
                    @if($practiseType_value->practise_type == 0)
                        @if($subject_value->subject->id == $practiseType_value->subject_id)


                            <select class="box"  onchange="location = this.value;">

                                <option selected hidden>{{ $practiseType_value->name }}</option>

                                @foreach($keyboardType as $key=> $keboardPractice_value)
                                    @if($subject_value->subject->id == $keboardPractice_value->subject_id)
                                        @if($practiseType_value->id == $keboardPractice_value->practise_type)

                                            <option value="{{route('keboardPractice.typingpractise',[$keboardPractice_value->id]) }}" id="keyboardpractise">{{ $keboardPractice_value->name }}  </option>
                                        @endif
                                    @endif
                                @endforeach
                                @endif
                            </select>
{{--                        @endif--}}
{{--                            @if($practiseType_value->practise_type == 1)--}}
{{--                                @if($subject_value->subject->id == $practiseType_value->subject_id)--}}
{{--                                    <select class="box"  onchange="loadDoc(event);">--}}

{{--                                        <option selected>{{ $practiseType_value->name }}</option>--}}

{{--                                        @foreach($typingData as $key=> $typingPractice_value)--}}

{{--                                            @if($subject_value->subject->id == $typingPractice_value->subject_id)--}}
{{--                                                @if($practiseType_value->id == $typingPractice_value->practise_type)--}}

{{--                                                    <option value="{{ $typingPractice_value->id }}" id="">{{ $typingPractice_value->typingdata }}  </option>--}}

{{--                                                    --}}{{--                                                    $url = url("/public/typing_data")."/".$typingData->typingdata;--}}

{{--                                                    --}}{{--                                                <option value="{{asset('public/typing_data')}}/{{ $typingPractice_value->typingdata }}" id="" target="_new">{{ $typingPractice_value->typingdata }}  </option>--}}
{{--                                                    --}}{{--                                                    <option value=url("/public/typing_data")."/".{{ $typingPractice_value->typingdata }} id="">{{ $typingPractice_value->typingdata }}  </option>--}}

{{--                                                @endif--}}


{{--                                            @endif--}}

{{--                                        @endforeach--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
                                @endif
                                @endforeach
                            @endforeach

            </div>
    </main>

@endsection

@once
    @push('scripts')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('/js/scripts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

         <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

        </script>
      <script src="{{ url('public/js/a.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('chartJs/datatables-demo.js') }}"></script>
        <script src="{{ url('public/js/a.js') }}"></script>
        <script>

            // window.onload = () => {
            //     var keyboardpractise = document.getElementById('keyboardpractise');
            //
            //     keyboardpractise.onchange = (e) => {
            //         e.preventDefault();
            //
            //         console.log(keyboardpractise.value);
            //     }
            //
            //
            // }

            // function loadDoc(event)
            // {
            //
            //         var user_id = document.getElementById('user_id');

            {{--alert("Please mimimise the browser and open exe from Desktop your otp for exe {{ auth()->user()->token }}" );--}}
            //
            // console.log(event.target.value);
            // console.log(user_id);

            //     w = new ActiveXObject("WScript.Shell");
            // var commandtoRun = "C:/ESwift/ESwifte/ESwift.exe";
            // // var path = "C:/xampp/htdocs/ESwiftProject/public/typing_data/EnglishSpeedPassage30-1.docx"
            //     w.run("D:/R/Release/ESwift.exe D:/ESwift/PassageEnglish30.docx");
            //     return true;

            // var oShell = new ActiveXObject("Shell.Application");
            // var commandtoRun = "c:\\windows\\system32\\notepad.exe";
            // oShell.ShellExecute(commandtoRun, "", "", "open", "1");

            // if (window.DOMParser)
            // { // Firefox, Chrome, Opera, etc.
            //     parser=new DOMParser();
            //     xmlDoc=parser.parseFromString(xml,"text/xml");
            // }
            // else // Internet Explorer
            // {
            //     xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
            //     xmlDoc.async=false;
            //     xmlDoc.loadXML(xml);
            // }
            // }

            function loadDoc(event)
            {
                // console.log(event.target.value);
                var user_id = document.getElementById('user_id');
                var token = document.getElementById('token');
                //
                var formData = new FormData();
                formData.append('typing_id',event.target.value);
                formData.append('user_id',user_id.value);
                formData.append('token',token.value);
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {

                        alert('Please Minimise The browser and invoke the exe from Desktop using otp :- {{ auth()->user()->otp }}')
                        // console.log('ll');
                        //   window.location.href = "http://localhost/phpmyadmin/sql.php?server=1&db=eswift&table=upload_typingpractises&pos=0"
                    }
                };
                xmlhttp.open("POST", "{{ route('studenttyping.exe') }}", true);
                xmlhttp.setRequestHeader("X-CSRF-Token",document.querySelector('meta[name="csrf-token"]').content);
                xmlhttp.send(formData);
            }

            {{--function loadExe()--}}
            {{--{--}}

            {{--  console.log('working');--}}

            {{--  var xmlhttp = new XMLHttpRequest();--}}
            {{--  xmlhttp.onreadystatechange = function()--}}
            {{--  {--}}
            {{--    if (this.readyState == 4 && this.status == 200)--}}
            {{--    {--}}
            {{--      // document.getElementById("txtHint").innerHTML = this.responseText;--}}
            {{--    }--}}
            {{--  };--}}
            {{--  xmlhttp.open("GET", "{{ route('studenttyping.exe1') }}", true);--}}
            {{--  xmlhttp.send();--}}
            {{--}--}}

            {{--function loadExe1()--}}
            {{--{--}}

            {{--  console.log('working');--}}

            {{--  var xmlhttp = new XMLHttpRequest();--}}
            {{--  xmlhttp.onreadystatechange = function()--}}
            {{--  {--}}
            {{--    if (this.readyState == 4 && this.status == 200)--}}
            {{--    {--}}
            {{--      // document.getElementById("txtHint").innerHTML = this.responseText;--}}
            {{--    }--}}
            {{--  };--}}
            {{--  xmlhttp.open("GET", "{{ route('studenttyping.exe2') }}", true);--}}
            {{--  xmlhttp.send();--}}
            {{--}--}}
        </script>
    @endpush
@endonce
