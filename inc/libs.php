<?
define('DIR',  dirname(__DIR__) . '/img');

/*прверка авторизации пользователя*/
function isLogin($user, $pass){
	$users = array('user1' => '111', 'user2' => '222');
	setcookie('user', $user, time()+86400);
	return isset($users[$user]) &&  $users[$user] == $pass;
}
/*установка куки*/
function isUserLogin(){
	return isset($_COOKIE['user']);
}
/*logout выйти с акаунта*/
function logOut(){
	setcookie('user', '', time()-86440);
}
/*  функция получения списка файлов */
/*function getImg(){
	return(array_diff(scandir(DIR), array('.','..')));
}*/
/*вывод картинок*/
/*function imgForIndex($img){
	foreach ($img as $key) {
		?>
			<div class="photo">
				<div class="imag"><img src="img/<? echo $key;?>"  alt=""></div> 
				<h2>Name images</h2>
				<h3>Rating <strong>22</strong></h3>
			</div>
		<?
	}
}*/
function renameFile($name, $type){
	switch ($type) {
		case 'image/gif': 
			return $name . '.gif';
			break;
		case 'image/png': 
			return $name . '.png';
			break;
		case 'image/jpeg': 
			return $name . '.jpg';
			break;
		default:
			return false;
	}
}

/*Загрузка файла на сервер*/
function uploadFileForServer($name, $file){
	$arr = array_keys($file);
	$nameArr = implode($arr);
	$types = array('image/gif', 'image/png', 'image/jpeg');
	$size = 1024000;
	$nameGen = substr( md5(rand()), 0, 7);
	$typeFile = $_FILES[$nameArr]['type'];
	$newName = renameFile($nameGen, $typeFile);
	$upload = DIR .'/'. $newName;
	
	$name = (empty($name)) ? 'no name' : $name;
	$tupefile = $_FILES[$nameArr]['type'];
	

	if(in_array($_FILES[$nameArr]['type'], $types) && $_FILES[$nameArr]['size'] < $size){
		if(is_uploaded_file($_FILES[$nameArr]['tmp_name'])){
			connectDB();
			insertTable($newName, $name);
			return move_uploaded_file($_FILES[$nameArr]['tmp_name'], $upload);
		}
	}
}
/*Соединение с базой*/
function connectDB(){
	$server = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'photo';

$conn = mysql_connect($server, $user, $password);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}else{
		mysql_select_db($db);
	}
}

/*Добавление картинки в БД*/
function insertTable($newName, $name){
	$sql = "INSERT INTO img (nameGen, name, top)
					VALUES ('$newName', '$name', 0)";
	 mysql_query($sql);
}

/*Вывод картинки с БД*/
function imgForIndex(){
	connectDB();
	$result = mysql_query('SELECT nameGen, name, top 
												 FROM img
												 ORDER BY top DESC');
;
	while($row = mysql_fetch_assoc($result)){
			?>
			<a href="photo.php?img=<?echo $row['nameGen'];?>&name=<? echo $row['name'];?>">
				<div class="photo">
					<div class="imag"><img src="img/<? echo $row['nameGen'];?>"  alt=""></div> 
					<h2><? echo $row['name'];?></h2>
					<h3>Rating <strong><? echo $row['top'];?></strong></h3>
				</div>
			</a>
			<?
	}
}
/*Рейтинг*/
function top($nameGen){
		connectDB();
		$result = mysql_query("SELECT top FROM img WHERE nameGen = '$nameGen'");
		$row = mysql_fetch_assoc($result);
		$count = $row[top];
		$count++;
		$result = mysql_query("UPDATE img SET top = $count  WHERE nameGen = '$nameGen'");
}