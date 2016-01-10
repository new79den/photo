<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
	<?include_once 'inc/libs.php';?>
</head>
<body>
	<div class="menu">
		<div class="containMenu ind">
			<ul>
				<li><a href="login.php"><? if(isUserLogin()){echo "Exit";}else{echo "Login";}?></a></li>
				<? if(isUserLogin()){?>
				<li><a href="addphoto.php">Add photo</a></li>
				<li><a href="index.php">my photos</a></li>
				<?}?>
			</ul>
		</div>
	</div>