<!DOCTYPE html>
<html>
<head>
	<title>Nr Company</title>
	
</head>
<body class="body-home">
 
 		<?php 
 			include ('layout/layout.php');
 		?>
 			<div class="body-home">
 				<div class="div1">
 					
 					<div style="margin-left: 30px;font-size: 20px;">Send Payment</div>
               <hr>
 					<form action="/?url=client/send_payment" method="POST">

 					<div>
 						<input type="hidden" name="contractId" value="<?php echo $data; ?>">
 					</div>

 					<div>
 						<label>Payment Serial</label>
 						<input type="text" name="paymentSerial" required autofocus>
 					</div>

 					<div>
 						<label>Amount</label>
 						<input type="text" name="amount" required autofocus>
 					</div>

 					<div> 
 					<label >Payment Date</label>
                        <input type="date" class ="text" name ="paymentDate" required autofocus/>
                     </div>
 						
                     <div>
                     	<button type="submit" class="button-submit button-radious-8 button-hover-blue">
                     	Send
                     		
                     	</button>
                     </div>
 					</form>
 				</div>

 			</div>
</body>
</html>