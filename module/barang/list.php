<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
?>

	<!-- List -->

	<!-- css -->
		<!-- DataTables -->
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css"; ?>"/>
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css"; ?>"/>
  		<!-- Datepicker -->
		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker3.min.css"; ?>"/>
	<!-- -->

	<!-- isi konten -->
	<section class="content-header">
  		<h1>Barang</h1>
  		<ol class="breadcrumb">
    		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
    		<li>Data Master</li>
    		<li><a href="<?= base_url."index.php?m=barang&p=list" ?>"><i class="active"></i>Data Barang</a></li>
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
	          					<a href="<?= base_url."index.php?m=barang&p=form" ?>" class="btn btn-default" role="button">Tambah Data</a>
	          					<!-- export excel -->
	          					<button type="button" class="btn btn-success" id="excelBarang"><i class="fa fa-file-excel-o"></i> Export Excel</button>
	          					<!-- export pdf -->
	          					<button type="button" class="btn btn-danger" id="pdfBarang"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
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
		                                <th>Id Barang</th>
		                                <th>Id Warna</th>
		                                <th>Id Warna</th>
		                                <th>HPP</th>
		                                <th>Market Place</th>
		                                <th>Harga IG</th>
		                                <th>Keterangan</th>
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
    <?php include_once("pages/modals/modal_export.php"); ?>
	

	<!-- js -->
    	<!-- DataTables -->
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"; ?>"></script>
		<!-- js datepicker -->
		<script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
		<!-- js list -->
		<script type="text/javascript">
			// setting datatable
			$(document).ready(function(){
				// setting datatable
				$("#tabel_barang").DataTable({
					"language" : {
						"lengthMenu": "Tampilkan _MENU_ data/page",
			            "zeroRecords": "Data Tidak Ada",
			            "info": "Page _PAGE_ dari _PAGES_",
			            "infoEmpty": "Data Kosong",
			            "search": "Pencarian:",
			            "paginate": {
					        "first": "Pertama",
					        "last": "Terakhir",
					        "next": "Selanjutnya",
					        "previous": "Sebelumnya"
					    }
					}
				});
			});
		</script>
		<!-- js modal export -->
        <script type="text/javascript" src="<?= base_url."pages/modals/modal_export.js"; ?>"></script>
    <!-- -->