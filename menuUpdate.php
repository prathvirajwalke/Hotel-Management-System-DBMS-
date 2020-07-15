<?php
session_start();
$severname="localhost";
$username1="root";
$password="";
$dbname="ai";

$conn=mysqli_connect($severname,$username1,$password,$dbname);


  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $var=str_replace(" ","_",$_POST['itemname']);
    $pri=$_POST['updatePrice'];

    $sql="SELECT item_name from menu where item_name=\"$var\"";
    $result1=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result1) > 0)
      {
      $sql="UPDATE `menu` SET `price`=$pri WHERE item_name=\"$var\"";
      $result=mysqli_query($conn,$sql);
      echo "<script>alert('Updated Successfully')</script>";
      }
      else {
        echo "<script>alert('Update Failed!!!')</script>";
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

            background-repeat: no-repeat;
        }

        .welcome{
            font-size: 28px;
            color: white;
            font-weight: bold;
            background-color:black;
            height: 13%;
        }

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
            background-color: Black;
            width: 40%;
            border: 1px solid white;
            margin-left: 29%;
            opacity: 0.9;
            margin-top: 1%;
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

        .button{
            margin-left: 57%;
            text-decoration: none;
            background-color: red;
            padding: 0px;
            height: 40px;
            width: 100px;
            color: white;
            font-size: 18px;
        }

        .button:hover{
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

        .button2{
          float: left;
          text-decoration: none;
          margin-top: 2%;
          height: 35px;
          background-color: black;
          width: 38px;
          margin-left: 3%;
        }


    </style>
    </head>

    <body>
      <div class="welcome">
          <p style="float: left;margin-left: 1%;">WELCOME MANAGER</p>
          <p style="float: left;margin-left: 28%;"><a href="mpending.php" style="text-decoration: none;color: white;font-size: 25px;">Pending Order</a></p>
          <p style="float: left;margin-left: 3%;"><a href="menuUpdate.php" style="text-decoration: none;color: white;font-size: 25px;">Update Menu</a></p>
          <p style="float: left;margin-left: 3%;"><a href="mlogs.php" style="text-decoration: none;color: white;font-size: 25px;">Logs</a></p>
          <form action="logout.php" method="POST">
              <button class="button2" type="submit" onclick="alert('Logged Out.')"><b class="fa fa-sign-out" style="font-size:28px;color:white"></b></button>
            </form>
      </div>
      <div class="parallax">
        <h1>MENU</h1>

        <div class="menu">
        <table cellspacing="10" align="center" cellpadding="20">
        <col width="500">
        <col width="300">
        <tr>
        <th>Item Name</th>
        <th>Item Price  (Rs)</th>
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

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";

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
                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";
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

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";

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

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";

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

                echo "<td >" . $var . "</td>";
            		echo "<td>" . $row['price'] . "</td>";

                echo "</tr>";
  					}
        }


        }
        ?>
        </table>
        </div><br>
        <form action="menuUpdate.php" method="POST">
        <p style="margin-left:30%;font-size:24px;color:white;background-color:black;margin-right:53%;padding:5px;">Enter Item-Name :-
        <input style="margin-left:275px;margin-top: -27px;height: 30px;font-size: 16px;" list="menu" name="itemname">
        <datalist id="menu">
          <?
            if($result=mysqli_query($conn,"SELECT item_name from menu"))
            {
    
            if (mysqli_num_rows($result) > 0) {
    
                while($row = mysqli_fetch_array($result)) {
                  $var=str_replace("_"," ","$row[item_name]");
                  echo"<option value=\"$var\">";
                }
              }
            }
            
          ?>
          </datalist>
      </p>
        <p style="margin-left:30%;font-size:24px;color:white;background-color:black;margin-right:50%;padding:5px;">Enter Updated Price :-
        <input style="margin-left:275px;margin-top: -27px;height: 30px;font-size: 16px;" type="text" name="updatePrice"></p>
        <p><button class="button" type="submit" >UPDATE</button></p><br><br>
        </div>
        </form>

    </body>
</html>
