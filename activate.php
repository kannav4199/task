<?php

session_start();
include 'dbcon.php';
if(isset($_GET['token']))
{
	$token=$_GET['token'];
	$update="update users set status='active' where token='$token' ";
	$query=mysqli_query($con,$update);

	if($query)
	{
		if(isset($_SESSION['msg']))
		{
			$_SESSION['msg']="Account activated";
			header('location:login.php')
		}
	}

}


?>