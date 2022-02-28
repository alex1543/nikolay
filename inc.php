<?php

	include 'deff.php';

			function MyNEWBase($dbPW) {

				include 'deff.php';
	
				$query="CREATE DATABASE IF NOT EXISTS " . $MyUserTable . " DEFAULT CHARACTER SET utf8";
				$result=mysqli_query($dbPW, $query);
					
				mysqli_select_db($dbPW, $MyUserTable);
				$result=mysqli_query($dbPW, "SET NAMES utf8");
				$query="CREATE TABLE IF NOT EXISTS notes (id int(5) NOT NULL AUTO_INCREMENT, name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, PRIMARY KEY(id), text TEXT NOT NULL)";
				$result=mysqli_query($dbPW, $query);
    
				$query = "insert into notes (name, email, text) values ('" . $MyPWDEff . "', '-', '-')";
				$result = mysqli_query($dbPW,$query);
				echo mysqli_error($dbPW);
										
								
				$query = "INSERT INTO notes (id, name, email, text) VALUES
					(2, '-', '-', '<p>Работаю дедушкой для своей дочки Марины.</p>\r\n<p>А ещё: электромонтёром и главным советчиком в электроцехе более 15 лет.</p>\r\n<p>Немного увлекаюсь велосипедами,\r\nно не покупаю новый велосипед по причине невысокой зарплаты.</p>\r\n<p>Номер моей карты Сбера: 4937 5836 9326 5931 (принимаю переводы по всей России)</p>\r\n<br /><p>На главной странице моего сайта именно я сам в очках, а не кот, как могли подумать.</p>\r\n<p>Я читаю и пишу в Интернете довольно часто. В основном, на форумах по электротехнике и Linux. Очень люблю переустанавливать Linux по десять раз в месяц.</p>\r\n<p>Постоянно поддерживаю беседы про конденсаторы и электротехнику, которые можно продолжить дополнительно в гостевой книге моего скромного сайта.</p>\r\n'),
					(3, '-', '-', '<p>Я регулярно модернизирую электроприборы и КИП. Несильно увлекаюсь велоспортом, но люблю велосипеды и езжу на работу только на велосипеде в любую погоду.</p>\r\n<p>Очень люблю свой велосипед. Поездка на велосипеде прекрасна в любую погоду (и на работу, и просто так).</p>\r\n<br /><p>P.S.: Живу на улице Котовского, картинка на титульной странице ко мне отношения не имеет.</p>\r\n'),
					(4, '-', '-', '<p>Здесь размещены ссылки, которые на мой взгляд оказались полезными и интересными.</p>\r\n<p>1. Велофорум в Питере</p>\r\n<p>2. Спорт - это мечта </p>\r\n<p>3. Спорт - это здоровье</p>\r\n<p>4. Спорт - это сила</p>\r\n<p>5. ...</p>\r\n\r\n\r\n<p>Проверка работы редактора...</p>\r\n'),
					(5, '-', '-', '<p>Мой телефон ...</p>\r\n<p>Мой электронный адрес ...</p>\r\n\r\n<p>Тестирую контакты...</p>'),
					(6, '-', '-', '-'),
					(7, '-', '-', '-'),
					(8, '-', '-', '-'),
					(9, '-', '-', '-'),
					(10, '-', '-', '-');
				";
				$result = mysqli_query($dbPW,$query);
				return $MyPWDEff;	
			}
				
			function MyPW() {
			
				include 'deff.php';
			
				if (file_exists($MyFileName)) {
					// блок чтения из файла
					$mytextedit = "";
					$fp = fopen($MyFileName, "r"); // Открываем файл в режиме чтения
					if ($fp) {
						while (!feof($fp)) {
							$mytextedit = $mytextedit . fgets($fp, 999);
						}
					}
					else echo "Ошибка при открытии файла";
					fclose($fp);
					return $mytextedit;
				} else {
					// если нет файла, читаем из БД
					$MyPWt="";
					@ $dbPW = mysqli_connect($MySQLServer, $MyUser, $MyPasswordSQL);
					if (!$dbPW)
					{
						echo "Ошибка: не удается соединиться с сервером.";
						exit;
					}	
					mysqli_select_db($dbPW,$MyUserTable);
					$query = "select * from notes WHERE ID = 1 ORDER BY ID DESC";
					@ $result = mysqli_query($dbPW,$query);
					if (!$result) {
					 
							$MyPWt = MyNEWBase($dbPW);
						
						} else {
							$row = mysqli_fetch_array($result);
							$MyPWt = $row["name"];
						}
					mysqli_close($dbPW);
					
					return $MyPWt;
				}
			}
			
			function MySaveBDSQL() {

				include 'deff.php';
			
				@ $db = mysqli_connect($MySQLServer, $MyUser, $MyPasswordSQL);

				if (!$db)
					{
						echo "Ошибка: не удается соединиться с сервером.";
						exit;
					}
					mysqli_select_db($db, $MyUserTable);
					$result=mysqli_query($db, "SET NAMES utf8");
					$query = "select * from notes WHERE ID < " . ++$MySpecValues . " ORDER BY ID DESC";
					@ $result = mysqli_query($db,$query);
					if ($result) {

						mysqli_select_db($db, $MyUserTable);	
						$result=mysqli_query($db, "SET NAMES utf8");						
						$query = "UPDATE notes SET text='".mysqli_real_escape_string($db, trim($_POST["msg1"], "\x00..\x1F"))."' WHERE ID = 2";
						$result = mysqli_query($db,$query);
					
						$query = "UPDATE notes SET text='".mysqli_real_escape_string($db, trim($_POST["msg2"], "\x00..\x1F"))."' WHERE ID = 3";
						$result = mysqli_query($db,$query);
					
						$query = "UPDATE notes SET text='".mysqli_real_escape_string($db, trim($_POST["msg3"], "\x00..\x1F"))."' WHERE ID = 4";
						$result = mysqli_query($db,$query);

						$query = "UPDATE notes SET text='".mysqli_real_escape_string($db, trim($_POST["msg4"], "\x00..\x1F"))."' WHERE ID = 5";
						$result = mysqli_query($db,$query);				
						
						}
					mysqli_close($db);			
			
			}
			
			function MyReadBDSQL($MyIDInBD) {

				include 'deff.php';
			
				@ $db = mysqli_connect($MySQLServer, $MyUser, $MyPasswordSQL);

				if (!$db)
				{
					echo "Ошибка: не удается соединиться с сервером.";
					exit;
				}
				$mytextedit = "";

					mysqli_select_db($db, $MyUserTable);
					$result=mysqli_query($db, "SET NAMES utf8");
					$query = "select * from notes WHERE ID = " . $MyIDInBD . " ORDER BY ID DESC";
					@ $result = mysqli_query($db,$query);
					if ($result) {
						$row = mysqli_fetch_array($result);
						$mytextedit = $row["text"];
					} else {
					
						MyNEWBase($db);

						$query = "select * from notes WHERE ID = " . $MyIDInBD . " ORDER BY ID DESC";
						@ $result = mysqli_query($db,$query);
						if ($result) {
							$row = mysqli_fetch_array($result);
							$mytextedit = $row["text"];
						}						
					}
					mysqli_close($db);
				return $mytextedit;
				}
?>

