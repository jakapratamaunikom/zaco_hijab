<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");

	$notif = isset($_SESSION['notif']) ? $_SESSION['notif'] : false;
	unset($_SESSION['notif']);
?>

<section class="content-header">
	<h1>Beranda <small>Dashboard Admin</small></h1>
	<ol class="breadcrumb">
    	<li><a href="#"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
        <li class="active">Beranda</li>
  	</ol>
</section>
<!-- content -->
<section class="content">
	<!-- panel 1 -->
	<div class="row">
		<!-- panel info penjualan -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3 class="info-penjualan"></h3>
					<p class="label-info-penjualan">Total Penjualan Bulan Ini</p>
				</div>
				<div class="icon">
             		<i class="ion ion-bag"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- panel info pembelian -->
		<div class="col-lg-3 col-xs-6">
          	<!-- small box -->
          	<div class="small-box bg-green">
            	<div class="inner">
              		<h3 class="info-pembelian"></h3>
              		<p class="label-info-pembelian">Total Pembelian Bulan Ini</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-stats-bars"></i>
            	</div>
            	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- panel info reject -->
        <div class="col-lg-3 col-xs-6">
          	<!-- small box -->
          	<div class="small-box bg-yellow">
            	<div class="inner">
              		<h3 class="info-reject"></h3>
              		<p class="label-info-reject">Total Reject Bulan Ini</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-stats-bars"></i>
            	</div>
            	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- panel info return -->
        <div class="col-lg-3 col-xs-6">
          	<!-- small box -->
          	<div class="small-box bg-red">
            	<div class="inner">
              		<h3 class="info-return"></h3>
              		<p class="label-info-return">Total Return Bulan Ini</p>
            	</div>
            	<div class="icon">
             	 	<i class="ion ion-stats-bars"></i>
            	</div>
            	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
	</div>
	<!-- panel 2 -->
	<div class="row">
		<!-- panel grafik penjualan dan laba -->
		<div class="col-xs-12 col-md-12">
			<div class="box box-default collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title">Grafik Perbandingan Penjualan dan Laba</h3>
					<div class="box-tools pull-right">
                		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              		</div>
				</div>
				<!-- grafik -->
				<div class="box-body">
              		The body of the box
            	</div>
			</div>
		</div>
	</div>
	<!-- panel 3 -->
	<div class="row">
		<!-- panel grafik pengeluaran -->
		<div class="col-xs-12 col-md-12">
			<div class="box box-default collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title">Grafik Pengeluaran Tahun Ini</h3>
					<div class="box-tools pull-right">
                		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              		</div>
				</div>
				<!-- grafik -->
				<div class="box-body">
              		The body of the box
            	</div>
			</div>
		</div>
	</div>
</section>