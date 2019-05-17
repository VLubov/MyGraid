<?php
isset($_POST['enter']) ? require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/my_logic.php') : '';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Грейд. Задание 2.</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<form method="POST" class="center">
		<p>Введите данные в формате Сущность | ID сущности | Значение которое вы хотите присвоить</p>
		<p>Тип сущности </p>
		<input type="text" name="type_es">
		<p>Введите id сущности</p>
		<input type="text" name="id">
		<p>Значение поля</p>
		<input type="text" name="value_text">
		<input type="submit" value="Отправить" name="enter">
	</form>
</body>
</html>
