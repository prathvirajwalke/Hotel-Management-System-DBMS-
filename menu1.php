<?php
session_start();
$severname="localhost";
$username1="root";
$password="";
$dbname="ai";

$conn=mysqli_connect($severname,$username1,$password,$dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $flag=0;
  foreach($_POST['check_list'] as $selected){
    $var1=$_SESSION["username"];
    $var2=$_POST["$selected"];

    $sql="INSERT INTO `temp_cart`(`username`, `item_name`, `qty`) VALUES ('$var1','$selected',$var2)";
    if(mysqli_query($conn,$sql))
    {
      $flag++;
    }
    else{
      echo "Not Done";
    }
 }
 if($flag>0)
 {
   header('Location:menu1.php');
   exit();
 }

}

 ?>

<html>
    <head>
        <title>Menu</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body{
            font-family: sans-serif;
            background-repeat: repeat;
        }

        .welcome{
            font-size: 28px;
            color: white;
            font-weight: bold;
            background-color:black;
            height: 15%;
        }
        /* table, th, td {
            border: 0.5px solid white;
            border-collapse: collapse;
            color: white;
            text-align: center;
            align-self: center;
            } */

            table {
              border: 1px solid white;
              border-collapse: collapse;
              text-align: center;
              align-self: center;
              color: white;
              font-size: 19px;
              -moz-border-radius: 5px;
              border-collapse: collapse;
              border: none;
            }

            table th:first-child {
              -moz-border-radius: 5px 0 0 0;
            }
            table th:last-child {
              -moz-border-radius: 0 5px 0 0;
            }
            table tr:last-child td:first-child {
              -moz-border-radius: 0 0 0 5px;
            }
            table tr:last-child td:last-child {
              -moz-border-radius: 0 0 5px 0;
            }
            table tr:hover td {
              background-color: grey;
            }

            th{
                font-size: 22px;
            }


        h1{
            margin-left: 42%;
            margin-top: 1%;
            margin-right: 45%;
            padding: 1%;
            font-size: 48px;
            color: white;
            background-color: black;
        }

        .menu{
            background-color: black;
            opacity: 0.9;
            width: 40%;
            border: 1px solid white;
            margin-left: 23%;
            margin-top: 0%;
            overflow-y: auto;
            height:350px;
            width:700px;

        }

        #quantity{
            text-align: center;
            width: 60%;
        }

        #checkbox{
            align-self: center;
            width: 70px;
            block-size: 20px;
        }

        .button1{
            margin-left: 59.5%;
            text-decoration: none;
            background-color: red;
            padding-left: 5px;
            padding-right: 5px;
            width: 8%;
        }

        .button2{
          float: left;
          text-decoration: none;
          margin-top: 2.2%;
          height: 35px;
          background-color: black;
          width: 38px;
          margin-left: 3%;
        }

        .try{
            text-decoration: none;
            color: white;
            font-size:22px;
            padding:5px;
            margin:0%;
        }

        .button1:hover{
            background-color: green;
        }

        .parallax{
            background-image: url("parallaximage.jpg");
            margin-top: 0%;
            min-height: 100%;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
    </head>

    <body>
        <div class="welcome">
            <p style="float: left;margin-left: 1%;"><? if(!isset($_SESSION["username"]))
        		{
        			echo "Please Login";
        		}
        		else {
        			echo "Welcome ".($_SESSION["username"]);
        		}?></p>
            <p style="float: left;margin-left: 49%;"><a href="menu1.php" style="text-decoration: none;color: white;font-size: 25px;">MENU</a></p>
            <p style="float: left;margin-left: 3%;"><a href="history.php" style="text-decoration: none;color: white;font-size: 25px;">HISTORY</a></p>
            <p style="float: left;margin-left: 3%;"><a href="cart.php"><b class="fa fa-shopping-cart" style="color: white;"></b></a></p>
            
            <form action="logout.php" method="POST">
              <button class="button2" type="submit" onclick="alert('Logged Out.')"><b class="fa fa-sign-out" style="font-size:28px;color:white"></b></button>
            </form>

        </div>
        <div class="parallax">
        <h1>MENU</h1>
        <form action="menu1.php" method="POST">
        <div class="menu">
        <table cellspacing="10" align="center" cellpadding="20">
        <col width="">
        <col width="450">
        <col width="250">
        
        <tr>
        <th>Checkbox</th>
        <th>Item Name</th>
        <th>Item Price  (Rs)</th>
        <th>Quantity</th>
        </tr>
        <tr>
          <th colspan="4">Breakfast</td>
        </tr>
        <?php
        $sql="SELECT * FROM `menu` where item_name not like \"%Burger%\"  and item_name not like \"%Coffee%\" and item_name  not like \"%Sandwich%\" and item_name not like \"%Pizza%\"";
  			if($result=mysqli_query($conn,$sql))
        {

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_array($result)) {


  							echo "<tr>";
  							$var=str_replace("_"," ","$row[item_name]");
                echo "<td><input type=\"checkbox\" name=\"check_list[]\" value=".$row['item_name']." /></td>";

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";
            		echo "<td><input id=\"quantity\" type=\"number\" name=\"$row[item_name]\" value='1' /></td>";

                echo "</tr>";
  					}
        }


        }
        ?>
        <tr>
          <th colspan="4">Coffee</td>
        </tr>
        <?php
        $sql="SELECT * FROM `menu` where item_name like \"%Coffee%\"";
  			if($result=mysqli_query($conn,$sql))
        {

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_array($result)) {


  							echo "<tr>";
  							$var=str_replace("_"," ","$row[item_name]");
                echo "<td><input type=\"checkbox\" name=\"check_list[]\" value=".$row['item_name']." /></td>";

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";
            		echo "<td><input id=\"quantity\" type=\"number\" name=\"$row[item_name]\" value='1' /></td>";

                echo "</tr>";
  					}
        }


        }
        ?>
        <tr>
          <th colspan="4">Burger</td>
        </tr>
        <?php
        $sql="SELECT * FROM `menu` where item_name like \"%Burger%\"";
  			if($result=mysqli_query($conn,$sql))
        {

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_array($result)) {


  							echo "<tr>";
  							$var=str_replace("_"," ","$row[item_name]");
                echo "<td><input type=\"checkbox\" name=\"check_list[]\" value=".$row['item_name']." /></td>";

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";
            		echo "<td><input id=\"quantity\" type=\"number\" name=\"$row[item_name]\" value='1' /></td>";

                echo "</tr>";
  					}
        }


        }
        ?>
        <tr>
          <th colspan="4">Sandwich</td>
        </tr>
        <?php
        $sql="SELECT * FROM `menu` where item_name like \"%Sandwich%\"";
  			if($result=mysqli_query($conn,$sql))
        {

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_array($result)) {


  							echo "<tr>";
  							$var=str_replace("_"," ","$row[item_name]");
                echo "<td><input type=\"checkbox\" name=\"check_list[]\" value=".$row['item_name']." /></td>";

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";
            		echo "<td><input id=\"quantity\" type=\"number\" name=\"$row[item_name]\" value='1'/></td>";

                echo "</tr>";
  					}
        }


        }
        ?>
        <tr>
          <th colspan="4">Pizza</td>
        </tr>
        <?php
        $sql="SELECT * FROM `menu` where item_name like  \"%Pizza%\"";
  			if($result=mysqli_query($conn,$sql))
        {

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_array($result)) {


  							echo "<tr>";
  							$var=str_replace("_"," ","$row[item_name]");
                echo "<td><input type=\"checkbox\" name=\"check_list[]\" value=".$row['item_name']." /></td>";

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";
            		echo "<td><input id=\"quantity\" type=\"number\" name=\"$row[item_name]\" value='1' /></td>";

                echo "</tr>";
  					}
        }


        }
        ?>
        </table>
        </div><br>
        <button class="button1" type="submit" onclick="alert('Items Added To Cart.')"><p class="try">SELECT</p></button>
        <br>
        <br>
        <br>
        </div>
        </form>

    </body>
</html>
