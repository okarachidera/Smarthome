<html lang="en">
    <head>
    <!-- Page css -->
    <?php include('include/homecss.php');?>

    </head>
    <body>


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

                                <div class="col-10" style="padding-left:80px">
                                      <form>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-warning">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                        
                                      </div>

                                      <div class="form-group">
                                        <label for="exampleInputPassword1"class="text-white"><a href="login.php" class="text-white">Login</a></label>
                                      </div>


                                      <button type="submit" class="btn btn-primary">Submit</button>
                                      
                                    </form>
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


    </body>
</html>