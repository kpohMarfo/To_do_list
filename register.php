<?php
	require_once 'database.php';
	
	$user_err = $pass_err = $pass_conf_err = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password_confirmation = $_POST["password_confirmation"];
		
		if(empty($username)){
			$user_err = "Username is empty";
		} else {
			$sql = "SELECT * FROM users WHERE username=?";
			$prepare = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($prepare, "s", $username);
			mysqli_stmt_execute($prepare);
			mysqli_stmt_store_result($prepare);
            
			if(mysqli_stmt_num_rows($prepare) == 1){
				$user_err = "This username is already taken";
			}
			
			mysqli_stmt_close($prepare);
		}
		
		if(strlen($password) < 5){
			$pass_err = "Your password must be at least 5 characters long";
		}
		
		if($password != $password_confirmation){
			$pass_conf_err = "Password and password confirmation is not match.";
		} 

		if(empty($user_err) && empty($pass_err) && empty($pass_conf_err)){
			$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
			
			$prepare = mysqli_prepare($conn, $sql);
			$hash = password_hash($password, PASSWORD_BCRYPT);
			mysqli_stmt_bind_param($prepare, "ss", $username, $hash);
			
			mysqli_stmt_execute($prepare);

			header("Location: login");
			
			mysqli_stmt_close($prepare);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <link rel="stylesheet" href="css/auth.css">

  <script src="https://kit.fontawesome.com/9338fcac57.js" crossorigin="anonymous"></script>
</head>
<body>

  <nav class="navbar">
    <a href="index.html" class="nav-logo">TODO LIST</a>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="index" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="login" class="nav-link">Login</a>
        </li>
        <li class="nav-item">
            <a href="profile" class="nav-link">About Us</a>
        </li>
    </ul>
    <div class="bars">
        <i class="fa-solid fa-bars"></i>
    </div>
  </nav>
  
  <div class="container">
    <h2>Register</h2>

    <form method="POST" id="register">
      <label for="username">Username </label>
      <input type="text" class="form <?= (!empty($user_err)) ? 'invalid' : "";?>" name="username" placeholder="username" required autofocus>
	  <div class="errmsg"><?= $user_err ?></div>
      
      <label for="password">Password </label>
      <input type="password" class="form <?= (!empty($pass_err)) ? 'invalid' : "";?>" name="password" placeholder="password" required>
	  <div class="errmsg"><?= $pass_err ?></div>
      
      <label for="password_confirmation">Password Confirmation </label>
      <input type="password" class="form <?= (!empty($pass_conf_err_err)) ? 'invalid' : "";?>" name="password_confirmation" placeholder="password confirmation" required>
	  <div class="errmsg"><?= $pass_conf_err ?></div>

      <button type="submit">Register</button>
      <a href="login">Already have an account?</a>
    </form>
  </div>

</body>
</html>