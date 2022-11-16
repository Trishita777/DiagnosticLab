
<html>
	<head>
		<title>Book a Test</title>
		<link rel="stylesheet" href="css/payment.css">
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   		 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

		 <style>
		 	.jumbo{
	 font-style: Gothic;
  height:110px;
  background:white;
  opacity:0.8;
}
.contain1{
    background-color:grey;
    opacity:0.6;
   font-size: 16px;
    width: 530px;
    height: 460px; 
    opacity:0.4; 
    border: 2px solid black;
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;
}
.contain{
	background-color:lightblue;
    opacity:0.6;
   font-size: 16px;
    width: 600px;
    height: 600px; 
    opacity:0.6; 
    border: 2px solid black;
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;

}
body
{
	background-color :lightblue;
	font-family: Gothic;
	font-size:25px;
	opacity:1.0;
}
div{
	display:block;
}
button[type=submit],button[type=reset],input[type=text],input[type=password],input[type=date],input[type=number],input[type=email]{
    width: 20%;
    padding: 4px 2px;
    margin: 2px 2px;
    border:2px solid black;
    box-sizing: border-box; 
    font-size: 20px;
    position: relative;

}

		</style>
	</head>
	<body>
		 <div class="jumbo">
      
    <div class="main_menu">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.html">
            <img src="Dexter.png" alt="">
          </a>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <div class="row ml-0 w-100">
              <div class="col-lg-12 pr-0">
                <ul class="nav navbar-nav center_nav pull-right">
                                    <li class="nav-item active">
                    <a class="nav-link" href="index.html"><b>HOME</b></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="Custlogin.php"><b>LOGIN</b></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="Book_test.php"><b>BOOK TEST</b></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="Book_package.php"><b>BOOK PACKAGE</b></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="view_report.php"><b>VIEW REPORT</b></a>
                  </li>
                   
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<script>

  function validateForm() {
  var numbers = /^[0-9]+$/;
  var x = document.forms["form1"]["text1"].value;
  var y=x.length;
  if (y !=16 ) {
    alert("Enter valid card number");
	document.form1.text1.focus();
    return false;
  }
  
  var z = document.forms["form1"]["text2"].value;
  var p=z.length;
  if (p !=3 ) {
    alert("Enter valid cvv number");
	document.form1.text2.focus();
    return false;
  }
  
  if(x.match(numbers) && z.match(numbers))
  {
        return true ;
   }
   else
   {
	   if(x.match(numbers))
	   {
		    alert("Enter valid cvv number");
			document.form1.text2.focus();
			return false;
	   }
	   else
	   {
		    alert("Enter valid credit card number");
			document.form1.text1.focus();
			return false;
	   }
   }
}
</script>
			<center><h2><b><font style="Arial" color="midnightblue"><u>CREDIT CARD DETAILS</u></font></b></h2></center>		
			<form name="form1" class="form-inline" action="payment_package2.php" method="post" onsubmit="return validateForm()">
				<div class="creditCardForm">
    			<div class="payment">
            		<div class="form-group owner">
                			<label for="owner">Owner</label>
                			<input type="text" class="form-control" id="owner" name="owner" placeholder="Enter the name" required="required"/>
            		</div>
            		<div class="form-group CVV">
               				 <label for="cvv">CVV</label>
                			<input type="text" name="text2" maxlength="3" class="form-control" id="cvv" placeholder="- - -" required="required" />
            		</div>
           			 <div class="form-group" id="card-number-field">
               				 <label for="cardNumber">Card Number</label>
                			<input type="text" name="text1" maxlength ="16" class="form-control" id="cardNumber" placeholder="- - - -   - - - -  - - - -  - - - - " required="required" />
           			 </div>
           			<div class="form-group" id="expiration-date">
						<label>Expiration Date</label>
						<select required >
						<option value="01" >January</option>
						<option value="02">February </option>
						<option value="03">March</option>
						<option value="04">April</option>
						<option value="05">May</option>
						<option value="06">June</option>
						<option value="07">July</option>
						<option value="08">August</option>
						<option value="09">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
						</select>
						<select required>
						<option value="19"> 2019</option>
						<option value="20"> 2020</option>
						<option value="21"> 2021</option>
						<option value="22"> 2022</option>
						<option value="23"> 2023</option>
						<option value="24"> 2024</option>
						</select>
           			 </div>
          			
					<div class="form-group" id="pay-now">
						<input type="submit" class="btn btn-default" id="confirm-purchase" name="PAY" />
					</div>
    			</div>
			</div>
		</form>
	</body>
</html>