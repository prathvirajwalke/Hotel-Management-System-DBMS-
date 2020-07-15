<!DOCTYPE html>
  <html>
  <head>
  <title>Welcome To Registration Form</title>
  <style>
      body
    {
	    margin:0px;
	    background-image:url(image1.jpg);
	    color:#f9fcf5;
	    font-family:Arial, Helvetica, sans-serif;
    }

    #main{width:600px; height:auto; overflow:hidden; padding-bottom:20px; margin-left:auto; margin-right:auto;
    border-radius:5px; padding-left:10px; margin-top:100px; border-top:3px double #f1f1f1;
    border-bottom:3px double #f1f1f1; padding-top:20px;
    }

    #main table{font-family:"Comic Sans MS", cursive;}
    /* css code for textbox */
    #main .tb{height:28px; width:230px; border:1px solid #f26724; color:#fd7838; font-weight:bold; border-left:5px solid #f7f7f7; opacity:0.9;}

    #main .tb:focus{height:28px; border:1px solid #f26724; outline:none; border-left:5px solid #f7f7f7;}

    /* css code for button*/
    #main .btn{width:150px; height:32px; outline:none;  color:#f7f7f7; font-weight:bold; border:0px solid #f26724;
    text-shadow: 0px 0.5px 0.5px #fff; border-radius: 2px; font-weight: 600; color: #f26724; letter-spacing: 1px;
    font-size:14px; background-color:#f1f1f1; -webkit-transition: 1s; -moz-transition: 1s; transition: 1s;}

    #main .btn:hover{background-color:#f26724; outline:none;  border-radius: 2px; color:#f1f1f1; border:1px solid #f1f1f1;
    -webkit-transition: 1s; -moz-transition: 1s; transition: 1s; }

  </style>

  

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST['username1']))
  {
	 $severname="localhost";
	 $username="root";
	 $password="";
	 $dbname="ai";

	 $conn=mysqli_connect($severname,$username,$password,$dbname);
	 $username=$_POST["username1"];
	 $pass=$_POST["password"];
	 $cpass=$_POST["cpassword"];
	 $md_pass=md5($pass);
   $email=$_POST["email"];
   $phone=$_POST["phone"];
   $flag=0;

   if(!preg_match("/^[A-Za-z]+$/",$username)) 
   {
	echo"<script>alert('name failed!!')</script>";
	$flag=1;
	//exit();
   }elseif(!preg_match("/^[0-9]+$/",$phone))
   {
	echo"<script>alert('number failed!!')</script>";
	$flag=1;
	//exit();
   }elseif(!preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/",$email))
   {
	echo"<script>alert('Email failed!!')</script>";	
	$flag=1;
	//exit();
   }elseif(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/",$pass))
   {
	echo"<script>alert('Password failed!!')</script>";	
	$flag=1;
	//exit();
   }elseif(!($pass===$cpass))
   {
	echo"<script>alert('Password does not match!!')</script>";	
	$flag=1;
	//exit();
   }
   if($flag==0)
   {
	$sql="INSERT INTO `customer`(`username`, `password`, `phone`, `email`) VALUES ('$username','$md_pass',$phone,'$email')";

		if(mysqli_query($conn,$sql))
		{
		echo"<script>alert('Registration Successful!!');
			window.location=\"login.php\"</script>";
		exit();
		}
		else
		{
		echo "<script>alert('Registration Failed ,Try again!!')</script>";
		}
	}
}
}

 ?>
  </head>

	<body>
	<!-- Main div code -->
	<div id="main">
	<div class="h-tag">
	<h2>Create Your Account</h2>
	</div>
	<!-- create account div -->
	<div class="login">
    <form action="Register.php" method="post">
	<table cellspacing="2" align="center" cellpadding="8" border="0">
	<tr>
	<td align="right">Enter Username :</td>
	<td><input type="text" placeholder="Enter Username here" id="t3" class="tb" name="username1"/></td>
	</tr>
	<tr>
	<td align="right">Enter Phone No. :</td>
	<td><input type="text" placeholder="Enter phone no. here" id="t1" class="tb"name="phone" /></td>
	</tr>
	<tr>
	<td align="right">Enter Email ID :</td>
	<td><input type="text" placeholder="Enter Email ID here" id="t2" class="tb" name="email"/></td>
	</tr>

	<tr>
	<td align="right">Enter Password :</td>
	<td><input type="password" placeholder="Enter Password here" id="t4" class="tb" name="password"/></td>
	</tr>
	<tr>
	<td align="right">Enter Confirm Password :</td>
	<td><input type="password" placeholder="Enter Password here" id="t5" class="tb" name="cpassword"/></td>
	</tr>
	<tr>
	<td></td>
	<td>
	<input type="reset" value="Clear Form" id="res" class="btn" />
	<input type="submit" value="Create Account" class="btn" onclick="registration()" /></td>
	</tr>
	</table>
</form>
	</div>
	<!-- create account box ending here.. -->
	</div>
	<!-- Main div ending here... -->
	</body>
	</html>
