<?php
session_start();
$severname="localhost";
$username1="root";
$password="";
$dbname="ai";

$conn=mysqli_connect($severname,$username1,$password,$dbname);

 ?>


<html>
    <head>
        <title>History</title>
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
        
        
      .current{
        margin-left: 38%;
        margin-top: 0.3%;
        padding: 1%;
        font-size: 48px;
        color: white;
        background-color: black;
        }

        .history{
        margin-left: 42%;
        margin-top: 0.3%;
        margin-right: 43%;
        padding: 1%;
        font-size: 48px;
        color: white;
        background-color: black;
        }

        .menu{
        background-color: black;
        opacity: 0.9;
        width: 55%;
        border: 1px solid white;
        margin-left: 23%;
        margin-top: 0%;
        }

        .menu1{
            background-color: black;
            width: 50%;
            opacity: 0.9;
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

        .parallax{
            background-image: url("h_Image.jpeg");
            margin-top: 1%;
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


        
        <?
        $sql2="SELECT pending_order.item_name,pending_order.qty,menu.price,pending_order.bill_no from pending_order INNER JOIN menu on pending_order.item_name=menu.item_name where pending_order.bill_no in (SELECT bill_no from final_order where username='{$_SESSION['username']}')";
        if(!$result2=mysqli_query($conn,$sql2))
        {
          echo "Not Done 2";
        }
        //$row=mysqli_fetch_array($result2);
        echo "<div class='parallax'>";
        if(mysqli_num_rows($result2) > 0)
        {
        echo "<h1 class=\"current\">Current Order</h1>";
        echo "<div class='menu1'>
        <table cellspacing=\"10\" align=\"center\" cellpadding=\"20\" style=\"background-color: black\">
        <col width=\"100\">
        <col width=\"400\">
        <col width=\"150\">
        <col width=\"100\">
        <col width=\"150\">

        <tr>
        <th>Bill No</th>
        <th>Item Name</th>
        <th>Item Price  (Rs)</th>
        <th>Quantity</th>
        <th>Sub-Total (Rs)</th>
";

            $temp=0;
            while($row = mysqli_fetch_array($result2)) {
              $var=mysqli_num_rows(mysqli_query($conn,"SELECT bill_no from pending_order where bill_no=$row[3]"));
  							echo "<tr>";
                $var1=str_replace("_"," ","$row[0]");
                if($temp===0)
                    {
                        echo "<td rowspan=$var >".$row[3]."</td>";
                    }
                //echo "<td >".$row[3]." </td>";
                echo "<td >" . $var1 . "</td>";
            		echo "<td>" . $row['2'] . "</td>";
                echo "<td>" . $row['1'] . "</td>";
            		echo "<td>".$row[1]*$row[2]."</td>";

                echo "</tr>";
                $temp++;
                if($temp===$var)
                {
                    $temp=0;
                }
  					}


            $sql="SELECT total from final_order where username='$_SESSION[username]' ORDER BY bill_no desc limit 1";
            $res=mysqli_query($conn,$sql);
            $res3=mysqli_fetch_array($res);
        echo "</table>
        </div>
        <div style=\"margin-left: 57%;width: 20%;background-color: black;height: 6%\">
        <p style=\"color: yellowgreen;font-size: 24px;padding: 5px;\">Total Amount :- ".$res3[0]."</p>
        </div>
        ";
      }
        ?>
        <br>

        
            
          <?php
            $sql="SELECT logs.bill_no,logs.item_name,logs.qty,final_order.total,logs.date_time FROM logs INNER JOIN final_order ON logs.bill_no=final_order.bill_no WHERE final_order.username='{$_SESSION['username']}' ORDER BY bill_no DESC";
            if($result=mysqli_query($conn,$sql))
          {

            if (mysqli_num_rows($result) > 0) 
            {

              echo"<h1 class=\"history\">History</h1>
              <div class=\"menu\">
                <table cellspacing=\"10\" align=\"center\" cellpadding=\"20\">
                <col width=\"150\">
                <col width=\"400\">
                <col width=\"150\">
                <col width=\"150\">
                <col width=\"440\">
                <tr>
                <th>Bill No</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Total   (Rs)</th>
                <th>Date Time</th>
                </tr>";

                $temp=0;
                while ($row=mysqli_fetch_array($result)) 
                {
                    
                    $var=mysqli_num_rows(mysqli_query($conn,"SELECT bill_no from logs where bill_no=$row[0]"));
                    echo "<tr>";
                    if($temp===0)
                    {
                        echo "<td rowspan=$var >".$row[0]."</td>";
                    }
                    echo "<td>".$row[1]."</td>";
                    echo "<td>".$row[2]."</td>";
                    if($temp===0)
                    {
                    echo "<td rowspan=$var >".$row[3]."</td>";
                    echo "<td rowspan=$var >".$row[4]."</td>";
                    }
                    echo "</tr>";
                    $temp++;
                    if($temp===$var)
                    {
                        $temp=0;
                    }
                }
            }
        }
              
        ?>
                
        </table>
            </div><br>
          </div>
    </body>
</html>
