<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    .timer{
    position: absolute;
    width: 100%;
    top:20px;
    font-size: 50px;
    color:green;
    font-weight: bold;
    /*text-align: right;*/
    margin: auto;
    padding-left: 23em;
}
  </style>
  <title>Typing Speed & Accuracy</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&family=Kumbh+Sans&family=Ranchers&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kufam:wght@500&display=swap" rel="stylesheet"> 
  <script src="https://kit.fontawesome.com/bed09b7a7a.js" crossorigin="anonymous"></script>

<style>
  *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Josefin Sans', sans-serif;
  }
body{
  background-color: black;
  /*animation: background;
  animation-duration: 30s;
  animation-fill-mode: forwards;
animation-iteration-count: infinite;*/
}
  
.main{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

}

.content{

  text-align: center;
  }

.content h1{
  /* font-family: 'Kufam', cursive; */
}

#message{
  font-family: 'Kumbh Sans', sans-serif;

}

#text{
  font-size: 20px;
  width: 85%;
}
  textarea:focus{
    
    animation: border-color-change;
    animation-duration: 10s;
    animation-fill-mode: forwards;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    
  }
@keyframes background{
  0%{
    background-color: rgb(115, 168, 87);
  }
  50%{
    background-color: skyblue;
  }
  100%{
    background-color: #FF8C00;
  }

}
  @keyframes border-color-change{
    0%{
      border: 3px solid white  ;
    }

    100%{
      border: 3px solid  black;
    }
    
  }

</style>

</head>

<body >


<div class="timer" id="timer"></div>
  <div class="main my-5">


      <div class="content container-fluid">
        

          <h1 class="text-white font-weight-bold"> Check your Typing Speed & Accuracy </h1> <br>

          <input type="text" name="student_id" value="{{ auth()->id() }}" id="student_id" hidden>
           <input type="text" name="institute_id" value="{{ $capitalword->institute_id }}" id="institute_id" hidden>

          <h3 id="message"  class="text-white mx-4 text-center my-4">{{$capitalword->desc}}</h3>

          <textarea tabindex="0" autocomplete="off" id="text" rows="10" onclick=";
          "class=" bg-dark text-white" ></textarea>
          <br>
          <button class="btn btn-light px-4" id="start-btn" style="font-size: 25px;">Start</button>&nbsp;
          <a class="btn btn-light px-4" href="{{ url()->previous() }}" style="font-size: 25px;"> <i class="fas fa-arrow-circle-left"style="font-size: 25px;"></i></a>
          </div>

     <div id="result" class="mt-2 pt-2 text-center">
          
          <h4  class="text-white"></h4>

      </div>

  </div>

</body>
<script>
   

window.onload =()=> {
       var text = document.getElementById('text');
      var message = document.getElementById('message');
      let button= document.getElementById("start-btn");



       
$(document).ready(function() {
  const timerElement = document.getElementById("timer")
console.log(timerElement);
let text= document.getElementById("text");
let message= document.getElementById("message");
let result= document.getElementById("result");
let startTime, endTime;

text.disabled=true;

const SetofWords= [ 


];



let timer 
function startTimer(){
    timerElement.innerText = 0
    timer = new Date()
    setInterval(() => {
        timerElement.innerText = getTimerTime()
        myTime = getTimerTime()
    }, 1000);
}
function getTimerTime(){
    return Math.floor((new Date() - startTime) / 1000)
}

const start = () => {
let index= Math.floor(Math.random()*SetofWords.length);
$("#message").html(SetofWords[index]);
let date= new Date();
startTime = date.getTime();
// startTimer();

// loadDoc();
}

const end= () => {
  let date= new Date();
  let endTime= date.getTime();
  let timeTaken= (endTime-startTime-800)/1000;
   console.log(startTime);
    console.log(endTime);
  console.log(timeTaken);

 let time = Math.round(timeTaken);

 var minutes = Math.floor(time / 60);

  let totalWords= (message.innerText.split(" ")).length;
  if((text.value.trim()).length>0)
  {
    var wordsCount= (text.value.split(" ")).length;
  }
  else {
    var wordsCount=0;
  }

  // console.log(totalWords+ " "+wordsCount+message.innerText);
  
  var speed= Math.round(((60/timeTaken)*wordsCount));

  var correctWords=accuracy(text.value,message.innerText);

  var acc=Math.round((correctWords/wordsCount)*100);
  // console.log('Total Words:'+wordsCount+ 'Correct Words:'+correctWords);
  

  $("#result h4").html(`Speed:  ${speed} wpm <br> 
            Words Typed: ${wordsCount}  <br> 
            Correct Words: ${correctWords} <br> 
            Time Taken: ${time} Sec <br> 
            Accuracy: ${Math.round((correctWords/wordsCount)*100)}%`);
  
  $("#text").prop("disabled",true);

  typing_result(speed,wordsCount,correctWords,time,acc);
}

const accuracy = (str,message) => {

message=(message.split(" "));
let count=0;
// console.log(message);
 str.trim().split(" ").forEach(function (item) { 
            // console.log("item: "+item+ message.indexOf(item)); 
            if(message.indexOf(item) > -1)
              count++;
         
        }); 
 return count;
}


button.addEventListener('click',function(){
    // console.log("Clicked ");
  if(this.innerText === "Start")
  { 
    $("textarea").val("");
    console.log('Started');
    startTimer();
    this.innerText="Show Result";
    $("#result").fadeOut();
    $("#text").prop("disabled",false);
    start();
    // loadDoc();
    // 
    

  }
  else
  { 
    $("#result").fadeIn();
    // console.log('Stopped');
    $(this).html("Start");
    
    end();
    
  }
});

});

function typing_result(speed,wordsCount,correctWords,time,acc){

  var student_id= document.getElementById("student_id");
 var institute_id= document.getElementById("institute_id");

  // console.log(document.querySelector('meta[name="csrf-token"]').content);
 // console.log(institute_id.value);
 // console.log("wordsCount "+wordsCount);
 // console.log("correctWords "+correctWords);
 // console.log("time "+time);
 // console.log("acc "+acc);
           var formData = new FormData();
           formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
           formData.append('speed',speed);
           formData.append('wordsCount',wordsCount); 
           formData.append('correctWords',correctWords);  
           formData.append('time',time);
           formData.append('accuracy',acc);
           formData.append('student_id',student_id.value);
           formData.append('institute_id',institute_id.value);

           // console.log(student_type.value);
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function(){
                  if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
                var response = JSON.parse(this.responseText);
                 
              }
            };

              xhttp.open("POST","{{ route('capitalword_result') }}", true);
              xhttp.send(formData);

}

       
}


     



</script>



</html>
