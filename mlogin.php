
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   session_start();

   $severname="localhost";
   $username1="root";
   $password="";
   $dbname="ai";

   $conn=mysqli_connect($severname,$username1,$password,$dbname);
   $user=$_POST["username"];
   $pass=$_POST["password"];


   $sql="SELECT `m_name`, `m_pass` FROM `manager` WHERE m_name='$user' and m_pass='$pass'";

   if($result=mysqli_query($conn,$sql))
	 {
		 $row=mysqli_fetch_array($result);
		 if($user===$row["m_name"])
		 {

 		 header('Location:mpending.php');
			exit();
	 }
   else {
     echo "Wrong Username Password Combination";
   }
 }
	 else {
     echo "Internal Error";
	 }

}

 ?>



<!DOCTYPE html>
  <html>
  <head>
  <title>Manager Login</title>
  <style>
      body
    {
	    margin:0px;
	    background-color:#f26724;
	    background-image:url(image1.jpg);
	    color:#f9fcf5;
	    font-family:Arial, Helvetica, sans-serif;
    }

    #main{width:600px; height:auto; overflow:hidden; padding-bottom:20px; margin-left:auto; margin-right:auto;
    border-radius:5px; padding-left:10px; margin-top:13%; border-top:3px double #f1f1f1;
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

  <script>
      function registration()
	{

		var name= document.getElementById("t1").value;
		var email= document.getElementById("t2").value;
		var uname= document.getElementById("t3").value;
		var pwd= document.getElementById("t4").value;
		var cpwd= document.getElementById("t5").value;

        //email id expression code
		var pwd_expression = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/;
		var letters = /^[A-Za-z]+$/;
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		 if(uname=='')
		{
			alert('Please enter the user name.');
		}
		else if(!letters.test(uname))
		{
			alert('User name field required only alphabet characters');
		}
		else if(pwd=='')
		{
			alert('Please enter Password');
		}

	}
  </script>
  </head>

	<body>
	<!-- Main div code -->
	<div id="main">
	<div class="h-tag">
	<h2 style="margin-left:14%">LOGIN</h2>
	</div>
	<!-- create account div -->
	<div class="login">
    <form action="mlogin.php" method="post">
	<table cellspacing="2" align="center" cellpadding="8" border="0">
	<tr>
	<td align="right">Enter Username :</td>
	<td><input type="text" placeholder="Enter Username here" id="t3" class="tb" name="username" /></td>
	</tr>
	<tr>
	<td align="right">Enter Password :</td>
	<td><input type="password" placeholder="Enter Password here" id="t4" class="tb" name="password"/></td>
	</tr>
	<td></td>
	<td>
	<input type="submit" value="Login" id="res" class="btn" onclick="registration()"/>
	</tr>
	</table>
</form>
	</div>
	<!-- create account box ending here.. -->
	</div>
	<!-- Main div ending here... -->
	</body>
	</html>
