 <?php	include ('../header.php');
 
 ?>
<html lang="en">
    <head>
    <!--  Page css -->
 <?php include("../include/sectioncss.php") ?>

 
    </head>
    <body>

 
          <!-- Full Page Intro -->
          <div class="view" style="background-image: url('../img/architecture.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-gradient align-items-center">
              <!-- Content -->
              <div class="container">
                <!--Grid row-->
                <div class="row">
                  
                  <!--Grid column-->
                  <div class="col-lg-5 mt-xl-5 mb-5 wow " data-wow-delay="0.3s" id='header1'>
                    <h1 class="h1-responsive font-weight-bold mt-sm-5"> Predicting Home User Activities In a Secured Smart home Using Deep Learning</h1>
                    <hr class="hr-light">
                    <h4 class="">By</h4>
                    <h4 class="mb-4 font-weight-bold">OKARA, Chidera Chibuzor PG.2018/01273</h4> 
                  </div>

                  <!--Grid column-->
                  <div class="col-lg-5 mt-xl-5 mb-5 wow" data-wow-delay="0.3s" id="phonevw">
        
                    <div class="smartphone" >
                        <div class="content"style="background-image: url(../img/saver.jpg);">
                        <div class="row" id="rowmbc">
                                <div class="col-4">
                                <form action="../index.php">
                                                 <button class="btn btn-primary">Home</button>

                                </form>
                                </div>
                                <div class="col-4">
                                    
                                    <p id="statusdate" style="color:yellow;"></p>
                                      <script>
                                        var d = new Date();
                                        var n = d.toLocaleTimeString();
                                        document.getElementById("statusdate").innerHTML = n;
                                      </script>
                                </div>

                        </div>   
                            <div class="row" id="rowmbc">
                                <div class="col-3">

                                </div>

                                <div class="col-5">
                                  <br>

                                    <form method="post" id="insert_data">
                                
                                   <label class="boldsm">Alarm Status</label>
  
                                    <input type="checkbox" name="gender" id="gender" checked />

                                    <input type="hidden"  name="hidden_gender" id="hidden_gender" value="Male" />
                                    <br />
                                    <input type="submit" name="insert" id="action" class="btn btn-info" value="Insert" />
                                  </form> 
                                </div>

                                

                                <div class="col-3">

                                </div>
                                <div class="row">
                                <div class="col-4">


                                  </div>
                                  <div class="col-6" style="background-color:white; width:300px; height:100px" >
                                  <br>
                                    <span style="font-weight:bold; padding-left:30px; padding-right:10px;">Prediction<span>
                                    <span style="font-weight:500; padding-left:30px; padding-right:10px;">7:25 AM<span>

                                  </div>



                                </div>
                            </div>
                            <br>

                            </div>
                            <br>


                            <!-- <div class="row">

                                <div class="col-4">

                                </div>

                                <div class="col-4" id="homebtn">
                                    <a href="../index.php"><img src="../icons/home.png" alt="" height="80px"></a>
                                </div>

                                <div class="col-4">

                                </div>
                            </div> -->
                        
                            
            
                        </div>
                  </div>
                  <div class="col-lg-5 mt-xl-5 mb-5 wow" data-wow-delay="0.3s" >
                    
                  </div>
                  <!--Grid column-->
                </div>
                <!--Grid row-->
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
          <!-- Full Page Intro -->
        </header>
        <!-- Main navigation -->
        <script>
 $(document).ready(function(){
 
  $('#gender').bootstrapToggle({
   on: 'on',
  off: 'off',
  
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

    </body>
</html>