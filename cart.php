<?php

session_start();
$severname="localhost";
$username1="root";
$password="";
$dbname="ai";

$conn=mysqli_connect($severname,$username1,$password,$dbname);
$user=$_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

  $tot=$_SESSION['total'];

  $sql="call con_order('$user',$tot)";
  if(mysqli_query($conn,$sql))
  {
    header('Location:history.php');
    exit();
  }
  else {
    echo "Not Done";
  }
}


$final=0;
 ?>


<html>
    <head>
        <title>CART</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body{
            font-family: sans-serif;

        }

        .welcome{
            font-size: 28px;
            color: white;
            font-weight: bold;
            background-color:black;
            height: 15%;
        }

        table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            color: white;
            text-align: center;
            align-self: center;
            font-size:20px;
            }

        h1{
            margin-left: 40%;
            margin-top: 1%;
            margin-right: 41%;
            padding: 1%;
            font-size: 48px;
            color: white;
            background-color: black;
        }

        .menu{
            background-color: black;
            opacity: 0.9;
            width: 50%;
            border: 1px solid white;
            margin-left: 26%;
            margin-top: 0%;
        }

        .button{
            margin-left: 67%;
            text-decoration: none;
            background-color: red;
            width: 8%;
        }

        .try{
            text-decoration: none;
            color: white;
            font-size:22px;
            padding:5px;
            margin:0%;
        }

        .button:hover{
            background-color: green;
        }

        .parallax{
            background-image: url("cart_image.jpg");
            margin-top: 0%;
            min-height: 100%;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
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
        <h1>Your Cart</h1>
        <div class="menu">
        <table cellspacing="10" align="center" cellpadding="20">
          <col width="300">
          <col width="150">
          <col width="100">
          <col width="150">
          <tr>
          <th>Item Name</th>
          <th>Item Price  (Rs)</th>
          <th>Quantity</th>
          <th>Sub-Total (Rs)</th>

          </tr>
          <?php
          $sql="SELECT temp_cart.item_name,temp_cart.qty,menu.price FROM temp_cart INNER JOIN menu ON temp_cart.item_name=menu.item_name WHERE username='$_SESSION[username]'";
    			if($result=mysqli_query($conn,$sql))
          {

          if (mysqli_num_rows($result) > 0) {

              while($row = mysqli_fetch_array($result)) {

                  $sub=$row[2]*$row[1];

                  $final=$final+$sub;
    							echo "<tr>";
    							$var=str_replace("_"," ","$row[item_name]");
                  echo "<td>$row[0]</td>";

                  echo "<td >" . $row[2] . "</td>";
              		echo "<td>" . $row[1] . "</td>";
              		echo "<td>$sub</td>";

                  echo "</tr>";
    					}
          }


          }
          else {
            echo "Not Done ";
          }
          ?>
          </table>
          </div>

          <div style="margin-left: 58%;width: 17%;background-color: black;height: 6%">
          <p style="color: yellowgreen;font-size: 24px;padding-top: 5px;padding-left: 5px">Total Amount :- <?echo $final;?></p>
          </div>

        <form action="cart.php" method="POST">
        <?$_SESSION['total']=$final; ?>
        <br>
        <button class="button" type="submit" onclick="alert('Your order has placed successfully.')"><p class="try">Confirm</p></button>
        </div>
        </form>
    </body>
</html>
