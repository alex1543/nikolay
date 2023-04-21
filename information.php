﻿<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Николай Стрижаченко: Полезное</title>
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
			<p>Полезное</p>	
			<li><a href="contacts.php">Почта</a></li>
			</ul>					
		</aside>
			<h3>Полезное</h3>

		
		<?php 

		include 'inc.php';
		echo MyReadBDSQL(4); 

		?>
			
		</main>	
	</content>
	<footer>
		<a href="edit.php">Редактор</a>
		<h6>© 2022 Saint-Petersburg, Alexey Subbotin<br />
		alesu1543@gmail.com</h6> 
	</footer>
</body>
</html>