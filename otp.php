<?php
	session_start();
	 include('include/homecss.php');
	 include('function.php');
	include('conn.php');

	if(isset($_SESSION['id'])){
		header('location:index.php');
	}
?>

<?php
// $email=$_GET['email'];

if(empty(isset($_GET['email'])))
{
  header('location:login.php');
}elseif(!empty(isset($_GET['email'])))
{
  $email=$_GET['email'];
  $statusmsg=$_GET['statusmsg'];


}

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
                                      <form method="POST" action="otpexec.php" >
                                      <?php
                                        //form validation
                                        if($statusmsg=='success')
                                        {
                                          echo '<div class="form-group text-center" style="background-color:#d3ffda;">
                                          <span class="text-success">OTP was sent to'?> <?php echo $email ?></span>
                                          </div>
                                       <?php   
                                       }
                                       if($statusmsg=='incorrect')
                                       {
                                         echo '<div class="form-group text-center" style="background-color:rgb(255, 219, 219)">
                                         <span class="text-danger">Incorrect OTP please try again </span>
                                         </div>' ?>
                                      <?php   
                                      }
                                       elseif($statusmsg=='failed'){
                                        echo '<script>
                                        window.location = "login.php";
                                        </script>';
              
                                       }
                                       elseif($statusmsg=='expired'){
                                        echo '<div class="form-group text-center" style="background-color:rgb(255, 219, 219)">
                                        <span class="text-danger"> OTP expired generate new</span>
                                        </div>';
              
                                       }
                                       elseif($statusmsg=='block'){
                                        echo '<div class="form-group text-center" style="background-color:rgb(255, 219, 219)">
                                        <span class="text-danger"> User Account Blocked </span>
                                        </div>';
                                        echo'<script>
                                        setTimeout(function(){
                                            window.location.href = "login.php";
                                        }, 5000);
                                     </script>';

              
                                       }

                                      ?>



                                      <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-warning">OTP CODE</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter OTP Code" name="otp">                                      
                                      </div>
                                      <div class="form-group">
                                        <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter OTP Code" name="email" value="<?php echo $email ?>">                                      
                                      </div>

                                      <!-- <div class="form-group">
                                        <label for="exampleInputPassword1"class="text-white"><a href="login.php" class="text-white">Login</a></label>
                                      </div> -->


                                      <div class="form-group">
                                      <!-- <a href="loginexec.php?id=<?php echo $email; ?>">3 Comments</a> -->
                                      </div>

                                      <button type="submit" class="btn btn-primary" name="otpform">Submit</button>
                                      
                                      <button id=resend type="submit" class="btn btn-primary" name="otpform"><a style="color:white; text-decoration: none"href="loginexec.php?id=<?php echo $email; ?>">Resend OTP</a></button>
<style>
#resend{
  display:<?php if($statusmsg=='success'){
    echo 'none'; 
  }elseif($statusmsg =='expired'){
    echo 'inline-block';
    }
      else{
      echo 'inline-block';
    }
  ?>;
}
</style>
                                      
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