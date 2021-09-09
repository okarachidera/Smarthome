<?php  include 'header.php'; ?>

<html lang="en">
    <head>
      <!-- Page css -->
      <?php include('include/homecss.php'); ?>

    </head>
    <body>

    <?php

    if(isset($_SESSION['user_type'])){

     $usertype=$_SESSION['user_type'];
    }
?>

<style>
.adminuser{
  display:<?php

      if($usertype=='adminuser'){
        echo'block';
      }
      else{
        echo 'none';
      }
  ?>
}

</style>



          <!-- Full Page Intro -->
          <div class="view" style="background-image: url('img/architecture.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-gradient align-items-center">
              <!-- Content -->
              <div class="container">
                <!--Grid row-->
                <div class="row">
                  <!--Grid column-->
                  <div class="col-lg-5 mt-xl-5 mb-5 wow " data-wow-delay="0.3s" id='header1'>
                    <h1 class="h1-responsive font-weight-bold mt-sm-5">Prediction of Home User Activities In a Secured Smart home Using IoT and Deep Learning</h1>
                    <hr class="hr-light">
                    <h4 class="">By</h4>
                    <h4 class="mb-4 font-weight-bold">OKARA, Chidera Chibuzor PG.2018/01273</h4> 
                  </div>
                  <!--Grid column-->
                  <!--Grid column-->
                  <div class="col-lg-5 mt-xl-5 mb-5 wow" data-wow-delay="0.3s" id="phonevw">
        
                    <div class="smartphone" id="">
                        <div class="content"style="background-image: url(img/saver.jpg);">
                            <div class="row">
                            <nav class="navbar navbar-dark bg-dark navbar-fixed-top">
                              
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                              </button>
                              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav ">
                                  <li class="nav-item active">
                                    <a class="nav-link" href="output/refrigerator-output.php">Refrigerator <span class="sr-only">(current)</span></a>
                                  </li>

                                  <li class="nav-item">
                                    <a class="nav-link" href="output\alarm-output.php">Alarm</a>
                                  </li>
                                  
                                  <li class="nav-item">
                                    <a class="nav-link " href="output\light-output.php">
                                      Lighting
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="output\air-condition-output.php">Air Condition</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="output\sound-system-output.php">Sound system</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="output\television-output.php">Television</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="output\doorlock-output.php">Door Lock</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Log Out</a>
                                  </li>
                                  <li class="nav-item adminuser">
                                    <a class="nav-link" href="output/users.php">Users</a>
                                  </li>
                                  <li class="nav-item adminuser">
                                    <a class="nav-link" href="register.php">Register</a>
                                  </li>

                                </ul>
                              </div>
                            </nav>    

                                <div class="col-4">
                                <span style="color:#fff;"><?php 
                                    $sub = substr($lastname,0,1);
                                    echo $surname.' '.$sub;?></span>
                                </div>
                                <div class="col-4">
                                
                                <p id="statusdate"></p>

                                  <script>
                                    var d = new Date();
                                    var n = d.toLocaleTimeString();
                                    document.getElementById("statusdate").innerHTML = n;
                                  </script>
                            </div>
                            <div class="row" id="rowmbc">
                                <!--<div class="col-4">-->
                                <!--    <a href="#"><img src="icons/iconfinder_google_podcasts_new_logo_7115256.svg" alt="" height="50px"></a>-->
                                <!--</div>-->
                                <div class="col-4">
                                    <a href="output/dictionary-attacks.php">
                                    <img src="icons/iconfinder_f-shield_256_282458.png" alt="" height="50px"></a>
                                </div>
                                <!--<div class="col-4">-->
                                <!--    <a href="#"><img src="icons/iconfinder_photoshop_2318048.svg" alt="" height="50px"></a>-->
                                <!--</div>-->
                                <!--<div class="col-4">-->
                                <!--    <a href="#"><img src="icons/iconfinder_google_chrome_new_logo_7115262.svg" alt="" height="50px"></a>-->
                                <!--</div>-->
                                <!--<div class="col-4">-->
                                <!--    <a href="#"><img src="icons/iconfinder_google_maps_new_logo_7115251.svg" alt="" height="50px"></a>-->
                                <!--</div>-->
                                <!--<div class="col-4">-->
                                <!--    <a href="#"><img src="icons/iconfinder_google_photos_new_logo_7115257.svg" alt="" height="50px"></a>-->
                                <!--</div>-->
                                <div class="col-4">
                                    <a href="sections/refrigerator.php"><img src="icons/smart-fridge.png" alt="" height="50px"></a>
                                </div>
                                <!--<div class="col-4">-->
                                <!--    <a href="#"><img src="icons/iconfinder_google_search_new_logo_7115255.svg" alt="" height="50px"></a>-->
                                <!--</div>-->
                                <!--<div class="col-4">-->
                                <!--    <a href="#"><img src="icons/iconfinder_google_maps_new_logo_7115251.svg" alt="" height="50px"></a>-->
                                <!--</div>-->
                                <!--<div class="col-4">-->
                                <!--    <a href="sections/alarm.php"><img src="icons/bell.svg" alt="" height="50px"></a>-->
                                <!--</div>-->
                                <div class="col-4">
                                    <a href="sections/light.php"><img src="icons/iconfinder_Eco_bulb_energy_light_2992437.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/ac.php"><img src="icons/air-conditioning.png" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/sound-system.php"><img src="icons/iconfinder_kmixdocked_error_7209.png" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/television.php"><img src="icons/iconfinder_Rounded_-_High_Ultra_Colour05_-_Television_2250027.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/doorlock.php"><img src="icons/iconfinder_Login_49249.png" alt="" height="50px"></a>
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



    </body>
</html>