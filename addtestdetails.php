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
        $testname=$_POST["test"];
        $sample=$_POST["sample"];
        $department=$_POST["department"];
        $parameter=$_POST["param"];
        $labid=$_POST["labid"];
        $doc=$_POST["doc"];
        $charge=$_POST["charge"];
        $dis=$_POST["dis"];
        $packageid=$_POST["packageid"];
		
        if($conn)
        {     
          $q="insert into Test(Test_name,Sample_type,Department,is_parameter)values('$testname','$sample','$department','$parameter')" ;

           if($conn->query($q)===TRUE)
           {
              $q1="select Test_id from Test where Test_name='$testname'";
              $result = mysqli_query($conn,$q1);
              if($result)
              {
                  while($row=mysqli_fetch_assoc($result)) 
                  {
                      $c=$row['Test_id'];
                  }
              }
              
            
              $q2="insert into offers_test values($labid,$c,'$doc',$charge,$dis)";
           
				  if($packageid[0]=="none")
				  {	
					  if($conn->query($q2)==TRUE)
					  {
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
				  else
				  {
					  foreach ($_POST['packageid'] as $pid)
					  {
						$q3="insert into Have_tests values($pid,$c)";
						//echo $pid ;
						if($conn->query($q3)==TRUE)
							$flag=1;
						else
							$flag=0;
					  }

					  if($conn->query($q2)==TRUE)
					  {
						if($flag==1)
						{
						  echo "<script type='text/javascript'>";
						  echo "window.alert ('Insertion is succesfull!!')";
						  echo "</script>";
						}
					  }
					  else
					  {
						echo "<script type='text/javascript'>";
						echo "window.alert ('Insertion is unsuccesfull!!')";
						echo "</script>";
					  }
					  
				  }
				  
           } 
         }       
      }
      $conn->close();
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
          $q1="select Lab.Lab_id,Lab.Lab_name from Lab" ;
          $q2="select Package_id,Package_name from Package" ;
          $result = mysqli_query($conn,$q1);
          $r=mysqli_query($conn,$q2);
           if($result)
          {
            $m=1;
             while($row=mysqli_fetch_assoc($result))
             {

                $i[$m]=$row['Lab_id'];
                $n1[$m]=$row['Lab_name'];
                 $m=$m+1; 
             }
                      
           }
           if($r)
          {
            $p=1;
             while($row=mysqli_fetch_assoc($r))
             {

                $p1[$p]=$row['Package_id'];
                $p2[$p]=$row['Package_name'];
                 $p=$p+1; 
             }
                      
           }
         }
         $conn->close();
         ?>
    <center>
			<div class="contain">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
 <center><legend><h2><b><font style="Arial" color="black"><span>ADD TEST DETAILS</span></font></b></h2></legend></center>
 <div>
    <select class="form-control" name="labid" >
                  <option value="" disabled selected>Select Lab</option>
                  <?php
                  for($k=1;$k<$m;$k++)
                  {
                    echo "<option value='$i[$k]'>$n1[$k]</option>" ;
                  }
                  ?>
                  </select>
                  
  </div><br/>
 <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Testname:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="test" required="required">
  </div>
  <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Sample-type:</label>
    &nbsp&nbsp&nbsp<input type="text" class="form-control" name="sample" required="required" >
  </div>
   <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Department:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="department" required="required">
  </div>
   <div class="form-inline">
    <label for="name"><font color="red">*</font>Have_parameters:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" class="form-control" name="param" value="1"> Yes &nbsp &nbsp &nbsp
         <input type="radio" class="form-control"name="param" value="0">No<br>
        
    <!--<input type="number" class="form-control" name="param" required="required">-->
  </div>
   <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Doctor-name:</label>
    &nbsp<input type="text" class="form-control" name="doc" required="required">
  </div>
   <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Charge:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" class="form-control" name="charge" required="required" min="50">
  </div>
   <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Discount:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="number" class="form-control" name="dis" required="required" min="0">
  </div><br/>
  <div>
    <select class="form-control" name="packageid[]" multiple="multiple">
                  <option value="" disabled selected>Select Package(if any)</option>
				  <option value="none" >None</option>
                  <?php
                  for($k=1;$k<$p;$k++)
                  {
                    echo "<option value='$p1[$k]'>$p2[$k]</option>" ;
                  }
                  ?>
      </select>
                  
  </div>
  <br/>
 <center> <button type="submit" class="btn btn-default">Submit</button></center>
</form>
</div>
</center>
</body>
</html>
