<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
	$id = isset($_GET['id']) ? $_GET['id'] : false;
?>

	<!-- view -->

	<!-- css -->
		<!-- DataTables -->
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css"; ?>"/>
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css"; ?>"/>
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/lightbox2/css/lightbox.min.css"; ?>">
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
		        		<div class="btn-group">
		        			<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                    		<i class="fa fa-picture-o"></i>
	                    		<span class="fa fa-caret-down"></span>
	                    	</button>
	              			<ul class="dropdown-menu" role="menu">
	                			<li><a href="javascript:;" id="btn_gantiFoto">Ganti Foto</a></li>
	                			<li class="divider"></li>
	                			<li><a href="javascript:;" id="btn_hapusFoto">Hapus Foto</a></li>
	              			</ul>
		        		</div> 
		        		
		            	<div id="foto">
		            		<a href="javascript:;" data-lightbox="image-1" data-title="My caption"><img class="profile-user-img img-responsive" src="javascript:;" alt="User profile picture"></a>
		            	</div>
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
			            <div class="form-group text-center">
			            	<div class="btn-group">
								<!-- tambah -->
	          					<a href="<?= base_url."index.php?m=barang&p=form&id=$id" ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-edit"></i> Edit Data</a>
	          					<!-- export excel -->
	          					<button type="button" class="btn btn-success btn-sm" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
	          					<!-- export pdf -->
	          					<button type="button" class="btn btn-danger btn-sm" id="exportPdf"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
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

	<!-- modal ganti foto -->
	<div class="modal fade" id="modal_foto">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <!-- button close -->
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
	                <!-- header modal -->
	                <h4 class="modal-title"></h4>
	            </div>
	            <form id="form_foto" role="form" enctype="multipart/form-data">
	            <div class="modal-body">
                    <!-- field jenis -->
                    <div class="form-group">
                        <!-- preview foto -->
	          			<label for="fFoto">Foto</label>
	          			<div class="input-group image-preview">
			                <input type="text" id="fFoto_text" class="form-control image-preview-filename" disabled="disabled">
			                <span class="input-group-btn">
			                    <!-- image-preview-clear button -->
			                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
			                        <span class="glyphicon glyphicon-remove"></span> Hapus
			                    </button>
			                    <!-- image-preview-input -->
			                    <div class="btn btn-danger image-preview-input">
			                        <span class="glyphicon glyphicon-folder-open"></span>
			                        <span class="image-preview-input-title">Pilih Foto</span>
			                        <input type="file" accept="image/png, image/jpeg, image/gif" name="fFoto" id="fFoto" /> <!-- rename it -->
			                    </div>
			                </span>
			            </div>
			            <span class="help-block small"></span>
                    </div>
	            </div>
	            <div class="box-footer">
	                <button class="btn btn-success pull-right" type="submit" id="btn_submit">Ganti</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div>

	<!-- modal export -->
    <?php include_once("pages/modals/modal_export.php"); ?>

	<!-- js -->
    	<!-- DataTables -->
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/lightbox2/js/lightbox.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
		<!-- js modal export -->
        <script type="text/javascript" src="<?= base_url."pages/modals/modal_export.js"; ?>"></script>
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

				// onchange foto
					$(document).on('click', '#close-preview', function(){ 
					    $('.image-preview').popover('hide');
					    // Hover befor close the preview
					    $('.image-preview').hover(
					        function () {
					           $('.image-preview').popover('show');
					        }, 
					         function () {
					           $('.image-preview').popover('hide');
					        }
					    );    
					});
					// Create the close button
				    var closebtn = $('<button/>', {
				        type:"button",
				        text: 'x',
				        id: 'close-preview',
				        style: 'font-size: initial;',
				    });
				    closebtn.attr("class","close pull-right");
				    // Set the popover default content
				    $('.image-preview').popover({
				        trigger:'manual',
				        html:true,
				        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
				        content: "Tidak Ada Foto",
				        placement:'bottom'
				    });
				    // Clear event
				    $('.image-preview-clear').click(function(){
				        $('.image-preview').attr("data-content","").popover('hide');
				        $('.image-preview-filename').val("");
				        $('.image-preview-clear').hide();
				        $('.image-preview-input input:file').val("");
				        $(".image-preview-input-title").text("Pilih Foto"); 
				    }); 
				    // Create the preview image
				    $("#fFoto").change(function (){
				        var img = $('<img/>', {
				            id: 'dynamic',
				            width:250,
				            height:200
				        });      
				        var file = this.files[0];
				        var reader = new FileReader();
				        // Set preview image into the popover data-content
				        reader.onload = function (e) {
				            $(".image-preview-input-title").text("Ganti");
				            $(".image-preview-clear").show();
				            $("#fFoto_text").val(file.name);            
				            img.attr('src', e.target.result);
				            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
				        }        
				        reader.readAsDataURL(file);
				    });
				// ================================================= //

			    // on click btn ganti foto
			    $("#btn_gantiFoto").click(function(){
			    	// swal("Button Ganti Foto Di Click");
			    	$("#modal_foto .modal-title").html("Ganti Foto");
			    	$("#modal_foto").modal();

			    });

			    $("#form_foto").submit(function(e){
			    	e.preventDefault();

			    	var data = getFoto(id);

			    	$.ajax({
			    		url: base_url+"module/barang/action.php",
						type: "post",
						dataType: "json",
						data: data,
						contentType: false,
					    cache: false,
						processData: false,
						success: function(hasil){
							// jika upload gagal
							if(!hasil.statusUpload) swal("Pesan Error", hasil.pesanError, "error");
							else location.reload();
						},
						error: function (jqXHR, textStatus, errorThrown) { // error handling
				            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
				            console.log(jqXHR, textStatus, errorThrown);
				        }
			    	})

			    	return false;
			    });

			});
			
			function getFoto(id){
				var data = new FormData();

				data.append('id', id);
				data.append('foto', $("#fFoto")[0].files[0]);
				data.append('action', "edit_foto");

				return data;
			}

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
							setValue(data);
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
				$("#nama_barang").text(data.nama); // set nama barang
				$("#kd_barang").text(data.kd_barang); // set nama kd barang
				$("#id_barang").text(data.id_barang); // set id barang
				$("#id_warna").text(data.id_warna); // set id warna
				$("#hpp").text(data.hpp); // set hpp
				$("#harga_pasar").text(data.harga_pasar); // set harga pasar 
				$("#market_place").text(data.market_place); // set harga market
				$("#harga_ig").text(data.harga_ig); // set harga harga ig
				$("#ket").text(data.ket); // set keterangan
				// set foto
				$("#foto").children().attr("href", base_url+"assets/gambar/"+data.foto);
				$("#foto").children().attr("data-title", data.nama);
				$("#foto").children().find('img').attr("src", base_url+"assets/gambar/"+data.foto);
			}
		</script>
    <!-- -->