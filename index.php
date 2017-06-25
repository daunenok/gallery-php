<?php 
session_start();
require_once "lib/Database.php";
require_once "lib/Dbobject.php";
require_once "lib/Pagination.php";
Database::connect();

$pag = new Pagination();

if (isset($_GET["page"]))
	$pag->current = (int)$_GET["page"];
else
	$pag->current = 1;
$items = $pag->get_photos();

Database::disconnect();
require_once "header.php";
?>

	<div class="login">
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
	<div class="jumbotron">
		<h1>PHOTO GALLERY</h1>
	</div>
	<div class="gallery">
		<?php
			foreach ($items as $item) { ?>
				<figure>
				<a href="image.php?id=<?=$item['id']?>">
					<img src="uploads/<?=$item['filename']?>">
				</a>
				<figcaption>
					<?=$item["caption"]?>
				</figcaption>
				</figure>
			<?php } ?>
	</div>
	<ul class="pagination pagination-lg">
		<?php
		if ($pag->has_prev_page()) {
			echo '<li><a href="index.php?page=';
			echo $pag->prev_page();
			echo '">&laquo;</a></li>';
		} else {
			echo '<li class="disabled"><a href="">&laquo;</a></li>';
		}
		for ($i = 1; $i <= $pag->pages; $i++) {
			echo "<li";
			if ($i == $pag->current) echo " class='active'";
			echo"><a href='index.php?page=" . $i. "'>";
			echo $i;
			echo "</a></li>";  
		}
		if ($pag->has_next_page()) {
			echo '<li><a href="index.php?page=';
			echo $pag->next_page();
			echo '">&raquo;</a></li>';
		} else {
			echo '<li class="disabled"><a href="">&raquo;</a></li>';
		} 
		?>
	</ul>
</div>

</body>
</html>