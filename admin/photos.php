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
	$caption = $_POST["caption"];
	$dir = "../uploads/";
	$filename = basename($_FILES["filename"]["name"]);
	$file = $dir . $filename;
	move_uploaded_file($_FILES["filename"]["tmp_name"], $file);
	$arr1 = ["filename", "caption"];
	$arr2 = [$filename, $caption];
	$photos->insert($arr1, $arr2);
}

$items = $photos->find_all();
Database::disconnect();

require_once "header.php"; 
?>

		<h2>Photos</h2>
	</div>
	<table class="table table-striped table-hover ">
		<thead>
			<tr>
				<th>ID</th>
				<th>Filename</th>
				<th>Caption</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form action="" method="post" enctype="multipart/form-data">
				<td></td>
				<td>
					<input type="file" name="filename">
				</td>
				<td>
					<input type="text" name="caption">
				</td>
				<td>
					<button type="submit" class="btn btn-warning">
						add photo
					</button>
				</td>
				</form>
			</tr>
			<?php
			foreach ($items as $item) { ?>
				<tr>
					<td><?=$item["id"]?></td>
					<td><?=$item["filename"]?></td>
					<td><?=$item["caption"]?></td>
					<td>
						<a href="edit_photo.php?id=<?=$item["id"]?>" class="btn btn-primary">
							edit caption
						</a>
						<a href="del_photo.php?id=<?=$item["id"]?>" class="btn btn-danger">
							delete
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

</body>
</html>