<html lang="en">
    <head>

    <!--  Page css -->
    <?php include("..\include\outputstyle.php");
include '../header.php';

  ?>
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

div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: 100px;
    margin-right: 30px;
}
    </style>


<!-- check for average time device is turned off in the daytime pm -->                                                                   <?php
					$pred = mysqli_query($conn,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(date))) as avgtime 
					FROM appliance where appliance_name = 'Sound System' and status='off' and time(date) between '12:00' and '24:00'");								
            $rp = mysqli_fetch_array($pred);
            $day_pm= $rp['avgtime'];
            $round_pm_off = date('H:i', round(strtotime($day_pm)/60)*60);	
            ?>
          <!-- check for average time device is turned on in the daytime pm -->                                                                   <?php
					$pred3 = mysqli_query($conn,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(date))) as avgtime 
					FROM appliance where appliance_name = 'Sound System' and status='on' and time(date) between '12:00' and '24:00'");								
            $rp3 = mysqli_fetch_array($pred);
            $day_pm_on= $rp['avgtime'];
            $round_pm_on = date('H:i', round(strtotime($day_pm_on)/60)*60);	
            ?>
            
            <!-- check for average time device is turned off in the morning am -->
         <?php           
          $pred2 = mysqli_query($conn,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(date))) as avgtime2 
					FROM appliance where appliance_name = 'Sound System' and status='off' and time(date) between '01:00' and '12:00'");
									
            $rp2 = mysqli_fetch_array($pred2);
            $morning_pm= $rp2['avgtime2'];	
            $round_am_off = date('H:i', round(strtotime($morning_pm)/60)*60);				
            ?>

          <?php           
          $pred4 = mysqli_query($conn,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(date))) as avgtime2 
					FROM appliance where appliance_name = 'Sound System' and status='on' and time(date) between '01:00' and '12:00'");
									
            $rp4 = mysqli_fetch_array($pred2);
            $morning_pm_on= $rp2['avgtime2'];
            $round_am_on = date('H:i', round(strtotime($morning_pm_on)/60)*60);				
            ?>





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
                              <h5 class="text-center">Sound System History</h5>
                              </div>
                              <div class="row" id="rowmbc" >
                              <table class="table table-bordered table-striped table-hover" id="a">
                              <thead>
                              <tr>
                              <th>Date</th> 
                              <th>Status</th>
                              <th>Actual Time</th>
                              <th>Predicted Time</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php           
          $pred5 = mysqli_query($conn,"SELECT * FROM appliance 
          where appliance_name = 'Sound System'  and time(date) between '01:00' and '12:00'");
									
            while($rw = mysqli_fetch_array($pred5)){
                $datenow=$rw['date'];
                $status=$rw['status'];
                $timeonly= date("h:i:s", strtotime( $datenow));  
                // $t= date("Y-m-d h:i:s", strtotime('+10 minutes', $d));
          
                         
            ?>
                              <tr>
                              
 
                              <td><?php echo $datenow ?></td>
                              <td><?php echo $status ?></td>
                              <td><?php echo $timeonly ?></td>
                              <td>
                              <?php 
                              if ($timeonly> '01:00' && $timeonly<'12:00' && $status=='on'){
                                echo $morning_pm ;

                              }
                              ?>
                              </td>
                              </tr>
                              <?php } ?>

                              </tbody>  
                              </table>
                              
 

					<!--
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active">
                                      <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
									
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
-->                                   

									
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
        
    "iDisplayLength": 2,
    // "searching": false,
    "ordering": false,
    "info":     false,
    "lengthChange": false,

    

    
  });
});

$.fn.DataTable.ext.pager.numbers_length = 5;





</script>




    </body>
</html>