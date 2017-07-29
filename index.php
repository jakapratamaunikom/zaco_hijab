<?php
	Define("BASE_PATH", true);
	date_default_timezone_set('Asia/Jakarta');

	include_once("function/helper.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		
		<title>Sistem Informasi Zaco Hijab</title>
		<!-- jQuery -->
		<script src="<?= base_url."assets/plugins/jQuery/jquery-2.2.3.min.js"; ?>"></script>
		<!-- CSS -->
		<?php include_once("pages/css.php") ?>

	</head>
	<body class="hold-transition skin-blue sidebar-mini">

		<div class="wrapper">
			<!-- Header -->
			<?php include_once("pages/header.php") ?>

			<!-- Sidebar -->
			<?php include_once("pages/sidebar.php") ?>

			<!-- Content -->
			<?php include_once("pages/content.php") ?>

			<!-- Footer -->
			<?php include_once("pages/footer.php") ?>

			<!-- Control Sidebar -->
			<?php include_once("pages/control_sidebar.php") ?>

		</div>
		<!-- ./wrapper -->

		<!-- JavaScript -->
		<?php include_once("pages/javascript.php") ?>
	</body>
</html>