<h1>Uplode File</h1>
<form action="upload" method="POST" enctype="multipart/from-data">
@method('POST')
    @csrf
    <!-- <input type="text" name="myname"> -->
    <input type="file" name="file"/> <br> <br>
    <button type="submit"> Uplode File</button>
</form>  