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
$items = $comments->find_all();
Database::disconnect();

require_once "header.php"; 
?>

		<h2>Comments</h2>
	</div>
	<table class="table table-striped table-hover comm">
		<thead>
			<tr>
				<th>ID</th>
				<th>Photo_ID</th>
				<th>Name</th>
				<th>Comment</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($items as $item) { ?>
				<tr>
					<td><?=$item["id"]?></td>
					<td><?=$item["photo_id"]?></td>
					<td><?=$item["name"]?></td>
					<td><?=$item["comment"]?></td>
					<td>
						<a href="edit_comment.php?id=<?=$item["id"]?>" class="btn btn-primary">
							edit comment
						</a>
						<a href="del_comment.php?id=<?=$item["id"]?>" class="btn btn-danger">
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