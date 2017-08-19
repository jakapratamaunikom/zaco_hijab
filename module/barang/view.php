<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
	$id = isset($_GET['id']) ? $_GET['id'] : false;
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
    		<li><a href="<?= base_url."index.php?m=barang&p=list" ?>"><i class="active"></i>Barang</a></li>
    		<li id="viewBarang"></li>
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
		            	<!-- <img class="profile-user-img img-responsive" src="<?= base_url."assets/gambar/18359298_1286972521423837_7582557687995918717_o.jpg"; ?>" alt="User profile picture"> -->
		            	<h3 class="profile-username text-center" id="nama_barang"></h3>
						<p class="text-muted text-center" id="kd_barang"></p>
						<ul class="list-group list-group-unbordered">
		                	<li class="list-group-item id-barang">
		                  		<b>Id Barang</b> <a class="pull-right" id="id_barang"></a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Id Warna</b> <a class="pull-right" id="id_warna"></a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>HPP</b> <a class="pull-right" id="hpp"></a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Harga Pasar</b> <a class="pull-right" id="harga_pasar"></a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Market Place</b> <a class="pull-right" id="market_place"></a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Harga IG</b> <a class="pull-right" id="harga_ig"></a>
		                	</li>
		                	<li class="list-group-item">
		                  		<b>Keterangan</b> <p class="text-muted" id="ket"></p>
		                	</li>
		              	</ul>
		              	<!-- <strong>Keterangan</strong>
		          		<p class="text-muted" id="ket"></p> -->
		          		<!-- <hr> -->
			            <div class="form-group text-center">
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
			                                <th>Tanggal</th>
			                                <th>Stok Awal</th>
			                                <th>Barang Masuk</th>
			                                <th>Barang Keluar</th>
			                                <th>Stok Akhir</th>
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
            var base_url = "<?php print base_url; ?>";
            var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;
            // var id = "";
        </script>
        <?php
        	if(!$id){
				?>
				<script type="text/javascript">document.location=base_url+"index.php?m=barang&p=list";</script>
				<?php
			}
        ?>
		<script type="text/javascript">
			$(document).ready(function(){
				if(!jQuery.isEmptyObject(urlParams.id)){ // jika ada parameter get
					var id = urlParams.id;
					getView(id);
				}
				// else document.location=base_url+"index.php?m=barang&p=list";

				//setting datatable
				var tabel_stok = $("#tabel_stok").DataTable({
					"language" : {
			            "lengthMenu": "Tampilkan _MENU_ data/page",
			            "zeroRecords": "Data Tidak Ada",
			            "info": "Menampilkan _START_ s.d _END_ dari _TOTAL_ data",
			            "infoEmpty": "Menampilkan 0 s.d 0 dari 0 data",
			            "search": "Pencarian:",
			            "loadingRecords": "Loading...",
			            "processing": "Processing...",
			            "paginate": {
			                "first": "Pertama",
			                "last": "Terakhir",
			                "next": "Selanjutnya",
			                "previous": "Sebelumnya"
			            }
			        },
			        "lengthMenu": [ 25, 50, 75, 100 ],
			        "pageLength": 25,
			        order: [],
			        processing: true,
			        serverSide: true,
			        ajax: {
			            url: base_url+"module/barang/action.php",
			            type: 'POST',
			            data: {
			            	"id" : urlParams.id,
			                "action" : "listStok",
			            }
			        },
			        "columnDefs": [
			            {
			                "targets":[0], // disable order di kolom 1 dan 3
			                "orderable":false,
			            }
			        ],
			    });

			});

			function getView(id){
				$.ajax({
					url: base_url+"module/barang/action.php",
					type: "post",
					dataType: "json",
					data: {
						"id" : id,
						"action" : "getView",
					},
					success: function(data){
						if(!data) document.location=base_url+"index.php?m=barang&p=list";
						else{
							$("#nama_barang").text(data.nama); // set nama barang
							$("#kd_barang").text(data.kd_barang); // set nama kd barang
							$("#id_barang").text(data.id_barang); // set id barang
							$("#id_warna").text(data.id_warna); // set id warna
							$("#hpp").text(data.hpp); // set hpp
							$("#harga_pasar").text(data.harga_pasar); // set 
							$("#market_place").text(data.market_place);
							$("#harga_ig").text(data.harga_ig);
							$("#ket").text(data.ket);
						}
						console.log(data);	
					},
					error: function (jqXHR, textStatus, errorThrown) { // error handling
			            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
			            console.log(jqXHR, textStatus, errorThrown);
			        }

				})
			}

			function setValue(data){

			}
		</script>
    <!-- -->