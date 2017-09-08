<?php
	Define("BASE_PATH", true);
	date_default_timezone_set('Asia/Jakarta');

	// include semua fungsi
	include_once("app/function/helper.php");
	include_once("app/function/koneksi.php");

	// start session
	session_start();

	// inisialisasi parameter get
	// $m => get data menu/view
	// $p => get data page yang ada di dalam views

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
		<?php include_once("app/views/template/css.php") ?>

	</head>
	<body class="hold-transition skin-red sidebar-mini">

		<div class="wrapper">
			<!-- Header -->
			<?php include_once("app/views/template/header.php") ?>

			<!-- Sidebar -->
			<?php include_once("app/views/template/sidebar.php") ?>

			<!-- Content -->
			<?php include_once("app/views/template/content.php") ?>

			<!-- Footer -->
			<?php include_once("app/views/template/footer.php") ?>

			<!-- Control Sidebar -->
			<?php include_once("app/views/template/control_sidebar.php") ?>

		</div>
		<!-- ./wrapper -->
		
		<!-- JavaScript -->
		<?php include_once("app/views/template/javascript.php") ?>
	</body>
</html>