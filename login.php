<?php
	include_once("app/function/helper.php");
	include_once("app/function/koneksi.php");
	session_start();
	
	$sess_login = isset($_SESSION['sess_login']) ? $_SESSION['sess_login'] : false;
	// $sess_username = isset($_SESSION['sess_username']) ? $_SESSION['sess_username'] : false;
	// $sess_nama = isset($_SESSION['sess_nama']) ? $_SESSION['sess_nama'] : false;
	// $sess_email = isset($_SESSION['sess_email']) ? $_SESSION['sess_email'] : false;
	// $sess_foto = isset($_SESSION['sess_foto']) ? $_SESSION['sess_foto'] : false;
	// $sess_level = isset($_SESSION['sess_level']) ? $_SESSION['sess_level'] : false;
	// $sess_akses = isset($_SESSION['sess_akses']) ? $_SESSION['sess_akses'] : false;
	// $sess_lockscreen = isset($_SESSION['sess_lockscreen']) ? $_SESSION['sess_lockscreen'] : false;

	if($sess_login){
		header("Location: ".base_url);
		die();
	}

?>

<!DOCTYPE html>
<html>
	<head>
	  	<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  	<title>Login | Sistem Informasi Zaco Hijab</title>
	  	<!-- Tell the browser to be responsive to screen width -->
	  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	 	<!-- jQuery -->
		<script src="<?= base_url."assets/plugins/jQuery/jquery-2.2.3.min.js"; ?>"></script>
		<script type="text/javascript">
            var base_url = "<?php print base_url; ?>";
        </script>
		<!-- CSS -->
		<?php include_once("app/views/template/css/autoload_css.php") ?>
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
		  	<div class="login-logo">
		    	<a href="<?= base_url; ?>"><b>Zaco</b>Hijab</a>
		  	</div>
		  	<!-- /.login-logo -->
		  	<?php include_once("app/views/login/form_login.php"); ?>
		  	<!-- /.login-box-body -->
		</div>
		<!-- JavaScript -->
		<?php include_once("app/views/template/js/autoload_js.php") ?>
		<!-- js custom -->
        <script type="text/javascript" src="<?= base_url."app/views/login/js/initLogin.js"; ?>"></script>
	</body>
</html>
