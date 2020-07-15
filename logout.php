<?php
session_start();
if (isset($_SESSION['username']))
{
   // unset($_SESSION['username']);
   session_unset();
    session_destroy();
}
echo"<script>window.location=\"http://localhost:8080/mini1/home.html\"</script>";
?>