<?php
	include("database.php");
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   } 

   $name =$err = $mail= $password=  $cpassword = $submit_error= $empty_error= $success = '';
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
     
   $sel="select id,Email from users"; 
   $res = mysqli_query($conn, $sel); 
	$id= '';
	 
	  
    
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
			$insert_q="Insert into docs (content,userid) values( '".$content."',". $_SESSION['id'].")";
			if(mysqli_query($conn,$insert_q)){
				$success = "<b style='color:green'> Document saved Done</b>";
			}else{
				$submit_error='<b class="text-danger text-center">You are not able to submit</b>';
			}
		}
	}
	
	
     
?>
 
<html>
<head>
   <title>Online Text Editor</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
	
<script type="text/javascript">
    //resize CKEditor with customised height and width
    CKEDITOR.replace('editor',{
	width: "1000px",
        height: "1400px"
     }
    );
</script>
</head>
	<body>
		<div class="container-fluid">
		 <div class="row">
			<div class="col-sm-1">
			   <h3> <a href="doc.php" class="btn btn-primary"> Back </a> </h3>
			</div>
			<div class="col-sm-4">
				 
		    </div>
			<div class="col-sm-4">
				 
		   </div>
		</div>
			<div class="row">
			<?= $err . $submit_error.$empty_error. $success ?>
			<form action="<?php echo $url;?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $id ?>" required/>
				<textarea class="ckeditor" name="editor" value=""></textarea>	
				<br>
				<center>
				<button type="submit" name="submit" class="btn btn-success"><span class="fa fa-save"></span> Save File </button>
				</center>
			</form>	
			</div>
		
  </div>
  
	<script>
$(document).ready(function(){
 $('#framework').multiselect({
  nonSelectedText: 'Select Ids',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 
 $('#framework_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#framework option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('#framework').multiselect('refresh');
    alert(data);
   }
  });
 });
 
 
});
</script>
	</body>
</html>