<?php
	include("database.php");
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
	$sel="SELECT * FROM `docs` WHERE userid=".$_SESSION['id'] ;
	$result=mysqli_query($conn,$sel);
	if(isset($_POST['submit']))
	{
		if(isset($_POST['editor']) && !empty($_POST['editor']))
		{
			$content=htmlspecialchars($_POST['editor']);
		}else{
			$empty_error='<b class="text-danger text-center>Fill the textarea</b>';
		}
		if(isset($content)&& !empty($content))
		{
			$insert_q="INSERT INTO content (content) VALUES('".$content."')";
			if(mysqli_query($conn,$insert_q)){
				echo "<b style='color:green'> done</b>";
			}else{
				$submit_error='<b class="text-danger text-center">You are not able to submit</b>';
			}
		}
	}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Sample </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h3> Welcome <?=$_SESSION['name']?> </h3>      
	  <h4> <a href="index.php?logout=get_out" class="btn btn-primary"> logout </a></h4> 
	  <a href="new_doc.php" target ="_self" class="btn btn-primary"> Text Editor </a>
  </div>
</div>
  
<div class="container-fluid bg-3 text-center">    
  <h3> My Document List </h3><br>
  <div class="row">
	  <div class="col-sm-3"></div>
	<center>
    <div class="col-sm-6">
		
	  <table class="table table-striped">
		<thead>
		  <tr>
			<th>id</th>
			<th>Document List </th>
		  </tr>
		</thead>
		<tbody>
			<?php $i=1;
				if (mysqli_num_rows($result) > 0) { 
					   while($row = mysqli_fetch_assoc($result)) { ?> 
		  	<tr>
			 <td>1</td>
			 <td><a href="editor.php?id=<?=$row["id"]?>" target ="_self" > Document <?=$i?> </a></td> 
			</tr>
		<?php $i++ ;}} ?>
		</tbody>
	  </table> 
	  </div></center>
	</div>
	</div>
	<br>
 
<footer class="container-fluid text-center">
  <p>@</p>
</footer>

</body>
</html>
