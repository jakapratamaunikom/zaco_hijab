<?php
	Define("BASE_PATH", true);
	date_default_timezone_set('Asia/Jakarta');

	// include semua fungsi
	include_once("function/helper.php");
	include_once("function/koneksi.php");

	// start session
	session_start();

	// inisialisasi parameter get
	// $m => get data module
	// $p => get data page yang ada di dalam module

	$m = isset($_GET['m']) ? $_GET['m'] : false; // untuk get menu
	$p = isset($_GET['p']) ? $_GET['p'] : false; // untuk get page
		

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
		<?php include_once("pages/template/css.php") ?>

	</head>
	<body class="hold-transition skin-red sidebar-mini">

		<div class="wrapper">
			<!-- Header -->
			<?php include_once("pages/template/header.php") ?>

			<!-- Sidebar -->
			<?php include_once("pages/template/sidebar.php") ?>

			<!-- Content -->
			<?php include_once("pages/template/content.php") ?>

			<!-- Footer -->
			<?php include_once("pages/template/footer.php") ?>

			<!-- Control Sidebar -->
			<?php include_once("pages/template/control_sidebar.php") ?>

		</div>
		<!-- ./wrapper -->
		
		<!-- JavaScript -->
		<?php include_once("pages/template/javascript.php") ?>
	</body>
</html>