<?php
session_start();
require_once "lib/Database.php";
require_once "lib/Dbobject.php";
require_once "lib/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST["name"];
	$pass = $_POST["pass"];
	$user = new User($name, $pass);
	$access = $user->login();
	if ($access) {
		$_SESSION["access"] = $access;
		header("Location: index.php");
		exit;
	} else {
		$_SESSION["message"] = "Wrong name/password";
	}
}

require_once "header.php" 
?>

	<div class="jumbotron">
		<?php if (isset($_SESSION["message"])) { ?>
		<div class="alert alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<?php 
  			echo $_SESSION["message"];
  			unset($_SESSION["message"]);
  			?>
		</div>
		<?php } ?>
		<h1>Log In</h1>
	</div>

	<form class="form-horizontal register" action="" method="post">
		<div class="form-group">
			<label for="name" class="col-lg-4 control-label">
				Name
			</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" id="name" name="name">
			</div>
		</div>

		<div class="form-group">
			<label for="pass" class="col-lg-4 control-label">
				Password
			</label>
			<div class="col-lg-8">
				<input type="password" class="form-control" id="pass" name="pass">
			</div>
		</div>

		<div class="form-group">
			<div class="col-lg-8 col-lg-offset-4">
			<button type="submit" class="btn btn-primary">
				Login
			</button>
			</div>
		</div>
	</form>	
</div>

</body>
</html>