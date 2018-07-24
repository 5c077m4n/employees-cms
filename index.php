<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<?php
			require_once('./model/db/sql_connection.class.php');
			require_once('./model/employees.class.php');
			$employee_table = new Employees();
		?>
		<link rel="stylesheet" type="text/css" href="./view/style/style.css">
		<title>Employee Database</title>
	</head>
	<body>
		<form action="./index.php" method="POST">
			<input type="number" placeholder="The employee's ID:" name="id" />
			<input type="text" placeholder="The employee's name:" name="name" />
			<input type="date" placeholder="His/her starting date:" name="startDate" />
			<br /><br />
			<button type="submit" name="formFunc" value="get">Get Employee</button>
			<button type="submit" name="formFunc" value="add">Add New Employee</button>
			<button type="submit" name="formFunc" value="update">Update Employee</button>
			<button type="submit" name="formFunc" value="delete">Delete Employee</button>
			<button type="submit" name="formFunc" value="getAll">Get All Employees</button>
			<button type="submit" name="formFunc" value="clear">Clear Form</button>
		</form>
		<hr />
		<?php require('./view/results.php'); ?>
	</body>
</html>
