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
        
                    <div class="smartphone">
                        <div class="content"style="background-image: url(../img/saver.jpg);">


                        
                            <div class="row" id="rowmbc">
                            <div class="col-4">
                              <form action="../index.php">
                                <button class="btn btn-primary">Home</button>
                              </form>
                              </div>
                              <div class="col-4">

                              <div class="form-group">
                                        <select class="form-control" id="light" onchange="userChoice()">
                                            <option selected="" value="default" >Select</option>
                                            <option value="parlourselet">Parlour light</option>
                                            <option value="bedroomselet">Bedroom light</option>
                                            <option value="kitchenselet"> Kitchen light</option>
                                            <option value="toiletselet">Toilet light</option>
                                            <option value="corridorselet">Corridor light</option>
                                            <option value="securityselet">Security light</option>

                                        </select>
                                </div>

                              </div>
                              <div class="col-4">
                                  
                                  <p id="statusdate" style="color:yellow;"></p>
                                    <script>
                                      var d = new Date();
                                      var n = d.toLocaleTimeString();
                                      document.getElementById("statusdate").innerHTML = n;
                                    </script>
                              </div>
                                <div class="col-4">
                                </div>
                                <div class="col-6" id="bedroom">
                      
                                   
                                      <h6 class="mb-4">Bedroom light</h6>
                                      <form method="post" id="insert_data">                                
                                    <input type="checkbox" name="gender" id="status" checked />
         
                                    <input type="hidden"  name="hidden_gender" id="hidden_status" value="on" />
                                  


                                </div>

                                <div class="col-6" id="parlour">
                                      
                                    <h6 class="mb-4">Parlour light</h6>

                                    <input type="checkbox" name="gender" id="status1" checked />
         
                                    <input type="hidden"  name="hidden_gender" id="hidden_status1" value="on" />
                                 

                                </div>

                                

                                <div class="col-6" id="kitchen">
                                  
                                       
                                    <h6 class="mb-4">Kitchen light</h6>

                                    <input type="checkbox" name="gender" id="status2" checked />
         
                                    <input type="hidden"  name="hidden_gender" id="hidden_status2" value="on" />

                                </div>

                                <div class="col-6" id="toilet">
                                  
                              
                                     
                                    <h6 class="mb-4">Toilet light</h6>
  
                                    <input type="checkbox" name="gender" id="status3" checked />
         
                                    <input type="hidden"  name="hidden_gender" id="hidden_status3" value="on" />
  
                                </div>

                                <div class="col-6" id="corridor">

                                      <h6 class="mb-4">Corridor light</h6>
  
                                    <input type="checkbox" name="gender" id="status4" checked />
         
                                    <input type="hidden"  name="hidden_gender" id="hidden_status4" value="on" />
  
                                </div>

                                <div class="col-6" id="security">
                                                       
                                      <h6 class="mb-4">Security light</h6>
  
                                    <input type="checkbox" name="gender" id="status5" checked />
         
                                    <input type="hidden"  name="hidden_gender" id="hidden_status5" value="on" />

                                      
  
                                </div>

                                
                            </div>
                            <div class="row">
                            <div class="col-4">
                            </div>
                            <div class="col-4" id="subbtn">
                            <input type="submit" name="insert" id="action" class="btn btn-primary" value="Insert" />
                            </form> 
                            </div>
                            <div class="col-4">
                            </div>



                            </div>

  

                        
                            
            
                        </div>
                  </div>
                  <div class="col-lg-5 mt-xl-5 mb-5 wow" data-wow-delay="0.3s">
                    
                  </div>
                  
                </div>
                
              </div>
              
            </div>
            
          </div>
         
        </header>
        
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
    $('#hidden_status').val('on');
   }
   else
   {
    $('#hidden_status').val('off');
   }
  });


  $('#status1').bootstrapToggle({
   on: 'on',
  off: 'off',
  
   onstyle: 'success',
   offstyle: 'danger'
  });

  $('#status1').change(function(){
   if($(this).prop('checked'))
   {
    $('#hidden_status1').val('on');
   }
   else
   {
    $('#hidden_status1').val('off');
   }
  });


  $('#status2').bootstrapToggle({
   on: 'on',
  off: 'off',
  
   onstyle: 'success',
   offstyle: 'danger'
  });

  $('#status2').change(function(){
   if($(this).prop('checked'))
   {
    $('#hidden_status2').val('on');
   }
   else
   {
    $('#hidden_status2').val('off');
   }
  });
  

  $('#status3').bootstrapToggle({
   on: 'on',
  off: 'off',
  
   onstyle: 'success',
   offstyle: 'danger'
  });

  $('#status3').change(function(){
   if($(this).prop('checked'))
   {
    $('#hidden_status3').val('on');
   }
   else
   {
    $('#hidden_status3').val('off');
   }
  });


  $('#status4').bootstrapToggle({
   on: 'on',
  off: 'off',
  
   onstyle: 'success',
   offstyle: 'danger'
  });

  $('#status4').change(function(){
   if($(this).prop('checked'))
   {
    $('#hidden_status4').val('on');
   }
   else
   {
    $('#hidden_status4').val('off');
   }
  });


  $('#status5').bootstrapToggle({
   on: 'on',
  off: 'off',
  
   onstyle: 'success',
   offstyle: 'danger'
  });

  $('#status5').change(function(){
   if($(this).prop('checked'))
   {
    $('#hidden_status5').val('on');
   }
   else
   {
    $('#hidden_status5').val('off');
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

<!--select choice display light  -->
<style>
        #bedroom, #kitchen, #parlour ,#toilet, #corridor, #security, #subbtn{
            display: none;
        }
    </style>
<script>
        function userChoice(){
        var choice;
        choice = document.getElementById("light").value;
        
        if(choice=="bedroomselet"){
            document.getElementById('bedroom').style.display="block";
            document.getElementById('kitchen').style.display="none";
            document.getElementById('toilet').style.display="none";
            document.getElementById('parlour').style.display="none";
            document.getElementById('corridor').style.display="none";
            document.getElementById('security').style.display="none";
            document.getElementById('subbtn').style.display="block";

        }else if(choice=="kitchenselet"){
            document.getElementById('kitchen').style.display="block";
            document.getElementById('toilet').style.display="none";
            document.getElementById('parlour').style.display="none";
            document.getElementById('bedroom').style.display="none";
            document.getElementById('corridor').style.display="none";
            document.getElementById('security').style.display="none";
            document.getElementById('subbtn').style.display="block";

        }else if(choice=="toiletselet"){
            document.getElementById('toilet').style.display="block";
            document.getElementById('parlour').style.display="none";
            document.getElementById('bedroom').style.display="none";
            document.getElementById('kitchen').style.display="none";
            document.getElementById('corridor').style.display="none";
            document.getElementById('security').style.display="none";
            document.getElementById('subbtn').style.display="block";

            
        }else if(choice=="parlourselet"){
            document.getElementById('parlour').style.display="block";
            document.getElementById('bedroom').style.display="none";
            document.getElementById('kitchen').style.display="none";
            document.getElementById('toilet').style.display="none";
            document.getElementById('corridor').style.display="none";
            document.getElementById('security').style.display="none";
            document.getElementById('subbtn').style.display="block";

            
        }else if(choice=="corridorselet"){
          document.getElementById('corridor').style.display="block";
            document.getElementById('parlour').style.display="none";
            document.getElementById('bedroom').style.display="none";
            document.getElementById('kitchen').style.display="none";
            document.getElementById('toilet').style.display="none";
            document.getElementById('security').style.display="none";
            document.getElementById('subbtn').style.display="block";

            
        }else if(choice=="securityselet"){
            document.getElementById('security').style.display="block";
            document.getElementById('corridor').style.display="none";
            document.getElementById('parlour').style.display="none";
            document.getElementById('bedroom').style.display="none";
            document.getElementById('kitchen').style.display="none";
            document.getElementById('toilet').style.display="none";
            document.getElementById('subbtn').style.display="block";            
        }else if(choice=="default"){
            document.getElementById('security').style.display="none";
            document.getElementById('corridor').style.display="none";
            document.getElementById('parlour').style.display="none";
            document.getElementById('bedroom').style.display="none";
            document.getElementById('kitchen').style.display="none";
            document.getElementById('toilet').style.display="none";
            document.getElementById('subbtn').style.display="none";
            
        }   
        
        
        
        //alert(choice);
        }
        </script>



    </body>
</html>