<?php
	require_once "database.php";
	require_once "functions.php";
	
	session_start();
		
	if(!isset($_SESSION['logged_in'])) {
		header('location: login');
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		add();
	}
	
	$sql = "SELECT tasks.id, task_name FROM tasks INNER JOIN users ON tasks.user_id=users.id WHERE users.username=?";
	$prepare = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($prepare, "s", $_SESSION['username']);
	mysqli_stmt_execute($prepare);
	
	$result = mysqli_stmt_get_result($prepare);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="css/todo.css">

  <script src="https://kit.fontawesome.com/9338fcac57.js" crossorigin="anonymous"></script>
  <title>To Do List</title>
</head>
<body>

  <nav class="navbar">
    <a href="index" class="nav-logo">TODO LIST</a>
    <ol class="nav-menu">

			<li class="nav-item">
				<a href="index" class="nav-link">Home</a>
			</li>
			<li class="nav-item">
				<a href="profile" class="nav-link">About Us</a>
			</li>
			<li class="nav-item">
				<a href="logout" class="nav-link">Logout</a>
			</li>

    </ol>
    <div class="bars">
        <i class="fa-solid fa-bars"></i>
    </div>
  </nav>

  <div class="container">
    <h2>ToDo List App</h2>
    
	<form method="POST">
		<input type="text" name="task" placeholder="Add task...">
		<button type="submit" id="add">Add</button>
	</form>
	
    <ul id="list">
		<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :?>
			<li>
				<input type="checkbox" name="check">
				<p><?= $row["task_name"] ?></p>
				<a class="delete" href="delete?id=<?= $row['id'] ?>">X</a>
			</li>
		<?php endwhile; ?>
	</ul>
	
  </div>    

   <script src="js/todo.js"></script> 
</body>
</html>