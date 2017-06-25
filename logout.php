<?php
session_start();

if (isset($_SESSION["access"]))
	unset($_SESSION["access"]);

header("Location: index.php");
exit;
?>