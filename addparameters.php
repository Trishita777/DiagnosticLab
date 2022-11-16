<html>
<head><title>Admin Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
.contain{
  background-color:Gainsboro;
    opacity:0.6;
   font-size: 16px;
    width: 500px;
    height: 450px; 
    opacity:0.6; 
    border: 2px solid black;
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;

}
body{
  background:lightblue;
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
button[type=submit],button[type=reset],input[type=text],input[type=number],input[type=email],input[type=password]{
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
  <?php
      session_start();
      $labid='' ;
      $servername="localhost";
      $username="root";
      $password="";
      $db="lab";
      $conn=new mysqli($servername,$username,$password,$db);
      if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {
        $pname=$_POST["pname"];
        $max=$_POST["max"];
        $min=$_POST["min"];
        $unit=$_POST["unit"];
		if($unit==null)
			$unit='--' ;
        $testid=$_POST["testid"];
		
        if($max>=$min)
		{
			if($conn)
			{	 
			  $q="insert into Parameters(Parameter_name,max_value,min_value,unit)values('$pname',$max,$min,'$unit')" ;

			   if($conn->query($q)===TRUE)
			  {
				$q1="select Parameter_id from Parameters where Parameter_name='$pname'";
				$result = mysqli_query($conn,$q1);
			    if($result)
			    {
			       while($row=mysqli_fetch_assoc($result)) {
				$c=$row['Parameter_id'];
			   }
			 }
			 
			 foreach($_POST["testid"] as $tid )
			 {
				$q2="insert into Contains values($tid,$c)";
				if($conn->query($q2)==TRUE)
					$flag=1;
				else
					$flag=0;
			 }
			  
			 if($flag==1){
			   echo "<script type='text/javascript'>";
				echo "window.alert ('Insertion is succesfull!!')";
		  
					   echo "</script>";
			   }
			   else
			   {
				echo "<script type='text/javascript'>";
				echo "window.alert ('Insertion is unsuccesfull!!')";

					   echo "</script>";
			   }
			   }  
			$conn->close();
		  }
		}
		else
		{
			echo "<script type='text/javascript'>";
			echo "window.alert ('Enter correct max & min value!!')";
			echo "</script>";
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
                  <li class="nav-item">
                    <a class="nav-link" href="Superadmin.php"><b>LOGIN</b></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="addlab.php"><b>INSERT LAB</b></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="Deletelab.php"><b>DELETE LAB</b></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="addtestdetails.php"><b>INSERT TEST</b></a>
                  </li>
                   <li class="nav-item ">
                    <a class="nav-link" href="addparameters.php"><b>INSERT TEST PARAMETER</b></a>
                  </li>
                   
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?php
                 $servername="localhost";
                 $username="root";
                 $password="";
                 $db="lab";
                 $conn=new mysqli($servername,$username,$password,$db);
                if($conn)
        {
          $q1="select Test_id,Test_name from Test" ;
          $result = mysqli_query($conn,$q1);
           if($result)
          {
            $m=1;
             while($row=mysqli_fetch_assoc($result))
             {

                $i[$m]=$row['Test_id'];
                $n1[$m]=$row['Test_name'];
                 $m=$m+1; 
             }
                      
           }
         }
         $conn->close();
         ?>
    <center>
			<div class="contain">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
 <center><legend><h2><b><font style="Arial" color="black"><span>ADD TEST PARAMETER DETAILS</span></font></b></h2></legend></center>
 <div>
    <select class="form-control" name="testid[]" multiple="multiple" size="3">
                  <option value="" disabled selected>Select Test</option>
                  <?php
                  for($k=1;$k<$m;$k++)
                  {
                    echo "<option value='$i[$k]'>$n1[$k]</option>" ;
                  }
                  ?>
      </select>
                  
  </div><br/>
 <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter ParameterName:</label>
    &nbsp<input type="text" class="form-control" name="pname" required="required">
  </div>
  <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Max-value:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="number" class="form-control" name="max" required="required" step="0.0001">
  </div>
   <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Min-value:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="number" class="form-control" name="min" required="required" step="0.0001">
  </div>
   <div class="form-inline">
    <label for="name"><font color="red"></font>Enter Unit:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="unit" >
  </div>
  <br/>
 <center> <button type="submit" class="btn btn-default">Submit</button></center>
</form>
</div>
</center>
</body>
</html>
