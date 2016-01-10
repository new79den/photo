<?
include_once 'inc/libs.php';
$user = $_POST['user'];
$password = $_POST['password'];

if (!empty($user) && !empty($password)){
	if (isLogin($user, $password)){
		header('Location: index.php');
	}	
}
	if(isset($_POST['logOut'])){
		logOut();
		header('Location: login.php');
	}

include_once 'inc/header.php';
if(!isUserLogin()){
?>
	<div class="login ind">
	<h1>Login</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<strong>User name</strong><input type="text" name="user"/><br>
			<strong>Password</strong><input type="password" name="password"/><br>
			<input type="submit" value="entrance">
		</form>
</div>	
<?
}else{?>
<div class="login ind">
	<h1>Login</h1>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<h2>Exit to Account <b><? echo $_COOKIE['user'] ?></b>?</h2>
			<button type="submit" name="logOut">logout</button>
	</form>
</div>
<?}
include 'inc/footer.php';
?>