<?php

session_start();


?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'dbcon.php' ?>
	<?php include 'links.php' ?>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

	<?php


if(isset($_POST['submit']))
{

	$name=mysql_real_escape_string($con,$_POST['name']);
	$email=mysql_real_escape_string($con,$_POST['email']);
	$phone_number=mysql_real_escape_string($con,$_POST['phone_number']);
	$address=mysql_real_escape_string($con,$_POST['address']);
	$pswrepeat=mysql_real_escape_string($con,$_POST['pswrepeat']);
	$password=mysql_real_escape_string($con,$_POST['password']);
	$password=md5($password);
	$pswrepeat=md5($pswrepeat);
	$token=bin2hex(random_bytes(15));
	$emailquery="select * from users where email='$email' ";
	$query=mysqli_query($con,$emailquery);
	$emailcount=mysqli_num_rows($query);

	if($emailcount>0)
		echo "email already exists";
	else {
		if($password==$pswrepeat  )
		{
			$insertquery="insert into users (name,email,phone_number,pswrepeat,password,token,status) values ('$name','$email','$phone_number','$pswrepeat','$password','$token','inactive'     )  ";

			$myquery=mysqli_query($con,$insertquery);
			if($myquery)
			{
				$subject="email verification";
				$body="hi $name, click here to activate your account http://localhost/Task/active.php?token=$token";

				$sender_email="From: kannav4199@gmail.com";

				if(mail($email,$subject,$body,$sender_email))
				{
					$_SESSION['msg']="Check your email $email to acyivate your account";
			header('location:login.php')
				}
			}
				else
					?>
				<script >alert("error")</script>
				<?php
			
		}
		else
		{
			?>
			<script >alert("password not matching")</script>
			<?php
		}
	}
}


	?>

 <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mynav" >
       <div class="container-fluid">
        <a href="index.html" class="navbar-brand">Task</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
         <ul class="nav navbar-nav text-center ml-auto">
           <li class="nav-item  nav-link active" style="border-style: 2px solid #181174"><a href="index.php" >Home</a></li>       
        
          <li class="nav-item nav-link"><a onclick="lopenForm()">Login</a></li>
          <li class="nav-item nav-link"><a onclick="ropenForm()">Register</a></li>

        </ul>
        </div>
       </div>
    </nav>
</header>



<div id="container">
	<div id="main">
		<div id="intro">
		<h1 >Welcome To My Website</h1>
              <h2>LoggedIN</h2>
          </div>


<!-- ////////////////Register//////////////////////////////// -->
<div class="form-popup container-fluid" id="myrForm">
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" class=" form-control form-group">
				 

				    <h1>Register</h1>
				    <p>Please fill in this form to create an account.</p>
				    <hr>


				    <label for="name"><b>Name</b></label>
				    <input type="text" name="name"  >
				    <br>
				    <label for="email"><b>Email</b></label>
				    <input type="text" placeholder="Email" name="email" required>
					<br>
				       <label for="phone_number"><b>Phone Number</b></label>
     			
			     <input type="tel" name="phone_number" pattern="^(?=.{10,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$" required>
      			<br>
      			<label for="address"><b>address</b></label>
     				<input type="text" name="address"   maxlength="60" >
<br>
				    <label for="psw"><b>Password</b></label>
				    <input type="password" placeholder="Enter Password" name="password" required>
				    <h4>Minimum 6 character, At least 1 small letter, at least 2 capital letter, at least 1 special character</h4>
				    <br>
				    <label for="pswrepeat"><b>Repeat Password</b></label>
				    <input type="password" placeholder="Repeat Password" name="pswrepeat" required>



				    <br>				    <p>Already have an account? <a onclick="lopenForm()">Sign in</a>.</p>
				 

				    
				    <div type="submit" name="submit" class="btn btn-primary registerbtn">Register</div>
				    <div type="button" class="btn btn-success cancel" onclick="rcloseForm()">Close</div>
				 
				
				   
				</form>
			</div>
			
					



				<!-- //////////////registration end//////////////////////////// -->




				<!-- //////////////////////signin////// -->

				<div class="container form-popup" id="mylForm">
				  <h2>Login</h2>
				  <form class="form-horizontal" action="/action_page.php">
				    <div class="form-group">
				      <label class="" for="email">  Email/ Phone Number :</label>
				      <div class="col-sm-10">
				        <input type="email" class="form-control" id="email" placeholder="Enter Email/ Phonenumber" name="email">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-sm-2" for="pwd">Password:</label>
				      <div class="col-sm-10">          
				        <input type="password" class="form-control"  placeholder="Enter password" name="password">
				      </div>
				    </div>
				    <div class="form-group">        
				      <div class="col-sm-offset-2 col-sm-10">
				        <p>Does not have an account? <a onclick="ropenForm()" >Register</a>.</p>
				      </div>
				    </div>
				    <div class="form-group">        
				      <div class="col-sm-offset-2 col-sm-10">
				        <div type="submit" class="btn btn-success">Login	</div>
				        <div type="button" class="btn btn-primary" onclick="lcloseForm()">Close</div>
				      </div>
				    </div>
				  </form>
				</div>

<!-- ///////////////sign in end/////////////////////////// -->    

	</div>



</div>


<footer>
	<span><a href="https://kannav4199.github.io">kannav4199.github.io</a> © 2020.<br><span>
</footer>



<!-- ////////////////popup///////////// -->
<script>
function ropenForm() {
	lcloseForm();
  document.getElementById("myrForm").style.display = "block";
    document.getElementById("intro").style.display = "none";
}

function rcloseForm() {
  document.getElementById("myrForm").style.display = "none";
  document.getElementById("intro").style.display = "block";
}


function lopenForm() {
	rcloseForm();
  document.getElementById("mylForm").style.display = "block";
    document.getElementById("intro").style.display = "none";
}

function lcloseForm() {
  document.getElementById("mylForm").style.display = "none";
  document.getElementById("intro").style.display = "block";
}
</script>








</body>
</html>