<?php
	require_once 'database.php';
	
	function add() {
		global $conn;
		$task = $_POST['task'];
		$username = $_SESSION['username'];
			
		$sql = "INSERT INTO tasks (task_name, user_id) VALUES(?, (SELECT id FROM users WHERE username=?))";
		$prepare = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($prepare, "ss", $task, $username);
		mysqli_stmt_execute($prepare);
		
		header('Location: todo');
	}