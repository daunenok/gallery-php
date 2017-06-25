<?php
session_start();
if (!isset($_SESSION["access"]) || $_SESSION["access"] != 2) {
	header("Location: ../index.php");
	exit;
}
 
require_once "../lib/Database.php";
require_once "../lib/Dbobject.php";

Database::connect();
$comments = new Dbobject("comments");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$val = $_POST["comment"];
	$id = (int)$_POST["id"];
	$comments->update($id, "comment", $val);
	Database::disconnect();
	header("Location: comments.php");
	exit;
} else {
	$id = (int)$_GET["id"];
	$item = $comments->query_one($id);
	Database::disconnect();
}

require_once "header.php"; 
?>

		<h2>Comments</h2>
	</div>
	<form class="form-horizontal edit" action="" method="post">
		<input type="hidden" name="id" value="<?=$id?>">
		<div class="form-group">
			<label for="comment" class="col-lg-2 control-label">
				Comment
			</label>
			<div class="col-lg-10">
				<textarea class="form-control" rows="6" id="comment" name="comment"><?=$item["comment"]?></textarea>
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