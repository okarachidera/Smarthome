<html lang="en">
    <head>

    </head>
    <body>

    <?php
    include('include/header.php');
    ?>


<style>
  ul {

  list-style-type: none;
  background-color: #333;
  position: fixed;
  z-index:2;
  width:330px
}



li a {
  display: inline-block;
  color: white;
  text-align: center;
}

li a:hover {
  background-color: teal;
}


  </style>
          <!-- Full Page Intro -->
          <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/architecture.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-gradient align-items-center">
              <!-- Content -->
              <div class="container">
                <!--Grid row-->
                <div class="row">
                  <!--Grid column-->
                  <div class="col-lg-5 mt-xl-5 mb-5 wow " data-wow-delay="0.3s">
                    <h1 class="h1-responsive font-weight-bold mt-sm-5"> Internet of Things (IoT) Based Smart Home Using Deep Learning Algorithm</h1>
                    <hr class="hr-light">
                    <h4 class="">By</h4>
                    <h4 class="mb-4 font-weight-bold">OKARA, Chidera Chibuzor PG.2018/01273</h4> 
                  </div>
                  <!--Grid column-->
                  <!--Grid column-->
                  <div class="col-xl-5 mt-xl-5 wow" data-wow-delay="0.3s">
        
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
                                    <a class="nav-link" href="#">Refrigerator <span class="sr-only">(current)</span></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#">Air Condition</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#">Television</a>
                                  </li>
                                  <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Lighting
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                      <a class="dropdown-item" href="#">Bedroom Light</a>
                                      <a class="dropdown-item" href="#">Kitchen Light</a>
                                      <a class="dropdown-item" href="#">Parlour Light</a>
                                      <a class="dropdown-item" href="#">Toilet light</a>
                                      <a class="dropdown-item" href="#">Corridor light</a>
                                      <a class="dropdown-item" href="#">Security light</a>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </nav>    

                                <div class="col-4">
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
                                <div class="col-4">
                                    <a href="#"><img src="icons/iconfinder_google_podcasts_new_logo_7115256.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><img src="icons/iconfinder_WhatsApp_289134.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><img src="icons/iconfinder_photoshop_2318048.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><img src="icons/iconfinder_google_chrome_new_logo_7115262.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><img src="icons/iconfinder_google_maps_new_logo_7115251.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><img src="icons/iconfinder_google_photos_new_logo_7115257.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/fridge.php"><img src="icons/smart-fridge.png" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><img src="icons/iconfinder_google_search_new_logo_7115255.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="#"><img src="icons/iconfinder_google_maps_new_logo_7115251.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/alarm.php"><img src="icons/bell.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/light.php"><img src="icons/iconfinder_Eco_bulb_energy_light_2992437.svg" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/ac.php"><img src="icons/air-conditioning.png" alt="" height="50px"></a>
                                </div>
                                <div class="col-4">
                                    <a href="sections/speaker.php"><img src="icons/iconfinder_kmixdocked_error_7209.png" alt="" height="50px"></a>
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


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  
    </body>
</html>