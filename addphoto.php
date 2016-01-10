<?
include_once 'inc/libs.php';
include_once 'inc/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$nameImg = $_POST['user'];
	$file = $_FILES;
	uploadFileForServer($nameImg, $file);
	//
};
?>
	<div class="login ind">
	<h1>Add photo</h1>
		<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype ="multipart/form-data">
		<div class="upload">	<input  type="file" name="imageForServer"><br> </div>
			<strong>Name photo</strong><input type="text" name="user"/><br>
      <input type="submit" value="ok"><br>
		</form>
</div>	
<?
include 'inc/footer.php';
?>
