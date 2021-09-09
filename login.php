<?php
	session_start();
	 include('include/homecss.php');
	 include('function.php');
	include('conn.php');

	if(isset($_SESSION['id'])){
		header('location:index.php');
	}
?>
<html lang="en">
    <head>

    <!-- Page css -->
    <?php?>

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
                    <h1 class="h1-responsive font-weight-bold mt-sm-5"> Prediction of Home User Activities In a Secured Smart home Using IoT and Deep Learning</h1>
                    <hr class="hr-light">
                    <h4 class="">By</h4>
                    <h4 class="mb-4 font-weight-bold">OKARA, Chidera Chibuzor PG.2018/01273</h4> 
                  </div>
                  <!--Grid column-->
                  <!--Grid column-->
                  <div class="col-lg-5 mt-xl-5 mb-5 wow" data-wow-delay="0.3s" id="phonevw">
        
                    <div class="smartphone" id="pot">
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
                             <form action="loginexec.php" method="POST" >
							  <div class="form-group">
								<label for="exampleInputEmail1" class="text-warning">Username</label>
								<input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" required>
                                        
                                      </div>
                                      <button type="submit" class="btn btn-primary">Sign In</button>
                                      
                                    </form>
									<div style="height: 15px;"></div>
<?php
			if(isset($_SESSION['log_msg'])){
				?>
				<div style="height: 30px;"></div>
				<div class="alert alert-danger">
					<span><center>
					<?php echo $_SESSION['log_msg'];
						unset($_SESSION['log_msg']); 
					?>
					</center></span>
				</div>
				<?php
			}
		?>

<?php
			if(isset($_SESSION['otp_failed'])){
				?>
				<div style="height: 30px;"></div>
				<div class="alert alert-danger">
					<span><center>
					<?php echo $_SESSION['otp_failed'];
						unset($_SESSION['otp_failed']); 
					?>
					</center></span>
				</div>
				<?php
			}
		?>

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