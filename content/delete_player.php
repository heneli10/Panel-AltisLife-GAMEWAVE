<?php
if(!Auth::isLogged() && !Auth::isAdmin()){
	header('Location:'.WEBROOT);
}
if(isset($_GET['j'])) {
	$j = $_GET['j'];
	$DB->exec("DELETE FROM players WHERE playerid='$j'");
	header('Location:'.WEBROOT.'success');
}
?>