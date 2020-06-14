<?php
	include("database.php");
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
	
   if(!isset($_GET['id']) && !isset($_POST['id'])){
      header("location:doc.php");
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
	
	if(isset($_GET['id'])){
		$id=  $_GET['id'];
	}else{
		$id =$_POST['id'];
	}
	  
   $sel="select * from docs where id=".$id.""; 
   $res_doc = mysqli_query($conn, $sel);	
	
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
			$insert_q="Update docs set content ='".$content."' where id =$id ";
			if(mysqli_query($conn,$insert_q)){
				$success = "<b style='color:green'> Document Update Done</b>";
			}else{
				$submit_error='<b class="text-danger text-center">You are not able to submit</b>';
			}
		}
	}

	
	if(isset($_POST['submit_ids']))
	{   
		if(isset($_POST['ids']) && !empty($_POST['ids']))
		{
			$content = $_POST['ids'];
		}else{
			$empty_error='<b class="text-danger text-center>Select the ids first.</b>';
		}
		if(isset($content)&& !empty($content))
		{   
			$content = implode(',',$content);
			$insert_q="update docs set userid ='".$content."' where id=$id";			 
			if(mysqli_query($conn,$insert_q)) {
				$success = "<b style='color:green'> Shared Record updated! </b>";
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
		 <div class="row" style="background: #272525;">
			<div class="col-sm-1">
			   <h3> <a href="doc.php" class="btn btn-primary"> Back </a> </h3>
			</div>
			<div class="col-sm-4" style=" color: white;margin-top: 29px;"> Number Of peoples the docs shared with:
				<?php if (mysqli_num_rows($res_doc) > 0) {
					   while($row = mysqli_fetch_assoc($res_doc)) {
       					  $idc= $row["userid"];
     					}
					}
				$ex =explode(',',$idc);
				for($i=1;$i<=count($ex);$i++){
					if($i<=5){
				 ?>
				<i class="fa fa-user-circle-o" aria-hidden="true" style="color: white;"></i>
			   
				<?php }
				} if(count($ex)>5){ $fiv=count($ex)-5;
					echo "...<span class='badge'>".$fiv."</span>" ;	
					}?>
		    </div>
			 <?php  $ar = array($idc);?>
			<form method="post" action="<?=  $url; ?>" >
				<div class="col-sm-4">
					<label style="color:white"> Please select the Ids to share </label>
					 <input type="hidden" name="id" value="<?= $id ?>" required/>
					 <div class="form-group">
						 
								 <select id="framework" name="ids[]" multiple class="form-control" required>
								  <option value="">Select Id for share</option>
								  <?php 
								  if (mysqli_num_rows($res) > 0) {
								   while($row = mysqli_fetch_assoc($res)) { 
								   if(!in_array($row["id"], $ar)){
								  ?>
									<option value="<?=$row["id"]?>"><?= $row["Email"]?></option>					  
								  <?php }}} ?>					  
							   </select>
							 				   
					 </div>					 
			   </div>
				<div class="col-sm-1">
 	 						 <input type="submit" class="btn btn-info" style="float: left;margin-top: 22px;" name="submit_ids" value="Submit" />
    			 </div>
		   </form>	
		</div>
			<div class="row">
				<center><h4>Welcome <?=$_SESSION['name']?> Please Edit Your Document</h4> <br>
					<?= $err . $submit_error.$empty_error. $success ?> </center>				
			<form action="<?php echo $url;?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $id ?>" required/>
				<textarea class="ckeditor" name="editor" value=""><?php 
				$sel="select * from docs where id=".$id.""; 
			   $res_doc = mysqli_query($conn, $sel);	
				if (mysqli_num_rows($res_doc) > 0) {
					   while($rw = mysqli_fetch_array($res_doc,MYSQLI_ASSOC)) {
       					 echo $rw["content"];
     					}
					}
				 ?></textarea>	
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