<?php
if (isset($_POST['enter_n'])) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/functions.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/my_logic.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Грейд. Задание 1</title>
</head>
<body>
	<form method="POST" align="center">
		<p>Введите n</p>
		<input type="text" name="n">
		<p>Введите тип добавляемой сущности</p>
		<input type="text" name="type_n">
		<p><input type="submit" value="Сгенерировать" name="enter_n"></p>
	</form>

</body>
</html>