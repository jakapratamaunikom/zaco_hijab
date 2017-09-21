<?php
	include_once("app/function/helper.php");
	include_once("app/function/koneksi.php");
	session_start();
	var_dump($_SESSION);
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
		<!-- CSS -->
		<?php include_once("app/views/template/css.php") ?>
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
		  	<div class="login-logo">
		    	<a href="<?= base_url; ?>"><b>Zaco</b>Hijab</a>
		  	</div>
		  	<!-- /.login-logo -->
		  	<div class="login-box-body">
			  	<p class="login-box-msg">Silahkan Login untuk Masuk ke Sistem</p>
			    <!-- form -->
			    <form id="form_login" role="form">
			      	<div class="form-group has-feedback">
			        	<input type="text" class="form-control" placeholder="Masukkan Username" id="username" name="username">
			        	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			      	</div>
			      	<div class="form-group has-feedback">
			       	 	<input type="password" class="form-control" placeholder="Masukkan Password" id="password" name="password">
			        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			      	</div>
			      	<hr>
			      	<div class="row">
			        	<!-- /.col -->
			        	<div class="col-xs-offset-8 col-xs-4">
			          		<button id="btn_login" value="login" type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
			        	</div>
			        	<!-- /.col -->
			      	</div>
			    </form>
			    <a href="#">Lupa Password?</a>
			</div>
		  	<!-- /.login-box-body -->
		</div>
		<!-- JavaScript -->
		<?php include_once("app/views/template/javascript.php") ?>
		<!-- js custom -->
		<script type="text/javascript">
            var base_url = "<?php print base_url; ?>";
        </script>
        <script type="text/javascript">
        	$(document).ready(function(){
        		$("#form_login").submit(function(e){
        			e.preventDefault();
					login();

					return false;
        		});
        	});

        	function login(){
        		$.ajax({
        			url: base_url+"app/controllers/Login.php",
        			type: "post",
        			dataType: "json",
        			data:{
        				"username": $("#username").val().trim(),
        				"password": $("#password").val().trim(),
        				"action": $("#btn_login").val().trim(),
        			},
        			success: function(hasil){
        				console.log(hasil);
        			},
        			error: function (jqXHR, textStatus, errorThrown) { // error handling
			            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
			            console.log(jqXHR, textStatus, errorThrown);
			        }
        		})
        	}
        </script>
	</body>
</html>
