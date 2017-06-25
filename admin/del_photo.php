<?php
require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

$id = (int)$_GET["id"];

Database::connect();
$photos = new Dbobject("photos");
$photos->del_item($id);
Database::disconnect();

header("Location: photos.php");
exit;
?>