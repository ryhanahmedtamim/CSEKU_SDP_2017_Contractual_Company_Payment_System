<!DOCTYPE html>
<html>
<head>

	<title><?php echo $_SESSION['company']; ?></title>
    <link href="http://agent.dgted.com/css/style.css" rel="stylesheet" type="text/css" >
</head>
<body class="body-home">
	<?php 
		include ('layout/layout.php');
	?>



	<div class="container-fluid">
    <div class="row">



    <div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
            <h1>Payment Send By Client</h1><hr>
            <div class="panel panel-default" >
                <div class="panel-body">                     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            	<th>payment Serial</th>
                                <th>Date</th>   
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>  
                        <?php
                        if($data != null){ 
                        foreach ($data as $client_payment) {
                           
                           if($client_payment['approved_by_manager'] == 0) 
                           { 
                         
                         ?>     
                           
                            <tr>
                                <td><?php echo $client_payment['payment_serial'] ; ?></td>
                                <td><?php echo $client_payment['date'] ; ?></td>
                                <td><?php echo $client_payment['amount_paid'] ; ?></td>
                                

                                 <td>

                                    
                                     <a class=" button-radious-8 button-send  button-hover-blue" href="/?url=admin/receive_payment_by_admin/<?php echo $client_payment['id']; ?>/<?php echo $client_payment['contract_id'];?>">Receive</a>
                                     
                                 </td>

                            </tr>

                            <?php
                                }
                             } 
                         }
                             ?>
                                
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>


        
        </div>
    </div>


    <div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
            <h1>Payment Received</h1><hr>
            <div class="panel panel-default" >
                <div class="panel-body">                     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            	
                                <th>Date</th>   
                                <th>Amount</th>
                                
                            </tr>
                        </thead>
                        
                        <tbody>  
                        <?php
                        if($data != null){ 
                        foreach ($data as $client_payment) {
                           
                           if($client_payment['approved_by_manager'] == 1) 
                           { 
                         
                         ?>     
                           
                            <tr>
                                
                            
                                <td><?php echo $client_payment['amount_paid'] ; ?></td>
                                <td><?php echo $client_payment['date'] ; ?></td>

                                 
                            </tr>
                            <?php
                                }
                             } 
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