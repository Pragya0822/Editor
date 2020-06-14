<?php
  include_once("database.php");
  $name =$err = $mail= $password=  $cpassword = $submit_error= $empty_error= $success = '';
   if(isset($_POST['signup']))
	{
		if(isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['c_password']))
		{    $flag =1;
			if(empty($_POST['name']))
			   {   $flag =0;
				   $err =  "<b style='color:red'> Please provide the name.</b>";
			   }
		     if(empty($_POST['mail']))
			   {   $flag =0;
				   $err =  "<b style='color:red'> Please provide the Email.</b>";
			   }
			if(empty($_POST['password']))
			   {    $flag =0;
				    $err =  "<b style='color:red'> Please provide the password.</b>";
			   }
			if(empty($_POST['c_password']))
			   {    $flag =0;
				    $err =  "<b style='color:red'> Please provide the confirm password.</b>";
			   }
			if(empty($_POST['c_password']))
			   {    $flag =0;
				    $err =  "<b style='color:red'> Please provide the confirm password.</b>";
			   }
			if($_POST['c_password'] != $_POST['password']){
				    $flag =0;
   				    $err =  "<b style='color:red'> password does not match with the confirm password.</b>";
			   }
			if($flag==1) {
					$name =htmlspecialchars($_POST['name']);
					$mail =htmlspecialchars($_POST['mail']);
					$password =md5($_POST['password']);
				    $sel= "select * from users where Email='".$_POST['mail']."'";
					$row = mysqli_query($conn,$sel);
					if(mysqli_num_rows($row)>0){
						$submit_error='<b class="text-danger text-center">Member Already exist !</b>';
					}else{
						$insert_q="INSERT INTO users (Name,Email,Status,Password) VALUES('".$name."','".$mail."' ,1,'".$password."')";
						if(mysqli_query($conn,$insert_q)) {
							$success = "<b style='color:green'> Registration Done.</b>";
						}else {
							$submit_error='<b class="text-danger text-center" style="color:Red">You are not able to submit</b>';
						}
					}
			   }			 
		}else {
			$empty_error='<b class="text-danger text-center>Fill the textarea</b>';
		}
		 
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
  <div class="header">
  	<h2>Sign Up</h2>
  </div>
	 
  <form method="post" action="<?php $_SERVER['PHP_SELF'];?>" >
	  <?= $err . $submit_error.$empty_error. $success ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="name" placeholder="Name" required>
  	</div>
	  <div class="input-group">
  		<label>Email</label>
  		<input type="email" name="mail"  placeholder="Email" required>
  	</div>
	  
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" placeholder="Password" required>
  	</div>
	  
	  <div class="input-group">
  		<label>Password</label>
  		<input type="password" name="c_password" placeholder="Confirm Password" required>
  	</div>
	  
  	<div class="input-group">
  		<button type="submit" class="btn" name="signup">Sign Up</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php">Login</a>
  	</p>
  </form>
</body>
</html>