<html>
<head>
<title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
.jumbo{
  font-style: Gothic;
  height:110px;
  background:white;
  opacity:0.8;
	
}
.contain1{
    background-color:black;
    opacity:0.6;
   font-size: 16px;
    width: 400px;
    height: 300px; 
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
    height: 700px; 
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
	background:url("pic3.jpg");
	font-family: Gothic;
	font-size:25px;
	opacity:1.0;
}
div{
	display:block;
}
button[type=submit],button[type=reset],input[type=text],input[type=password],input[type=number],input[type=email]{
    width: 20%;
    padding: 4px 2px;
    margin: 2px 2px;
    border:2px solid black;
    box-sizing: border-box; 
    font-size: 20px;
    position: relative;

}
select[name=city],select[name=state]{
  width: 44%;
    padding: 4px 2px;
    margin: 2px 2px;
    border:2px solid black;
    box-sizing: border-box; 
    font-size: 20px;
   position: relative;

}
input[type=date]{
   width: 60%;
    padding: 4px 2px;
    margin: 2px 2px;
    border:2px solid black;
    box-sizing: border-box; 
    font-size: 20px;
   position: relative;

}
select:required:invalid {
  color: gray;
}

option {
  color: black;
}
option[value=""][disabled] {
  display: none;
}
</style>
</head>
<body>
	<?php
			session_start();
			
			$servername="localhost";
			$username="root";
			$password="";
			$db="lab";

			$conn=new mysqli($servername,$username,$password,$db);
		
			if(isset($_POST['form']))
      {
        switch ($_POST['form']) 
        {
            case "B":
                      $fname=$_POST["fname"];
                      $lname=$_POST["lname"];
                      $contact=$_POST["contact"];
                      $email=$_POST["email"];
                      $dob=$_POST["dob"];
                      $street=$_POST["street"];
                      $city=$_POST["city"];
                      $state=$_POST["state"];
                      $pin=$_POST["pin"];
                      $password=$_POST["psw"];
					  $gender=$_POST["gender"];
                      
                      $query="select Cust_id from Patient where Email='$email'";
                      $result=mysqli_query($conn,$query);
                      if($result)
                      {
                         if(mysqli_num_rows($result))
                         {
                              echo "<script type='text/javascript'>";
                              echo "window.alert ('You have already registered!! Please Login to continue')";
                              echo "</script>";
                         }
                         else
                         {
                            $query="insert into Patient(Fname,Lname,Contact,Email,Dob,Street,City,State,Pincode,Password,Gender1) values('$fname','$lname',$contact,
                            '$email','$dob','$street','$city','$state',$pin,'$password','$gender') " ;
                            $result=mysqli_query($conn,$query);
                            if($result)
                            {
                               echo "<script type='text/javascript'>";
                               echo "window.alert ('Registration successful!! Please Login to continue')";
                               echo "</script>";
                               
                              
                               $query="select max(Cust_id) from Patient";
                               $result=mysqli_query($conn,$query);
                               if($result)
                               {
                                if($row=mysqli_fetch_assoc($result))
                                {
                                  $cid=$row['max(Cust_id)'];
                                }
                               }

                               $msg="You have sucessfully registered in Dexter Lab!!..Please Log in to continue.Your customer id is  : ".$cid;
                               $header="From:DexterLab@gmail.com";
                               mail("$email","About Suceesful Registration in Dexter Lab",$msg,$header);
                            }
                            
                         }

                      }
           
                      break;

           case "A":  $username=$_POST["email"];
                      $password=$_POST["password"];
                      if($conn)
                      {
                        $query="select Cust_id,Password from Patient where Email='$username'";
                        $result=mysqli_query($conn,$query);
                        if($result)
                        {
                          if(mysqli_num_rows($result)==0)
                          {
                            echo "<script type='text/javascript'>";
                            echo "window.alert ('You have not registered yet!!..Please register and continue')";
                            echo "</script>";
                          }
                          else
                          {
                              if($row=mysqli_fetch_assoc($result))
                              {
                                $p=$row['Password'];
                                if($p==$password)
                                {
                                  $cust_id=$row['Cust_id'];
                                  $_SESSION["cust_id"]=$cust_id;
                                  
                                  ?>
                                  <html>
                                  <script language='javascript'>window.alert('Login Sucessful!!');window.location='book_test.php';</script>
                                  </html>
                                  <?php
                                }
                                else
                                {
                                  echo "<script type='text/javascript'>";
                                  echo "window.alert ('Invalid username/password given!!!...Please try again')";
                                  echo "</script>";
                                }
                              }
                          }
                        }
                      }  
              			  break ;
          }
        }
		?>
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
                  </ul> 
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="contain1">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" autocomplete="off">
    <input type="hidden" name="form" value="A">
 <center><legend><h2><b><font style="Arial" color="white"><span>SIGN IN</span></font></b></h2></legend></center>
 <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="name" type="text" class="form-control" name="email" placeholder="Username" required="required" autocomplete="off">
    </div>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="required" autocomplete="off">
    </div>
    <center>
  <div class="checkbox">
   <h4><font color="white"> <label><input type="checkbox">Remember me</label></font></h4>
  </div></center>
  <center><button type="submit" class="btn btn-default">Login</button>
  &nbsp &nbsp &nbsp<button type="reset" class="btn btn-default">Reset</button></center>
   <font color="Violet">If you have already registered, then Sign-In Now!!</font>
</form>
</div>

<b><font color='red'>*Instructions:</font></b>
<p style="color:red; font-size:70%;">1.For password,give uppercase and lowercase letters and also digits.<br/>
  2.For login username will be email address and password is the password that the patient has given while registering in the website.<br/>
  3.After registration,a person can login.<br/>
  4.A new patient has to register while an old patient can login directly.<br/>
  5.An email will be sent immediately after a new patient registers with his/her patient-id.<br/>
  6.Everytime a patient has to login to book a package,book a test or view reports.<br/>
<br/>
 Kindly follow the above intructions!!
</p>
</div>
<div class="col-sm-6">
	<div class="contain">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" autocomplete="off">
		<center><legend><h2><b><font style="Arial" color="black">REGISTER</font></b></h2></legend></center>
		<font color="Red">If you haven't registered, then Register Now!!</font>
    <input type="hidden" name="form" value="B">
  <div class="form-inline">
    <label for="name"><font color="red">*</font>First-Name:</label>
    <input type="text" class="form-control" name="fname" required="required"  autocomplete="off">
  </div>
  <div class="form-inline">
    <label for="name"><font color="red">*</font>Last-name:</label>
    &nbsp<input type="text" class="form-control" name="lname" required="required" autocomplete="off" >
  </div>
  <div class="form-inline">
    <label for="psw"><font color="red">*</font>Password:</label>
    &nbsp&nbsp<input type="password" class="form-control" name="psw" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"><br/>
   <font color="red" size="3px"><b> **Password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters </b></font>
  </div>
    <div class="form-inline">
    <label for="Contact"><font color="red">*</font>Contact:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="contact" required="required" pattern="[6789]{1}[0-9]{9}" autocomplete="off" maxlength="10">
  </div>
    <div class="form-inline">
    <label for="email"><font color="red">*</font>Email:</label>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="email" class="form-control" name="email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  autocomplete="off">
  </div>
    <div class="form-inline">
    <label for="date"><font color="red">*</font>Dob:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp<input type="date" class="form-control" name="dob" required="required" autocomplete="off">
  </div>
  
  <div class="form-inline">
    <label for="gender"><font color="red">*</font>Gender:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="radio" class="form-control"  name="gender" value="male"><b>Male </b>&nbsp&nbsp
	<input type="radio" class="form-control" name="gender" value="female"><b>Female</b> &nbsp&nbsp
    <input type="radio" class="form-control"  name="gender" value="other"><b>Other</b> &nbsp
  </div>
  
    <div class="form-inline">
    <label for="name"><font color="red">*</font>Street:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="street" required="required"  autocomplete="off">
  </div>
    <div class="form-inline">
    <label for="name"><font color="red">*</font>City:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select name="city">
   <option value="" disabled selected>Select city</option>
   <option value="kolkata">Kolkata</option>
 </select>
  </div>
    <div class="form-inline">
    <label for="pwd"><font color="red">*</font>State:</label>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <select name="state">
    <option value="" disabled selected>Select state</option>
    <option value="WestBengal">WestBengal</option>
  </select>
  </div>
    <div class="form-inline">
    <label for="pincode"><font color="red">*</font>Pin:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="pin" required="required"  pattern="[0-9]{6}" autocomplete="off">
  </div>
  <div class="checkbox">
    <h4><label><input type="checkbox">Remember me</label></h4>
  </div>
 <center> <button type="submit" class="btn btn-default">Submit</button></center>
</form>

</div>
</div>
</body>
</html>


