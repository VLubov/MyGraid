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
		<p>id задачи</p>
		<input type="text" name="task_id">
		<input type="submit" value="Отправить" name="enter">
	</form>
</body>
</html>
