<?
include_once 'inc/libs.php';

if(!isUserLogin()){
	header('Location: login.php');
	exit;
}


include_once 'inc/header.php';
?>
	<div class="ind">
		<h1>My Photo</h1>
		<div class="photos">
			<?
			imgForIndex();
			?>
		</div>
	</div>
<?
include 'inc/footer.php';
?>