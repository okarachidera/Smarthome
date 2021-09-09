<?php
session_start();
			ob_start();
			 include('include/homecss.php');
?>
<html lang="en">
    <head>
    <!-- Page css -->
    

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
                    <h1 class="h1-responsive font-weight-bold mt-sm-5"> Predicting Home User Activities In a Secured Smart home Using Deep Learning</h1>
                    <hr class="hr-light">
                    <h4 class="">By</h4>
                    <h4 class="mb-4 font-weight-bold">OKARA, Chidera Chibuzor PG.2018/01273</h4> 
					
					<?php


			
			if(isset($_SESSION['sign_msg'])){
				?>
				
				<div class="alert alert-success">
					<span>
					<?php 
					echo 
					
					$_SESSION['sign_msg'];
						unset($_SESSION['sign_msg']); 
					?>
					</span>
				</div>
				<?php
			}
		?>
                  </div>
                  <!--Grid column-->
                  <!--Grid column-->
                  <div class="col-lg-5 mt-xl-5 mb-5 wow" data-wow-delay="0.3s" id="phonevw">
        
                    <div class="smartphone" id="">
                        <div class="content"style="background-image: url(img/saver.jpg);">
                            <div class="row">
                                <div class="col-4">
                                </div>
                                <!--<div class="col-4">
                                
                                <p id="statusdate"></p>
                                  <script>
                                    var d = new Date();
                                    var n = d.toLocaleTimeString();
                                    document.getElementById("statusdate").innerHTML = n;
                                  </script>
                            </div>-->



                            <div class="col-10" style="padding-left:80px">
                                      <form method="POST" action="regexec.php">
                                      <div class="form-group">
                                        <!-- <label for="exampleInputEmail1" class="text-warning">First name</label> -->
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First name" name="first" autocomplete="off"/>
                                        
                                      </div>
									  <div class="form-group">
                                        <!-- <label for="exampleInputEmail1" class="text-warning">Last name</label> -->
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First name" name="last">
                                        
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-warning">Username</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" name="uname">
                                        
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-warning">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                                        
                                      </div>

                                      <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-warning">Phone Number</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Mobile Number" name="phone">
                                        
                                      </div>

                                      <!-- <div class="form-group">
                                        <label for="exampleInputPassword1"class="text-warning">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                                      </div> -->


                                      <div class="form-group">
                                      <button type="submit" class="btn btn-primary ">Add User</button>
                                      <!--<button type="submit" class="btn btn-primary "><a href="login.php"style="color:white; text-decoration:none">Login</a></button>-->
                                    
                                    
                                    </form>
                                    <button class="btn btn-primary"><a href="index.php" style="color:white; text-decoration:none">Home</a></button>
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


    </body>
</html>