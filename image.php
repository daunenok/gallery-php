<?php
session_start();
require_once "lib/Database.php";
require_once "lib/Dbobject.php";

Database::connect();
$photos = new Dbobject("photos");
$id = (int)$_GET["id"];
$item = $photos->query_one($id);
$comments = new Dbobject("comments");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = (int)$_POST["photo_id"];
	$name = $_POST["name"];
	$comment = $_POST["comment"];
	$comments->insert(["photo_id", "name", "comment"],
		              [$id, $name, $comment]);
}

$items = $comments->query_many("photo_id", $id);
Database::disconnect();

require_once "header.php"; 
?>

	<div class="login">
		<a href="index.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php 
		if (!isset($_SESSION["access"])) {
		?>
			<a href="login.php">Login</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="register.php">Register</a>
		<?php } elseif ($_SESSION["access"] == 1) { ?>
			<a href="admin/photos.php">Add/Edit Photo</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="logout.php">Logout</a>
		<?php } elseif ($_SESSION["access"] == 2) { ?>
			<a href="admin/index.php">Admin Panel</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="logout.php">Logout</a>
		<?php }?>
	</div>
	<div class="image">
		<figure>
			<img src="uploads/<?=$item['filename']?>">
			<figcaption>
				<?=$item['caption']?>
			</figcaption>
		</figure>
	</div>

	<div class="comments">
		<?php
		foreach ($items as $comm) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<?=$comm['name']?>
				</div>
				<div class="panel-body">
					<?=$comm['comment']?>
				</div>
			</div>
		<?php } ?>
	</div>

	<form class="form-horizontal comment" action="" method="post">
		<input type="hidden" name="photo_id" value="<?=$id?>">
		<div class="form-group">
			<label for="name" class="col-lg-2 control-label">
				Name
			</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="name" name="name">
			</div>
		</div>


		<div class="form-group">
			<label for="comment" class="col-lg-2 control-label">
				Comment
			</label>
			<div class="col-lg-10">
				<textarea class="form-control" rows="6" id="comment" name="comment"></textarea>
			</div>
		</div>


		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
			<button type="submit" class="btn btn-primary">
				Send comment
			</button>
			</div>
		</div>
	</form>	
</div>

</body>
</html>