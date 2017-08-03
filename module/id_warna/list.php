<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
?>

	<!-- List -->
	<!-- List -->
	
<!-- css -->
<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css"; ?>"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css"; ?>"/>
<!-- -->

<!-- header dan breadcrumb -->
<section class="content-header">
	<h1>Id Warna</h1>
	<ol class="breadcrumb">
    	<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
    	<li>Data Master</li>
    	<li class="active"><a href="<?= base_url."index.php?m=id_warna&p=list"; ?>">Id Warna</a></li>
    	<li>Data Id Warna</li>
	</ol>
</section>

<!-- isi konten -->
<section class="content">
    <div class="row">
    	<div class="col-xs-12">
    		<!-- panel box -->
    		<div class="box">
    			<!-- judul panel box -->
    			<div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <h3 class="box-title">Data Id Warna</h3>
                        </div>
                    </div>
                    <!-- panel button -->
                    <div class="row" style="padding-top: 25px;">
                        <div class="col-md-12 col-xs-12">
                            <div class="btn-group">
                                <!-- tambah -->
                                <button type="button" class="btn btn-default">Tambah</button>
                                <!-- export excel -->
                                <button type="button" class="btn btn-default">Export Excel</button>
                                <!-- export pdf -->
                                <button type="button" class="btn btn-default">Export Pdf</button>
                            </div>
                        </div>
                    </div>
    			</div>
    			<!-- isi panel box -->
    			<div class="box-body">
                    <!-- tabel -->
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <table id="tabel_id_warna" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 15px">No</th>
                                        <th>Id Warna</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>
</section>

<!-- js -->
<!-- DataTables -->
<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"; ?>"></script>
<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"; ?>"></script>
<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"; ?>"></script>
<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"; ?>"></script>
<script type="text/javascript">
	//setting datatable
	$(function(){
		$("#tabel_id_warna").DataTable({
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
<!-- -->