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
        <title>Logs</title>
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
            margin-left: 44%;
            margin-top: 1%;
            margin-right: 45%;
            padding: 1%;
            font-size: 48px;
            color: white;
            background-color: black;
        }

        .menu{
            background-color: black;
            width: 70%;
            border: 1px solid white;
            margin-left: 15%;
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
        <h1>Logs</h1>
        <div class="menu">
        <table cellspacing="10" align="center" cellpadding="20">
        <col width="100">
        <col width="200">
        <col width="400">
        <col width="100">
        <col width="100">
        <col width="440">
        <tr>
        <th>Bill No</th>
        <th>Username</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Total   (Rs)</th>
        <th>Date Time</th>
        </tr>
        
    
    <?php
        $sql4="SELECT logs.bill_no,final_order.username,logs.item_name,logs.qty,final_order.total,logs.date_time FROM logs INNER JOIN final_order ON final_order.bill_no=logs.bill_no ORDER BY bill_no DESC";
        if($result=mysqli_query($conn,$sql4))
        {

            if (mysqli_num_rows($result) > 0) 
            {
                $temp=0;
                while ($row=mysqli_fetch_array($result)) 
                {
                    echo "<tr>";
                    $var=mysqli_num_rows(mysqli_query($conn,"SELECT bill_no from logs where bill_no=$row[0]"));

                    if($temp===0)
                    {
                        echo "<td rowspan=$var >".$row[0]."</td>";
                    
                    echo "<td rowspan=$var >".$row[1]."</td>";
                    }
                    echo "<td>".$row[2]."</td>";
                    echo "<td>".$row[3]."</td>";
                    if($temp===0)
                    {
                    echo "<td rowspan=$var >".$row[4]."</td>";
                    echo "<td rowspan=$var >".$row[5]."</td>";
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
