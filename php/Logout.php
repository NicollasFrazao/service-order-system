<?php
	session_start();
	
	unset($_SESSION['OS']);
	
	if(!isset($_SESSION['OS']))
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
?>