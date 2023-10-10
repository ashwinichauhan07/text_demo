<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Typing Practise</title>
    <link href="{{ url('public/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/key.css') }}">
    <style>
        body {
            background-color: #b8b894;
        }

        .row {
            padding-top: 5px;
            display: inline-block;
            width:40%
        }

        .row1 {
            padding-top: 25px;
            display: inline-block;
            width: 40%
        }

        .row3 {
            display: inline-block;
            background-color: #061C2B;
            height: 100%;
            width: 10%;
            padding-bottom: 10px;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 2px solid;
            width: 30%;
            height: 30%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            text-align: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        #circle {
            width: 25px;
            height: 25px;
            background: red;
            border-radius: 50%
        }

        #circle1 {
            width: 25px;
            height: 25px;
            background: green;
            border-radius: 50%
        }

        #circle2 {
            width: 25px;
            height: 25px;
            background: yellow;
            border-radius: 50%
        }

        #modalContainer {
            background-color: rgba(0, 0, 0, 0.3);
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            z-index: 10000;
            /* required by MSIE to prevent actions on lower z-index elements */
        }

        #alertBox {
            position: relative;
            width: 400px;
            padding: 15px;
            min-height: 50px;
            margin-top: 50px;
            font-family: Arial, Helvetica, sans-serif;
            border: 3px solid #357EBD;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: 20px 30px;
            text-align: center;
            color: #000000;
            font: 1.3em verdana, arial;
        }

        #modalContainer > #alertBox {
            position: fixed;
        }

        #alertBox h1 {
            margin: 0;
            font: bold 0.9em verdana, arial;
            background-color: #3073BB;
            color: #FFF;
            border-bottom: 1px solid #000;
            padding: 2px 0 2px 5px;
        }

        #alertBox p {
            font: 0.9em verdana, arial;
            /*height:100px;
            padding-left:5px;
            padding: 15px;
            margin-left:55px;*/
            font-weight: 600;
        }

        #alertBox #closeBtn {
            display: block;
            position: relative;
            margin: 5px auto;
            padding: 7px;
            border: 0 none;
            width: 70px;
            font: 0.7em verdana, arial;
            text-transform: uppercase;
            text-align: center;
            color: #FFF;
            background-color: #357EBD;
            border-radius: 3px;
            text-decoration: none;
        }

        /* unrelated styles */
        #mContainer {
            position: relative;
            width: 600px;
            margin: auto;
            padding: 5px;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            font: 0.7em verdana, arial;
        }

        h1, h2 {
            margin: 0;
            padding: 4px;
            font: bold 1.5em verdana;
            /*border-bottom:1px solid #000;*/
        }

        code {
            font-size: 1.2em;
            color: #069;
        }

        #credits {
            position: relative;
            margin: 25px auto 0px auto;
            width: 350px;
            font: 0.7em verdana;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            height: 90px;
            padding-top: 4px;
        }

        #credits img {
            float: left;
            margin: 5px 10px 5px 0px;
            border: 1px solid #000000;
            width: 80px;
            height: 79px;
        }

        .important {
            background-color: #F5FCC8;
            padding: 2px;
        }

        code span {
            color: green;
        }


    </style>
</head>
<body>
<section style="padding-top: 8px;">
    <div class="container">
        <div
            style="background-color: #404040; color: #E8E8E8; text-align: center; height: 40px; width: 100%; margin-left: 10px;">
            <h3><u>{{ $keboardPractice->name }}</u></h3>
        </div>
        <div class="row">
            <textarea rows="10" cols="60" id="question"
                      style="border: solid 2px; background-color: #ffffe6;border-radius: 5px; overflow: scroll; padding-left: 1em;"
                      disabled>{{ $keboardPractice->desc }}</textarea>
        </div>
        <div class="row1">
            <textarea rows="10" cols="60" id="answer"
                      style="border: solid 2px; background-color: #ffffe6;border-radius: 5px;overflow: scroll; padding: 0.5; padding-left: 1em; font-size:16px;"></textarea>
        </div>
        <div class="row3">
            <div class="form-group" style="margin: 10px 0px 0px 15px;">
                <button type="submit" id="time_timer" class="" style="width: 100px; height: 55px; background-color: #d6f5f5; font-weight: 600;
       border-radius: 10px;">00:00
                </button>
            </div>

            <div class="form-group" style="margin: 10px 0px 0px 15px;" hidden>
                <button type="submit" id="stop_watch" class="" style="width: 100px; height: 55px; background-color: #d6f5f5; font-weight: 600;
       border-radius: 10px;">Stop Watch
                </button>
            </div>
            <div class="form-group" style="margin: 10px 0px 0px 15px;">
                <button type="submit" id="submit" class="" style="width: 100px; height: 55px; background-color: #d6f5f5; font-weight: 600;
      border-radius: 10px;">Submit
                </button>
            </div>
            <!-- <div class="form-group" style="margin: 10px 0px 0px 15px;">
            <button type="submit" class="" style="width: 100px; height: 55px; background-color: #d6f5f5;font-weight: 600;
            border-radius: 10px;">Extend Time</button>
            </div> -->
            {{--      <div class="form-group" style="margin: 10px 0px 0px 15px;">--}}
            {{--      <button type="submit" class="" style="width: 100px; height: 55px; background-color: #d6f5f5; font-weight: 600;--}}
            {{--      border-radius: 10px;">Practise Again</button>--}}
            {{--      </div>--}}
            <div class="form-group" style="margin: 10px 0px 0px 15px;">

                <a href="{{ route('studentuser.selectpractise') }}" class="btn btn-info"
                   style="width:100px; background-color:#d6f5f5; color:black; font-weight: 600; border-radius: 10px;">Back</a>
            </div>

        </div>

        <input type="text" name="student_id" value="{{ auth()->id() }}" id="student_id" hidden>

        <input type="text" name="institute_id" value="{{ $keboardPractice->institute_id }}" id="institute_id" hidden>

        <input type="text" name="subject_id" value="{{ $keboardPractice->subject_id }}" id="subject_id" hidden>

        <input type="text" name="keboard_practice_id" value="{{ $keboardPractice->id }}" id="keboard_practice_id"
               hidden>

        <input type="text" name="practise_type" value="{{ $keboardPractice->practise_type }}" id="practise_type" hidden>

    </div>
    </div>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div style="padding: 5px; margin-left: 10px" id="circle"><span
                    style="margin-left: 30px;">Wrong&nbsp;Word</span></div>
            <div style="margin-top: 10px; margin-left: 10px" id="circle1"></div>
            <div style="margin-top: 10px; margin-left: 10px" id="circle2"></div>
        </div>

    </div>
    <div class="row" style="background-color:#bcbcb8; width: 45%; height: 25%;  border: solid 2px; margin-left: 20em; padding-bottom:1.5em; ">
        <div class="keyboard__row keyboard__row--h1">

        </div>
        <div class="keyboard__row">
            <div class="key--double" data-key="192">
                <div>~</div>
                <div>.</div>
            </div>
            <div class="key--double" data-key="49">
                <div><sup>!</sup>&nbsp;&nbsp;1</div>
                <!-- <div>1</div> -->
            </div>
            <div class="key--double" data-key="50">
                <div><sup>@</sup>&nbsp;&nbsp;2</div>
                <!-- <div>2</div> -->
            </div>
            <div class="key--double" data-key="51">
                <div><sup>#</sup>&nbsp;&nbsp;3</div>
                <!-- <div>3</div> -->
            </div>
            <div class="key--double" data-key="52">
                <div><sup>$</sup>&nbsp;&nbsp;4</div>

            </div>
            <div class="key--double" data-key="53">
                <div><sup>%</sup>&nbsp;&nbsp;5</div>

            </div>
            <div class="key--double" data-key="54">
                <div><sup>^</sup>&nbsp;&nbsp;6</div>

            </div>
            <div class="key--double" data-key="55">
                <div><sup>&</sup>&nbsp;&nbsp;7</div>

            </div>
            <div class="key--double" data-key="56">
                <div><sup>*</sup>&nbsp;&nbsp;8</div>

            </div>
            <div class="key--double" data-key="57">
                <div><sup>(</sup>&nbsp;&nbsp;9</div>

            </div>
            <div class="key--double" data-key="48">
                <div><sup>)</sup>&nbsp;&nbsp;10</div>

            </div>
            <div class="key--double" data-key="189">
                <div>-&nbsp;&nbsp;_</div>

            </div>
            <div class="key--double" data-key="187">
                <div><sup>+</sup>&nbsp;&nbsp;=</div>
                <!-- <div>=</div> -->
            </div>
            <div class="key--bottom-right key--word key--w4" data-key="8" style="background-color: darkgray;">
                <span>back</span>
            </div>
        </div>
        <div class="keyboard__row">
            <div class="key--bottom-left key--word key--w4" data-key="9"
                 style="background-color: darkgray; margin-left: ">
                <span>tab</span>
            </div>
            <div class="key--letter" data-char="Q">Q</div>
            <div class="key--letter" data-char="W">W</div>
            <div class="key--letter" data-char="E">E</div>
            <div class="key--letter" data-char="R">R</div>
            <div class="key--letter" data-char="T">T</div>
            <div class="key--letter" data-char="Y">Y</div>
            <div class="key--letter" data-char="U">U</div>
            <div class="key--letter" data-char="I">I</div>
            <div class="key--letter" data-char="O">O</div>
            <div class="key--letter" data-char="P">P</div>
            <div class="key--double" data-key="219" data-char="{[">
                <div><sup>{</sup>&nbsp;&nbsp;[</div>

            </div>
            <div class="key--double" data-key="221" data-char="}]">
                <div><sup>}</sup>&nbsp;&nbsp;]</div>

            </div>
            <div class="key--double" data-key="220" data-char="|\">
                <div><sup>|</sup>&nbsp;&nbsp;\</div>

            </div>
        </div>
        <div class="keyboard__row">
            <div class="key--bottom-left key--word key--w5" data-key="20"
                 style="background-color: darkgray; margin-left: 16px;">
                <span>caps lock</span>
            </div>
            <div class="key--letter" data-char="A">A</div>
            <div class="key--letter" data-char="S">S</div>
            <div class="key--letter" data-char="D">D</div>
            <div class="key--letter" data-char="F">F</div>
            <div class="key--letter" data-char="G">G</div>
            <div class="key--letter" data-char="H">H</div>
            <div class="key--letter" data-char="J">J</div>
            <div class="key--letter" data-char="K">K</div>
            <div class="key--letter" data-char="L">L</div>
            <div class="key--double" data-key="186">
                <div><sup>:</sup>&nbsp;&nbsp;;</div>

            </div>
            <div class="key--double" data-key="222">
                <div><sup>"</sup>&nbsp;&nbsp;'</div>
            </div>
            <div class="key--bottom-right key--word key--w5" data-key="13" style="background-color: darkgray;">
                <span>Enter</span>
            </div>
        </div>
        <div class="keyboard__row">
            <div class="key--bottom-left key--word key--w6" data-key="16"
                 style="background-color: darkgray; margin-left: 40px;">
                <span>shift</span>
            </div>
            <div class="key--letter" data-char="Z">Z</div>
            <div class="key--letter" data-char="X">X</div>
            <div class="key--letter" data-char="C">C</div>
            <div class="key--letter" data-char="V">V</div>
            <div class="key--letter" data-char="B">B</div>
            <div class="key--letter" data-char="N">N</div>
            <div class="key--letter" data-char="M">M</div>
            <div class="key--double" data-key="188">
                <div><sup><</sup>&nbsp;&nbsp;,</div>

            </div>
            <div class="key--double" data-key="190">
                <div><sup>></sup>&nbsp;&nbsp;.</div>

            </div>
            <div class="key--double" data-key="191">
                <div>?</sup>&nbsp;&nbsp;/</div>

            </div>
            <div class="key--bottom-right key--word key--w6" data-key="16-R" style="background-color: darkgray;">
                <span>shift</span>
            </div>
        </div>
        <div class="keyboard__row keyboard__row--h3">

            <div class="key--bottom-left key--word key--w1" data-key="17"
                 style="background-color: darkgray; margin-left: 7.8em;">
                <span>control</span>
            </div>
            <div class="key--bottom-left key--word key--w1" data-key="18" style="background-color: darkgray;">
                <span>alt</span>
            </div>

            <div class="key--double key--right key--space" data-key="32" data-char=" ">
                &nbsp;
            </div>

            <div class="key--bottom-left key--word key--w1" data-key="18-R" style="background-color: darkgray;">
                <span>alt</span>
            </div>
            <div class="key--bottom-left key--word key--w1" data-key="17" style="background-color: darkgray;">
                <span>control</span>
            </div>

        </div>
    </div>
    </div>
    </div>
</body>


    <script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/js/key.js') }}"></script>

     <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}">

        </script>
      <script src="{{ url('public/js/a.js') }}"></script>

     <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>



    <script>
        var formData = new FormData();
        formData.append("_token", document.querySelector('meta[name="csrf-token"]').content);
        formData.append("student_id", student_id.value);
        formData.append("institute_id", institute_id.value);
        formData.append("subject_id", subject_id.value);
        formData.append("keboard_practice_id", keboard_practice_id.value);
        formData.append("practise_type", practise_type.value);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
            }
        };
        xhttp.open("POST", "{{ route('student_keboardpractice') }}", true);
        xhttp.send(formData);

        var ALERT_TITLE = "Your Typing Result";
        var ALERT_BUTTON_TEXT = "Ok";
        if (document.getElementById) {
            window.alert = function (txt) {
                createCustomAlert(txt);
            }
        }

        function createCustomAlert(txt) {
            d = document;
            if (d.getElementById("modalContainer")) return;
            mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
            mObj.id = "modalContainer";
            // mObj.style.height = d.documentElement.scrollHeight + "px";
            alertObj = mObj.appendChild(d.createElement("div"));
            alertObj.id = "alertBox";
            if (d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
            alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth) / 2 + "px";
            alertObj.style.visiblity = "visible";
            h1 = alertObj.appendChild(d.createElement("h1"));
            h1.appendChild(d.createTextNode(ALERT_TITLE));
            msg = alertObj.appendChild(d.createElement("p"));
            //msg.appendChild(d.createTextNode(txt));
            msg.innerHTML = txt;
            btn = alertObj.appendChild(d.createElement("a"));
            btn.id = "closeBtn";
            btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
            btn.href = "#";
            btn.focus();
            btn.onclick = function () {
                removeCustomAlert();
                return false;
            }
            alertObj.style.display = "block";
        }

        function removeCustomAlert() {
            document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
        }
        var stop_watch = document.getElementById('stop_watch');
        var time_timer = document.getElementById('time_timer');
        var answer = document.getElementById('answer');
        var question = document.getElementById('question');
        var submit = document.getElementById('submit');
        var timerstop;
        var min = 0;
        var sec = 0;
        var stoptime = true;
        var interval;

        function stopwatch() {
            if (stoptime == true) {
                stoptime = false;
                timerCycle();
            }
        }

        function stopTimer() {
            if (stoptime == false) {
                stoptime = true;
                min = 0;
                sec = 0;
            }
        }

        function timerCycle() {
            if (stoptime == false) {
                sec = parseInt(sec);
                min = parseInt(min);

                sec = sec + 1;
                if (sec == 60) {
                    min = min + 1;
                    sec = 0;
                }
                if (min == 60) {
                    hr = hr + 1;
                    min = 0;
                    sec = 0;
                }
                if (sec < 10 || sec == 0) {
                    sec = '0' + sec;
                }
                if (min < 10 || min == 0) {
                    min = '0' + min;
                }
                // console.log(min + sec);

                time_timer.innerHTML = min + ':' + sec;
                setTimeout("timerCycle()", 1000);
            }
        }

        let startTime;
        // var startTime;
        window.onload = () => {
            let timer

            function startTimer() {
                stop_watch.innerText = 0
                stop_watch.style.fontSize = '30px';
                timer = new Date()
                timerstop = setInterval(() => {
                    stop_watch.innerText = getTimerTime()
                    myTime = getTimerTime()
                }, 1000);

                function getTimerTime() {
                    return Math.floor((new Date() - startTime) / 1000)
                }
            }

            answer.onclick = () => {
                let date = new Date();
                startTime = date.getTime();
                startTimer();
                stopwatch();

            }

            submit.onclick = () => {
                var totalWords = (question.innerHTML.split(" ")).length;
                if ((answer.value.trim()).length > 0) {
                    var wordsCount = (answer.value.split(" ")).length;
                } else {
                    var wordsCount = 0;
                }
                var time = stop_watch.innerText;
                var timeminute = time_timer.innerText;
                var speed = Math.round(((60 / time) * wordsCount));
                var correctWords = accuracy(answer.value, question.innerHTML);
                var acc = Math.round((correctWords / wordsCount) * 100);
                // if (acc != 100){
                var incorrectWords = totalWords - correctWords;
                // }
                // else {
                //     incorrectWords = 0;
                // }

                if (question.value == "asdf ;lkj" || question.value == "कहिी श्यसार" || question.value == "asdfgh ;lkjhj" ||
           question.value == "aq sw de fr ft ;p lo ki ju jy" ||  question.value == "aq sz dx fc fv ;. l, km jn jb") {
                alert('Practises submited sucessfully');
                typing_result(correctWords, acc, incorrectWords, timeminute, speed);
                clearInterval(timerstop);
                stopTimer();
                answer.value = "";

            }
            else{
                alert("<label style=color:green>correctWords=" + correctWords + "</label><br><label style=color:green>Accuracy=" + acc + "%</label>" + "<br><label style=color:red>IncorrectWords=" + incorrectWords + "</label><br><label style=color:black>Total Time=" + timeminute + "Min</label><br>Speed=" + speed + "wpm");
                typing_result(correctWords, acc, incorrectWords, timeminute, speed);
                clearInterval(timerstop);
                stopTimer();
                answer.value = "";

            }
            }
            const accuracy = (str, question) => {
                question = (question.split(" "));
                let count = 0;
                // console.log(question);
                str.trim().split(" ").forEach(function (item) {
                    // console.log("item: "+item+ question.indexOf(item));
                    if (question.indexOf(item) > -1)
                        count++;
                });
                return count;
            }
        }

        function typing_result(correctWords, acc, incorrectWords, timeminute, speed) {
            var student_id = document.getElementById("student_id");
            var institute_id = document.getElementById("institute_id");
            var subject_id = document.getElementById("subject_id");
            var keboard_practice_id = document.getElementById("keboard_practice_id");
            var practise_type = document.getElementById("practise_type");
            var formData = new FormData();
            formData.append("_token", document.querySelector('meta[name="csrf-token"]').content);
            formData.append('correctWords', correctWords);
            formData.append('acc', acc);
            formData.append('incorrectWords', incorrectWords);
            formData.append('timeminute', timeminute);
            formData.append('speed', speed);
            formData.append('student_id', student_id.value);
            formData.append('institute_id', institute_id.value);
            formData.append('subject_id', subject_id.value);
            formData.append('keboard_practice_id', keboard_practice_id.value);
            formData.append('practise_type', practise_type.value);

            // console.log(student_type.value);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    // var response = JSON.parse(this.responseText);
                }
            };
            xhttp.open("POST", "{{ route('keboard_practice') }}", true);
            xhttp.send(formData);
        }

        if (question.value == "asdf ;lkj" || question.value == "कहिी श्यसार" || question.value == "asdfgh ;lkjhj" ||
           question.value == "aq sw de fr ft ;p lo ki ju jy" ||  question.value == "aq sz dx fc fv ;. l, km jn jb") {
            question.style.width = "500px";
            question.style.height = "265px";
            question.style.fontSize = "75px";
        }

    </script>
</html>
