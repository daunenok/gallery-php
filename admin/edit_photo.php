<?php
session_start();
if (!isset($_SESSION["access"])) {
	header("Location: ../index.php");
	exit;
}

require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

Database::connect();
$photos = new Dbobject("photos");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$val = $_POST["caption"];
	$id = (int)$_POST["id"];
	$photos->update($id, "caption", $val);
	Database::disconnect();
	header("Location: photos.php");
	exit;
} else {
	$id = (int)$_GET["id"];
	$item = $photos->query_one($id);
	Database::disconnect();
}

require_once "header.php"; 
?>

		<h2>Photos</h2>
	</div>
	<form class="form-horizontal edit" action="" method="post">
		<input type="hidden" name="id" value="<?=$id?>">
		<div class="form-group">
			<label for="caption" class="col-lg-2 control-label">
				Caption
			</label>
			<div class="col-lg-10">
				<textarea class="form-control" rows="6" id="caption" name="caption"><?=$item["caption"]?></textarea>
			</div>
		</div>


		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
			<button type="submit" class="btn btn-primary">
				Save
			</button>
			</div>
		</div>
	</form>
</div>

</body>
</html>