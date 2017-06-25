<?php 
session_start();
if (!isset($_SESSION["access"]) || $_SESSION["access"] != 2) {
	header("Location: ../index.php");
	exit;
}

require_once "header.php" 
?>

		<h2><a href="users.php">Users</a></h2>
		<h2><a href="photos.php">Photos</a></h2>
		<h2><a href="comments.php">Comments</a></h2>
	</div>
</div>

</body>
</html>