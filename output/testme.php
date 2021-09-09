<?php
include '../header.php';
?>
<!DOCTYPE html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"/>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

</head>
<body class="bg-info">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-10 bg-light rounded my-2 py-2">
<h4 class="text-center text-dark pt-2">Smart Homes Output</h4>
<hr/>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>User</th> 
<th>Appliance</th>
<th>Status</th>
<th>Time</th>
</tr>
</thead>
<tbody>
<?php
                            
                              $sqm =mysqli_query($conn,"SELECT * FROM appliance WHERE appliance_name='Television'");
$num =  mysqli_num_rows($sqm);
          if($num >=1){
            
    while($urow = mysqli_fetch_array($sqm)){
      $uid = $urow['userid'];
  $sql2  =mysqli_query($conn,"SELECT * FROM user WHERE userid=$uid");   while($namedd =mysqli_fetch_array($sql2) ){ 
                                ?>
                <tr>
                  <td><?php echo $namedd['firstname'].' '.$namedd['lastname'];?></td>
                                        <td><?php echo $urow['appliance_name'];?></td><td><?php echo $urow['status'];?></td><td><?php echo $urow['date'];?></td>
                                        </tr>
                       <?php
                                

                            }
    }
          }
                        ?>
                
</tbody>
</table>
<script>
$(document).ready(function(){
  $('table').DataTable({
     bJQueryUI: true,
        "sPaginationType": "full_numbers",
    "iDisplayLength": 2
  });
});
</script>
</body>
</html>