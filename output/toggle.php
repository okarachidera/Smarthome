<?php
//index.php
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Toggle Button</title>
  <!--  Page css -->
  <script src="..\css\bootstrap-4.5.3-dist\js\jquery.min.js"></script>
  <link rel="stylesheet" href="..\css\bootstrap-4.5.3-dist\css\bootstrap.min.css" >
  <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <script src="..\css\bootstrap-4.5.3-dist\js\bootstrap-toggle.min.js"></script>
  <link rel="stylesheet" href="..\css\bootstrap-4.5.3-dist\css\bootstrap-toggle.min.css">
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:600px;">
   <h2 align="center">Toggle Button</h2><br /><br />
   <form method="post" id="insert_data">
    <div class="form-group">
     <label>Enter Name</label>
     <input type="text" name="name" id="name" class="form-control" />
    </div>
    <div class="form-group">
     <label>Define Gender</label>
     <div class="checkbox">
      <input type="checkbox" name="gender" id="gender" checked />
     </div>
    </div>
    <input type="hidden" name="hidden_gender" id="hidden_gender" value="Male" />
    <br />
    <input type="submit" name="insert" id="action" class="btn btn-info" value="Insert" />
   </form>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#gender').bootstrapToggle({
  on: 'Male',
  off: 'Female',
  
  onstyle: 'success',
  offstyle: 'danger'
 });

 $('#gender').change(function(){
  if($(this).prop('checked'))
  {
   $('#hidden_gender').val('Male');
  }
  else
  {
   $('#hidden_gender').val('Female');
  }
 });

 $('#insert_data').on('submit', function(event){
  event.preventDefault();
  if($('#name').val() == '')
  {
   alert("Please Enter Name");
   return false;
  }
  else
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data){
     if(data == 'done')
     {
      $('#insert_data')[0].reset();
      $('#gender').bootstrapToggle('on');
      alert("Data Inserted");
     }
    }
   });
  }
 });

});
</script>