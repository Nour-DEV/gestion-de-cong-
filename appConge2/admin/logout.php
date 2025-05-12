<?php 
session_start();
  if(isset($_GET["log"])){
    session_destroy();
    header("location: index.html");
    exit();
  }
?>