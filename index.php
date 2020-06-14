<?php 
include_once("database.php");

 $logout ='';
if(isset($_GET['logout']) && $_GET['logout']=='get_out'){
	session_destroy();
	$logout ="Successfully logged out.";
}
/*if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }*/
  if(isset($_SESSION['login_user'])){
      header("location:doc.php");
      die();
   }
$err ='';
 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_user'])) {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM users WHERE Email = '".$myusername."' and Password = '".md5($mypassword)."'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['Status'];
	  $id = $row['id']; 
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
          $_SESSION['login_user'] = $myusername; 
		 $_SESSION['id'] = $id;
		   $_SESSION['name'] = $row['Name'];
		  
         header("location: doc.php");
      }else {
         $err = "Your Login Name or Password is invalid";
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
  	<h2>Login</h2>
	  <?= $logout ?>
  </div>
	 
  <form method="post" action="<?= $_SERVER['PHP_SELF']?>" >
  	<?=$err?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" placeholder="Enter Email" required>
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password"  placeholder="Enter Password" required>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user" >Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="signup.php">Sign up</a>
  	</p>
  </form>
</body>
</html>