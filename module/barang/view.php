<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
?>

	<!-- view -->

	<!-- css -->
		<!-- DataTables -->
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css"; ?>"/>
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css"; ?>"/>
	<!-- -->

	<!-- isi konten -->
	<section class="content-header">
  		<h1>Barang</h1>
  		<ol class="breadcrumb">
    		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
    		<li>Data Master</li>
    		<li><a href="<?= base_url."index.php?m=barang&p=list" ?>">Barang</li>
    		<li><i class="active"></i>View Data Barang</a></li>
  		</ol>
	</section>

	<!-- isi -->
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<!-- foto barang -->
		        <div class="box">
		        	<div class="box-body box-profile">
		            	<img class="profile-user-img img-responsive" src="<?= base_url."assets/dist/img/user2-160x160.jpg"; ?>" alt="User profile picture">
		            	<h3 class="profile-username text-center">Nama Barang</h3>
						<p class="text-muted text-center">Kode Barang</p>
						<ul class="list-group list-group-unbordered">
		                	<li class="list-group-item">
		                  		<b>Warna</b> <a class="pull-right">1,322</a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>HPP</b> <a class="pull-right">543</a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Harga Pasar</b> <a class="pull-right">13,287</a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Market Place</b> <a class="pull-right">13,287</a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Harga IG</b> <a class="pull-right">13,287</a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Keterangans</b> <a class="pull-right">13,287</a>
		                	</li>
		              	</ul>
		              	<div class="btn-group">
								<!-- tambah -->
	          					<button type="button" class="btn btn-default">Edit</button>
	          					<!-- export excel -->
	          					<button type="button" class="btn btn-default">Export Excel</button>
	          					<!-- export pdf -->
	          					<button type="button" class="btn btn-default">Export Pdf</button>
	            		</div>
		            </div>
		        </div>
		    </div>
            
            <div class="col-md-9">
            	<div class="box ">
	            	<!-- tabel -->
	            	<div class="box-body">
		            	<div class="row">
		                	<div class="col-md-12 col-xs-12">
		                    	<table id="tabel_stok" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
		                        	<thead>
		                            	<tr>
			                                <th style="width: 15px">No</th>
			                                <th>Kode Barang</th>
			                                <th>Tanggal</th>
			                                <th>Stok Awal</th>
			                                <th>Barang Masuk</th>
			                                <th>Barang Keluar</th>
			                                <th>Stok Akhir</th>
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
				$("#tabel_stok").DataTable({
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