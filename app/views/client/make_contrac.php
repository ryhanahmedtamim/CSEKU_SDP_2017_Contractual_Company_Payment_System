    <!DOCTYPE HTML>

    <html>
        <head>  

       
        </head>

        <body class="body-home">

           <?php 
             include ('layout/layout.php');
            ?>
            <div class="body-home"> 

            <div class="div1">

                <div style="margin-left: 30px;font-size: 20px;">Make Contract</div>
                <hr>
                <br>
                <form  action ="/?url=submit_contract" method="POST">
                        <div>

                        <label >Monthly Working Day</label>
                        <input type="text" id="text" name ="dayPerMonth" required autofocus/>
                        </div>
                       
                        
                        <div> <label >Starting Date</label>
                        <input type="date" class ="text" name ="startingDate" required autofocus/></div>

                      
                        <div><label >Monthly Payment</label>
                        <input type="text"  name ="monthlyPayment" required autofocus/></div>
                        
                        <div><label >Month Limit</label>
                        <input type="text" id="user" name ="monthLimit" required autofocus/></div>
                        

                
                         
                        
                   
                    
                         <button type="submit" class="button-submit button-radious-8 button-hover-blue"  >
                                        Submit
                                    </button>
                    
                </form>


            </div>
            </div>
        </body>
    </html>
