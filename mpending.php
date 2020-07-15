<?php
session_start();
$severname="localhost";
$username1="root";
$password="";
$dbname="ai";

$conn=mysqli_connect($severname,$username1,$password,$dbname);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flag=0;
    foreach($_POST['checkbox'] as $selected){
        $sql="UPDATE `pending_order` SET `status`='Prepared' WHERE bill_no=$selected";
        mysqli_query($conn,$sql);
 }
    //$sql2="INSERT into logs (bill_no,item_name,qty) select pending_order.bill_no,pending_order.item_name,pending_order.qty from pending_order where pending_order.status='Prepared'";
    //$sql3="DELETE FROM pending_order where pending_order.status='Prepared'";
    //if(!mysqli_query($conn,$sql2))
    // {
    //   echo "DONE";
    // }
    //mysqli_query($conn,$sql3);
    header('Location:mlogs.php');
    exit();

}
?>

<html>
    <head>
        <title>Pending Orders</title>
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

        table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            color: white;
            text-align: center;
            align-self: center;
            font-size:20px;
            }

            th{
                font-size: 22px;
            }


        h1{
            margin-left: 34%;
            margin-top: 1%;
            margin-right: 35%;
            padding: 1%;
            font-size: 48px;
            color: white;
            background-color: black;
        }

        .menu{
            background-color: black;
            width: 50%;
            border: 1px solid white;
            margin-left: 25%;
            margin-top: 1%;
        }

        #quantity{
            text-align: center;
            width: 70%;
        }

        #checkbox{
            align-self: center;
            width: 70px;
            block-size: 20px;
        }

        .button{
            margin-left: 66%;
            text-decoration: none;
            background-color: red;
            font-size:25px;
            color: white;
            height: 50px;
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
        <form action="mpending.php" method="post">
        <?php
        $sql2="SELECT * FROM pending_order ORDER BY bill_no desc";
        if(!$result2=mysqli_query($conn,$sql2))
        {
          echo "Not Done 2";
        }
        //$row=mysqli_fetch_array($result2);
        if(mysqli_num_rows($result2) > 0)
        {
        echo "<h1>Pending Orders</h1>";
        echo"<div class='menu'>
        <table cellspacing=\"10\" align=\"center\" cellpadding=\"20\">
        <col width=\"150\">
        <col width=\"400\">
        <col width=\"100\">
        <col width=\"100\">
        <tr>
        <th>Bill No</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Status  (Prepared)</th>
        </tr>";
        $temp=0;
        while ($row=mysqli_fetch_array($result2)) {
          echo "<tr>";
          $var=mysqli_num_rows(mysqli_query($conn,"SELECT bill_no from pending_order where bill_no=$row[bill_no]"));

          if($temp===0){
          echo "<td rowspan=$var >".$row['bill_no']."</td>";

          }

          echo "<td>".$row['item_name']."</td>";
          echo "<td>".$row['qty']."</td>";
          if($temp===0){
          echo "<td rowspan=$var><input  type=\"checkbox\" id=\"checkbox\" name=\"checkbox[]\" value=\"$row[bill_no]\"></td>";
          }

          $temp++;
          if($temp===$var)
          {
            $temp=0;
          }
        }
    echo "</table>";
    echo "</div>";
      }
        ?>

        <br>
        <button class="button" type="submit" onclick="alert('Updated Successfully.')">Confirm</button>
    </div>
    </form>
    </body>
</html>
