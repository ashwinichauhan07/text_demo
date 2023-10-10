window.onload =()=> {

    setInterval(function(){
      timestamp();
      }, 2000);

    }

function timestamp() {

//   var student_id = document.getElementById('student_id')

         var formData = new FormData();
          formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
        //   formData.append('student_id', student_id.value)

          var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  // console.log(this.responseText);
                  var response = JSON.parse(this.responseText);
                  //console.log(response.status);
                  if (response.status) {
                      // console.log(response.data);
                      //console.log(subject_id.options.length=0);
                  }
              }
            };

            xhttp.open("POST", "http://localhost/eswift/student/student_session", true);
            xhttp.send(formData);


    }
