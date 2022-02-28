<!doctype html>
<html lang="ru">
<head>
<!-- saved from url=(0014)about:internet -->
<script>
document.createElement('header');
document.createElement('footer');
document.createElement('nav');
document.createElement('main');
document.createElement('aside');
document.createElement('content');

</script>
	<meta charset="UTF-8">
	<title>Николай Стрижаченко: Редактор</title>
	<meta name="description" content="Николай Стрижаченко, Личная страничка"> 
    <meta name="Keywords" content="Николай Стрижаченко, Личная страничка">
	<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1><a href="." title="Личная страница" alt="Личная страница">Личная страница</a></h1>
		<h2><a href="." title="Личная страница" alt="Личная страница">Николая Стрижаченко</a></h2>
		<nav>
		</nav>
	</header>
	<content>	
		<main>
		<aside>

			<ul>
			<li><a href=".">Главная</a></li>
			<li><a href="about.php">Обо мне</a></li>
			<li><a href="guestbook.php">Гостевая книга</a></li>
			<li><a href="interests.php">Мои интересы</a></li>
			<li><a href="information.php">Полезное</a></li>	
			<li><a href="contacts.php">Почта</a></li>
			</ul>					
		</aside>
			<h3>Редактор</h3>


	<?php
	include 'inc.php';
	// блок записи в БД	
	if (isset($_POST["password"])) {
		if ($_POST["password"] == MyPW()) {
			MySaveBDSQL();
		} else {
			echo "<p style=\"margin-left:250px;color:red;\">У Вас нет прав доступа на редактирование записей.<br /><br />"
			."Возможно, Вы ошиблись при вводе пароля.<br />"
			."Пожалуйста, повторите ввод пароля.</p>";
		}
	}
	?>
			
	<FORM ACTION="edit.php" METHOD="POST">
		<table style="font-size:14px;margin:10px;padding:10px;border:1px gray solid;margin-left:230px;">
		<tr style="font-size:12px;margin:10px;padding:10px;"><td>Обо мне:</td>
		<td><?php echo '<textarea class="ViewEdit" name="msg1" cols=50 rows=10>'.trim(MyReadBDSQL(2), "\x00..\x1F"); ?></textarea></td></tr>
		<tr style="font-size:12px;margin:10px;padding:10px;"><td>Мои интересы:</td>
		<td><?php echo '<textarea class="ViewEdit" name="msg2" cols=50 rows=10>'.trim(MyReadBDSQL(3), "\x00..\x1F"); ?></textarea></td></tr>
		<tr style="font-size:12px;margin:10px;padding:10px;"><td>Полезное:</td>
		<td><?php echo '<textarea class="ViewEdit" name="msg3" cols=50 rows=10>'.trim(MyReadBDSQL(4), "\x00..\x1F"); ?></textarea></td></tr>
		<tr style="font-size:12px;margin:10px;padding:10px;"><td>Почта:</td>
		<td><?php echo '<textarea class="ViewEdit" name="msg4" cols=50 rows=10>'.trim(MyReadBDSQL(5), "\x00..\x1F"); ?></textarea></td></tr>
		<tr style="font-size:12px;margin:10px;padding:10px;"><td>&nbsp;</td>
		<td style="text-align:right;">Пароль: 
			<input style="width:30px;" type="password" name="password" value="Пароль" title="Укажите пароль" />
			<input style="cursor:pointer;" type="submit" value=" Отредактировать " title="Отредактируйте записи" />
		</td>
		
		</tr>		
		</table>
	</FORM>
		<br /><br /><br /><br /><br />	
		
			
		</main>	
	</content>
	<footer>
		<a href="edit.php">Редактор</a>
		<h6>© 2022 Saint-Petersburg, Alexey Subbotin<br />
		alesu1543@gmail.com</h6> 
	</footer>	
</body>
</html>