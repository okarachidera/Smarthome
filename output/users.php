    <?php 
    include ('../header.php');

  ?>
<html lang="en">
    <head>

    <!--  Page css -->
    
    
        <link rel="stylesheet" href="..\css\bootstrap-4.5.3-dist\css\bootstrap.min.css" >
    <link rel="stylesheet" href="..\css\bootstrap-4.5.3-dist\css\bootstrap.min.css.map" >
 <link rel="stylesheet" href="..\css\bootstrap-4.5.3-dist\css\bootstrap-toggle.min.css">


 <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.bundle.js"></script>
    <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.bundle.js.map"></script>
    <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js.map"></script>
    <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.js.map"></script>
    <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.min.js.map"></script>

    <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.js"></script>
    <script src="../css/bootstrap-4.5.3-dist/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="../css/bootstrap-4.5.3-dist/js/dataTables.bootstrap4.min.js"></script>


<!-- button status css and jquery -->
   <script src="..\css\bootstrap-4.5.3-dist\js\jquery.min.js"></script>
  <link rel="stylesheet" href="..\css\bootstrap-4.5.3-dist\css\bootstrap.min.css" >
  <script src="../css/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <script src="..\css\bootstrap-4.5.3-dist\js\bootstrap-toggle.min.js"></script>
  <script src="..\css\bootstrap-4.5.3-dist\js\jquery.dataTables.min.js"></script>

  <link rel="stylesheet" href="..\css\bootstrap-4.5.3-dist\css\bootstrap-toggle.min.css">
  <link rel="stylesheet" href="../css\bootstrap-4.5.3-dist/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../css\bootstrap-4.5.3-dist/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" href="..\css\style.css" >
    <link rel="stylesheet" href="..\css\newstyle.css" >
    <link rel="stylesheet" href="..\css\output.css" >

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"/> -->
 
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

  </head>


    <body>

    <style>

#a {
  table-layout: auto;
  width:400px;  
}

@media only screen and (max-width: 1000px){
    #a {
        table-layout: auto;
        width:600;  
      }#rowmbc{
        padding-left:50px
      }
}
    </style>



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

                  <!--Grid column-->
                  <div class="col-lg-5 mt-xl-5 mb-5 wow" data-wow-delay="0.3s" id="phonevw">
        
                    <div class="smartphone" id="">
                        <div class="content"style="background-color: white;">
                          
                            <div class="row">
    

                              <div class="col-4">
                              <form action="../index.php">
                                <button class="btn btn-primary">Home</button>
                              </form>
                              </div>
                              <div class="col-4">
                                  
                                  <p id="statusdate"></p>
                                    <script>
                                      var d = new Date();
                                      var n = d.toLocaleTimeString();
                                      document.getElementById("statusdate").innerHTML = n;
                                    </script>
                              </div>

                              <div class="col-12" >
                              <h5 class="text-center">OTP GENERATION TABLE</h5>
                              </div>
                              <div class="row" id="rowmbc" >
                              <table class="table table-bordered table-striped table-hover" id="a">
                              <thead>
                              <tr>
                              <th>User</th> 
                              <th>OTP Code</th>
                              <th>OTP Timer</th>
                              <th>status</th>
                              </tr>
                              </thead>
                              <tbody>

                              <?php
                                $sqlse = mysqli_query($conn,"select * from user");
                                while($rw = mysqli_fetch_array($sqlse)){
                            
                                $firstname=$rw['firstname'];
                                $lastname=$rw['lastname'];
                                $email=$rw['email'];
                                $otp_code=$rw['otp_code'];
                                $otp_timer=$rw['otp_timer'];
                                $block_timer=$rw['block_timer'];                                 
                                $d=time();
                                $t= date("Y-m-d h:i:s");



                                    
                            
                            
                            
    ?>

<tr>
                        <td>
                            <?php echo $firstname.' '.$lastname;?>
                        </td>
                        <td>
                            <?php echo $rw['otp_code'];?></td>
                            <td>
                            <?php echo $rw['otp_timer'];?>
                        </td>
                        <td>
                            <?php 
                            if($otp_timer<$t){
                                echo 'expired' ;
                            }
                            else{
                                echo 'valid';
                            }
                                ?>
                        </td>

                        </tr>
                            <?php
                                }
                                        
?>


                                              
                              </tbody>
                              </table>
                              
 
                                  

									
                                </div>
                                
                      
                              

                            
                            

                            
            
                        </div>
                  </div>
                  <div class="mt-xl-5 wow" data-wow-delay="0.3s">
                    
                    
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
  $('table').DataTable({
     bJQueryUI: true,
        "sPaginationType": "simple_numbers",
    "iDisplayLength": 3,
    "searching": false,
    //"ordering": false,
    "info":     false,
    "lengthChange": false

    

    
  });
});

$.fn.DataTable.ext.pager.numbers_length = 5;





</script>




    </body>
</html>