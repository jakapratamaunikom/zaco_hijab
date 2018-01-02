<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");

	$notif = isset($_SESSION['notif']) ? $_SESSION['notif'] : false;
	unset($_SESSION['notif']);
?>
<!-- isi konten -->
<section class="content-header">
	<h1>Barang</h1>
	<ol class="breadcrumb">
    	<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
    	<li>Data Master</li>
    	<li><a href="<?= base_url."index.php?m=barang&p=list" ?>"><i class="active"></i>Barang</a></li>
    	<li>Data Barang</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
		<!-- panel box -->
		<div class="box">
			<!-- judul panel box -->
			<div class="box-header">
				<div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <h3 class="box-title">Data Barang</h3>
                    </div>
                </div>
                <!-- panel button -->
                <div class="row" style="padding-top: 25px;">
                	<div class="col-md-12 col-xs-12">
						<div class="btn-group">
							<!-- tambah -->
          					<a href="<?= base_url."index.php?m=barang&p=form" ?>" class="btn btn-default btn-flat" role="button"><i class="fa fa-plus"></i> Tambah</a>
          					<!-- export excel -->
          					<button type="button" class="btn btn-success btn-flat" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
          					<!-- export pdf -->
          					<button type="button" class="btn btn-danger btn-flat" id="exportPdf"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
            			</div>
					</div>	
				</div>
			</div>
			<!-- isi panel -->
			<div class="box-body">
            	<!-- tabel -->
            	<div class="row">
                	<div class="col-md-12 col-xs-12">
                    	<table id="tabel_barang" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                        	<thead>
                            	<tr>
	                                <th style="width: 15px">No</th>
	                                <th>Kode Barang</th>
	                               	<th>Nama Barang</th>
	                                <th>HPP</th>
	                                <th>Harga Pasar</th>
	                                <th>Market Place</th>
	                                <th>Harga IG</th>
	                                <th>Keterangan</th>
	                                <th>Stok</th>
	                                <th>Status</th>
	                                <th>Aksi</th>
                            	</tr>
                        	</thead>
                    	</table>
                	</div>
            	</div>
    		</div>
		</div>
	</div>
</section>

<!-- modal export -->
<?php include_once("app/views/export/formExport.php"); ?>


<!-- js -->
    <!-- js modal export -->
    <script type="text/javascript" src="<?= base_url."app/views/export/js/initExport.js"; ?>"></script>
    <?php 
    	if($notif){
    		?>
    		<script>var notif = "<?php echo $notif; ?>";</script>
    		<?php
    	}
    	else{
    		?>
    		<script>var notif = false;</script>
    		<?php
    	} 
    ?>
    <script type="text/javascript" src="<?= base_url."app/views/barang/js/initList.js"; ?>"></script>
	
<!-- -->