<?php


sessio_start();

session_destroy();

header('location:login.php');
?>