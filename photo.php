<?
include_once 'inc/libs.php';

if(!isUserLogin()){
	header('Location: login.php');
	exit;
}
include_once 'inc/header.php';
$nameGen = $_GET['img'];
top($nameGen);
?>
<div class="ind">
		<h1><?echo $_GET['name'];?></h1>
		<img class="bigPhoto" src="img/<? echo $_GET['img'];?>"  alt=""></div>
	</div>
	
<?
include 'inc/footer.php';
?>