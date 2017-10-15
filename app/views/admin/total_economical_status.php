<!DOCTYPE html>
<html>
<head>
	<title> <?php echo $_SESSION['company']; ?></title>
</head>
<body  class="body-home">
		<?php

         include ('layout/layout.php');

		 ?>


		 <div class="container-fluid">
    <div class="row">



    <div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
            <h1>Total Economical Status <?php
              if(isset($_POST['filterStart'],$_POST['filterEnd']))
              {
                echo $_POST['filterStart']." To " .$_POST['filterEnd'];
              }
             ?></h1><hr>
            <div class="panel panel-default" >
                <div class="panel-body">                     
                    <table class="table table-bordered">
                      <form  action ="/?url=admin/totalstatus" method="POST">
                      <div>
                        <div>
                          <label>From</label>
                        <input type="date" id="text" name ="filterStart" required autofocus/>
                        </div>
                        <div>
                          <label>To</label>
                        <input type="date" id="text" name ="filterEnd" required autofocus/>
                        </div>
                        <button type="submit" class="button-filter button-radious-8 button-hover-blue">Filter</button>

                        </div>
                        
                        <thead>
                            <tr>
                                <th>Contract Id</th>   
                                <th>Received Payment</th>
                                <th>Send Payment</th>                              
                                <th>Profit</th>
                            </tr>
                        </thead>

                        
                            
                        
                        <tbody>  
                            
                           <?php 
                            if($data != NULL){ 
                            	$total = 0;
                           foreach ($data as $contract) { 
                            ?>
                            <tr>
                            
                               
                                <td><?php  echo $contract['id']; ?></td>
                                <td><?php  echo $contract['receive_amount']; ?></td>
                                <td><?php  echo $contract['senr_payment']; ?></td>
                                <td><?php 
                                $amount = ($contract['receive_amount']-$contract['senr_payment']);
                                $total += $amount;


                                 echo $amount;
                                  ?></td>
                                
                                
                                  
                                 
                                <?php 
                                  } 
                                  ?>
                                  <tr>
                                  <td></td>
                                  <td></td>
                                  <td>Total Profit</td>
                                  <td>
                                  	<?php
                                  		echo $total;
                                  	?>

                                  </td>
                                  </tr>
                                  <?php
                                }
                                ?>
                            </tbody>
                            

                        </table>
                    </div>
                </div>
            </div>


        
        </div>
    </div>
</body>
</html>