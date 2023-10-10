 


<style>
	modalContainer {
  background-color:rgba(0, 0, 0, 0.3);
  position:absolute;
  width:100%;
  height:100%;
  top:0px;
  left:0px;
  z-index:10000;
  background-image:url(tp.png); /* required by MSIE to prevent actions on lower z-index elements */
}

#alertBox {
  position:relative;
  width:400px;
  padding: 15px;
  min-height:50px;
  margin-top:50px;
font-family: Arial, Helvetica, sans-serif;
  border:3px solid #357EBD;
  background-color:#fff;
  background-repeat:no-repeat;
  background-position:20px 30px;
  text-align: center;
  color:  #000000;
   font:1.3em verdana,arial;


}

#modalContainer > #alertBox {
  position:fixed;
}

#alertBox h1 {
  margin:0;
  font:bold 0.9em verdana,arial;
  background-color:#3073BB;
  color:#FFF;
  border-bottom:1px solid #000;
  padding:2px 0 2px 5px;
}

#alertBox p {
  font:0.9em verdana,arial;
  /*height:100px;
  padding-left:5px;
  padding: 15px;
  margin-left:55px;*/
  font-weight: 600;
}

#alertBox #closeBtn {
  display:block;
  position:relative;
  margin:5px auto;
  padding:7px;
  border:0 none;
  width:70px;
  font:0.7em verdana,arial;
  text-transform:uppercase;
  text-align:center;
  color:#FFF;
  background-color:#357EBD;
  border-radius: 3px;
  text-decoration:none;
}

/* unrelated styles */
</style>

 <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <!-- <h4>Notice :</h4> -->
    <table>
      <tr>
        <!-- <th>Sr No</th> -->
        <th style="font-size: 22;">Notice:</th>
      </tr>
      <tr>
     
      </tr>
    </table>
    <table>
      <tr>
        <th style="font-size: 24;">Tips:</th>
      </tr>
      <tr>
        <td>1</td>
        <td>Try to not look at the keyboard while practicing</td>
      </tr>
      <tr>
        <td>2</td>
        <td> Know the finger positions.</td>
      </tr>
      <tr>
        <td>3</td>
        <td> Use the Shift keys</td>
      </tr>
      <tr>
        <td>4</td>
        <td>Be Patient.</td>
      </tr>
    </table>



<script>

	var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>