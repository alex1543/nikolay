<?php

	include 'inc.php';
				
// блок подключения к базе данных
	@ $db = mysqli_connect($MySQLServer, $MyUser, $MyPasswordSQL);

	if (!$db)
	{
		echo "Ошибка: не удается соединиться с сервером.";
		exit;
	}

// основной блок	
?>

<button style="margin-left:320px;width:70px;" onclick='alerted();' title="Добавьте запись"> Добавить </button>
	<FORM ACTION="guestbook.php" METHOD="POST" id="addForm" style="display: none;">
		<table>
			<tr><td>Ваше имя:</td><td><INPUT TYPE="text" NAME="name" SIZE=20 MAXLENGTH="30"><td></tr>
			<tr><td>Ваш email:</td><td><INPUT TYPE="text" NAME="email" SIZE=20 MAXLENGTH="30"></td></tr>
			<tr><td>Сообщение:</td><td><TEXTAREA NAME="message" COLS=50 ROWS=10></TEXTAREA></td></tr>
			<tr><td>&nbsp;</td><td><INPUT TYPE="submit" VALUE=" Отправить "></td></tr>		
		</table>
	</FORM>
<script type="text/javascript">
function alerted(){
	var addForm = document.getElementById('addForm'); // найти элемент
	if (addForm.style.display=='none') {
		addForm.style.display = 'block';} else {
		addForm.style.display = 'none';
	}
}
</script>
	
	<?php	

// блок удаления записи
	if (isset($_GET["id"])) {
		if ($_GET["password"] == MyPW()) {
		mysqli_select_db($db, $MyUserTable);    
		$query = "DELETE FROM notes WHERE ID=" . $_GET["id"];
		$result = mysqli_query($db,$query);
		echo mysqli_error($db);
		} else {
			echo "<p style=\"margin-left:250px;\">У Вас нет прав доступа на удаление записи.<br>"
			."Пожалуйста, вернитесь назад и повторите ввод.<br>"
			."Возможно Вы ошиблись при вводе пароля.</p>";
			exit;

		}
	}
	
// блок записи в базу данных	
	if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {
		$name=$_POST["name"]; 
		$email=$_POST["email"];
		$message=$_POST["message"];
		if ($name=="" || $email==""  || $message=="" )
		{
			echo "<p style=\"margin-left:250px;\">Вы указали не все детали.<br>"
			."Пожалуйста, вернитесь назад и повторите ввод.</p>";
			exit;
		}


		$name = mysqli_real_escape_string($db,$name);
		$email = mysqli_real_escape_string($db,$email);
		$message = mysqli_real_escape_string($db,$message);

		$query="CREATE DATABASE IF NOT EXISTS " . $MyUserTable . " DEFAULT CHARACTER SET utf8";
		$result=mysqli_query($db, $query);

		mysqli_select_db($db, $MyUserTable);
		$result=mysqli_query($db, "SET NAMES utf8");
		$query="CREATE TABLE IF NOT EXISTS notes (id int(5) NOT NULL AUTO_INCREMENT, name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, PRIMARY KEY(id), text TEXT NOT NULL)";
		$result=mysqli_query($db, $query);
    
		$query = "insert into notes (name, email, text) values ('".strip_tags($name)."', '".strip_tags($email)."', '".strip_tags($message)."')";
		$result = mysqli_query($db,$query);
		echo mysqli_error($db);
	}

// блок показа записей на экране	
	mysqli_select_db($db,$MyUserTable);
	$result=mysqli_query($db, "SET NAMES utf8");
	$query = "select * from notes WHERE ID > " . $MySpecValues . " ORDER BY ID DESC";
	@ $result = mysqli_query($db,$query);
if ($result) {
	$num_results = mysqli_num_rows($result);
	echo "<p style=\"margin-left:250px;\">Всего записей в гостевой книге сайта: ".$num_results."</p>";
	for ($i=0; $i <$num_results; $i++)
	{
		$row = mysqli_fetch_array($result);
?>
		
		<table>
			<tr><td>Имя:</td><td>
<?php
		echo stripslashes($row["name"]);
?>		
		</td></tr>
			<tr><td>Email:</td><td>
<?php
		echo stripslashes($row["email"]);
?>
		</td></tr>
			<tr><td>Краткий отзыв:</td><td>
<?php
		echo stripslashes($row["text"]); 
?>
			</td></tr>
			<tr><td>&nbsp;</td><td>

		</p>
				
		<form ACTION="guestbook.php" METHOD="GET">
		<input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />

		<input style="width:30px;" type="password" name="password" value="Пароль" title="Укажите пароль" />
		<input type="submit" value=" Удалить запись " title="Удалите запись" />
		&nbsp;</form>
			
		
			</td></tr>
			</table>	

<?php

	}
} else {
	echo "<p>Нет ни одной записи.</p>";
}
	
	mysqli_close($db);

?>

