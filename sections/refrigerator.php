 <?php	include ('../header.php');
 
 ?>
<html lang="en">
    <head>
    <!--  Page css -->
 <?php include("../include/sectioncss.php") ?>

 
    </head>
    <body>

 <!-- check for average time device is turned off in the daytime pm -->                                                                   <?php
					$pred = mysqli_query($conn,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(date))) as avgtime 
					FROM appliance where appliance_name = 'Refrigerator' and status='off' and time(date) between '12:00' and '24:00'");								
           
           $rp = mysqli_fetch_array($pred);
            $day_pm= $rp['avgtime'];
            $round_pm_off = date('H:i', round(strtotime($day_pm)/60)*60);	
            ?>
          <!-- check for average time device is turned on in the daytime pm -->                                                                   <?php
					$pred3 = mysqli_query($conn,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(date))) as avgtime 
					FROM appliance where appliance_name = 'Refrigerator' and status='on' and time(date) between '12:00' and '24:00'");								
            $rp3 = mysqli_fetch_array($pred);
            $day_pm_on= $rp['avgtime'];
            $round_pm_on = date('H:i', round(strtotime($day_pm_on)/60)*60);	
            ?>
            
            <!-- check for average time device is turned off in the morning am -->
         <?php           
          $pred2 = mysqli_query($conn,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(date))) as avgtime2 
					FROM appliance where appliance_name = 'Refrigerator' and status='off' and time(date) between '01:00' and '12:00'");
									
            $rp2 = mysqli_fetch_array($pred2);
            $morning_pm= $rp2['avgtime2'];	
            $round_am_off = date('H:i', round(strtotime($morning_pm)/60)*60);				
            ?>

          <?php           
          $pred4 = mysqli_query($conn,"SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(date))) as avgtime2 
					FROM appliance where appliance_name = 'Refrigerator' and status='on' and time(date) between '01:00' and '12:00'");
									
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
                    <h1 class="h1-responsive font-weight-bold mt-sm-5">Predicting Home User Activities In a Secured Smart home Using Deep Learning</h1>
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

                                <div class="col-6">


                           <form method="post" id="insert_data">
                                
                              <label class="boldsm">Refrigerator Status</label>
  
                              <input type="checkbox" name="status" id="status" <?php appliance_status("Refrigerator");?>/>

                               <input type="hidden"  name="hidden_refrigerator" id="hidden_refrigerator" value="on" />
							   
							   <input type="hidden"  name="hidden_ref" id="refrigerator" value="Refrigerator" />
                                    <br />
                               <input type="submit" name="insert" id="action" class="btn btn-info" value="Process" />
                                  </form> 
									
                                </div>

                                

                                <div class="col-3">

                                </div>
                                <div class="row">                                 
                                  <div class="col-12"style="margin-left:10%; width:100%">
                                  <button class="accordion" style="text-align:center;">Refrigerator Prediction</button>
                                  <div class="panel">
                                  <br>
								
                                      <span style="font-weight:500;  padding-right:10px;">
                                      <?php
                                      $chistatus= chidi('Refrigerator');
                                      $dd = date("H:i:s");
                                      if($dd >"01:00:00" && $dd<"12:00:00" && $chistatus=='off'){
                                        //$rounded = round($morningtel);

                                        echo "<p>Predicted device turnon at <span class='chiopen'>$round_am_on am </span> </p>";
                                        
                                    }
                                    elseif($dd >="01:00:00" && $dd<="12:00:00" && $chistatus=='on'){

                                      echo "<p>Predicted device turnoff at <span class='chiclose'>$round_am_off am </span> </p>";
                                      
                                    }
                                    elseif($dd >"12:00:00" && $dd<="24:60:00" && $chistatus=='off'){
                                    //print daytime off analysis
                                      echo "<p>Predicted  turnon at  <span class='chiopen'>$round_pm_on pm </span> </p>";

                                      
                                    }
                                    elseif($dd >"12:00:00" && $dd<="24:60:00" && $chistatus=='on'){
                                      //print daytime off analysis
                                        echo "<p>Predicted  turnoff at <span class='chiclose'>$round_pm_off.'pm' </span> </p>";
                                        
                                      }


                                    
                                      ?>
                                      
                                    <span>
                                      <br>
                                      <br>

                                 
                                

                                
                            </div>
                           

                            </div>

                            
            
                        </div>
                  </div>
                  <div class="col-lg-5 mt-xl-5 mb-5 wow" data-wow-delay="0.3s">
                    
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
 
  $('#status').bootstrapToggle({
   on: 'on',
  off: 'off',
  
   onstyle: 'success',
   offstyle: 'danger'
  });

  $('#status').change(function(){
   if($(this).prop('checked'))
   {
    $('#hidden_refrigerator').val('on');
   }
   else
   {
    $('#hidden_refrigerator').val('off');
   }
  });

  $('#insert_data').on('submit', function(event){
   event.preventDefault();
   var stat =  $('#hidden_refrigerator').val();
   
//alert(stat);
   $confirm = confirm("Are you sure you want to switch "+stat+ " the Refrigerator? ");
   if($confirm == true)
   {
	  
    var form_data = $(this).serialize();
    $.ajax({
     url:"process.php",
    method:"POST",
    data:form_data,
     success:function(data){
      if(data == 'done')
      {
       $('#insert_data')[0].reset();
       $('#status').bootstrapToggle('on');
       alert("Operation performed successfully");
	   window.location = '../index.php';
      }
     }
    });
   }
 });

 });


</script>


<!-- Accordian js -->
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>


    </body>
</html>