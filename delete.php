<?php

require_once 'database.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
if(mysqli_affected_rows($conn) > 0){
	header("location: todo");
}