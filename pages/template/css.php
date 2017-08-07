	<!-- CSS -->

		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?= base_url."assets/bootstrap/css/bootstrap.min.css"; ?>">
		<!-- font awesome -->
		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css"; ?>">
		<!-- Ionicons -->
		<link rel="stylesheet" href="<?= base_url."assets/plugins/ionicons-2.0.1/css/ionicons.min.css"; ?>">
		<!-- Select2 -->
  		<link rel="stylesheet" href="<?= base_url."assets/plugins/select2/select2.min.css"; ?>">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?= base_url."assets/dist/css/AdminLTE.min.css"; ?>">
		<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?= base_url."assets/dist/css/skins/_all-skins.min.css"; ?>">

		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/sweet-alert/sweet-alert.min.css"; ?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/alertifyjs/css/alertify.min.css"; ?>"/>
		
		<style type="text/css">
			legend{
				font-size: 15px;
			}
			/*.rp{
				background-color: #dd4b39;
				border-color: #d73925;
			}*/
			.loadingPage{
				display: none;
				position: fixed;
				z-index: 1000;
				top: 0;
				left: 0;
				height: 100%;
				width: 100%;
				background: rgba( 255, 255, 255, .8 ) 
                			url('pages/template/loading2.gif') 
                			50% 50% 
                			no-repeat;
			}
			body.loading_gif {
    			overflow: hidden;   
			}
			body.loading_gif .loadingPage{
				display: block;
			}
		</style>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	<!-- end CSS -->