

             window.onload =()=> {
              var time = new Date();
              var str = time.toString().split(" ");

              var newtime = str[4];
               var start_time = newtime.split(':');

               var milliseconds = time.setHours(start_time[0], start_time[1], start_time[2], 0);

               var minutes = Math.floor(milliseconds / 60000);
                // console.log(minutes);
              localStorage.setItem("key", minutes);
              // var lastname = localStorage.getItem("key");
              // console.log(lastname);
              setInterval(function(){
                timestamp();
                }, 1000);
          }
          function timestamp() {
                var new_time = new Date();
                var new_str = new_time.toString().split(" ");

                var endtime = new_str[4];
                  // console.log(endtime);
                 // Number(endtime);
                var end_time = endtime.split(':');
                var starttime = localStorage.getItem("key");

                var milliseconds1 = new_time.setHours(end_time[0], end_time[1], end_time[2], 0);
                var minutes1 = Math.floor(milliseconds1 / 60000);
            //   console.log(starttime);
                if (localStorage.getItem("key")) {
                  var timediff =  minutes1 -starttime
                   console.log(timediff);
                    // if (timediff == 2
                    //     ) {}
                   var formData = new FormData();
                    formData.append("_token",document.querySelector('meta[name="csrf-token"]').content);
                    formData.append("timediff",timediff);

                    // console.log(course_id.value);
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

                      xhttp.open("POST", "http://localhost/eswift/student/attendance", true);

                      xhttp.send(formData);

                }
                //    }
                }
