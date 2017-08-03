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
    <div class="modal fade" id="modal_exportBarang">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- button close -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <!-- header modal -->
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="form_modal_exportBarang" role=form>
                        <!-- field jenis -->
                        <div class="form-group">
                            <label for="fmJenis">Jenis</label>
                            <select id="fmJenis" class="form-control">
                            	<option value="">-- Pilih Jenis --</option>
                            	<option value="harian">Harian</option>
                            	<option value="bulanan">Bulanan</option>
                            </select>
                        </div>
                       <!-- tanggal -->
                        <div class="form-group">
                            <label for="fmTgl">Tanggal</label>
                            <input type="text" name="fmTgl" id="fmTgl" class="form-control datepicker">
                        </div>
                        <!-- bulan - tahun -->
                        <div class="form-group">
                            <label for="fmBln">Bulan</label>
                            <input type="text" name="fmBln" id="fmBln" class="form-control datepicker">
                        </div>
                </div>
                <div class="box-footer">
                    <button class="btn pull-right" type="submit" id="btn_export_submit">Export</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
	

	<!-- js -->
    	<!-- DataTables -->
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"; ?>"></script>
		<!-- js datepicker -->
		<script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
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

				// setting datepicker fmTgl
				$("#fmTgl").datepicker({
					autoclose: true,
			        format: "dd-mm-yyyy",
			        todayHighlight: true,
			        orientation: "bottom auto",
			        todayBtn: true,
			        todayHighlight: true,
				});

				// setting datepicker fmBln
				$("#fmBln").datepicker({
					autoclose: true,
			        format: "MM yyyy",
			  		minViewMode: 1,
			        orientation: "bottom auto",
				});

				// btn excelBarang onclick
				$("#excelBarang").click(function(){
					set_allBtn_disable(); // disable semua btn modal
					$('#form_modal_exportBarang').trigger('reset'); // reset form modal
					// tampilkan modal
					$("#btn_export_submit").addClass("btn-success");
					$("#btn_export_submit").removeClass("btn-danger");
					$("#modal_exportBarang .modal-title").html("Export Excel"); // setting header
					$("#modal_exportBarang").modal();
				});

				// btn pdfBarang onclick
				$("#pdfBarang").click(function(){
					set_allBtn_disable(); // disable semua btn modal
					$('#form_modal_exportBarang').trigger('reset'); // reset form modal
					// tampilkan modal
					$("#btn_export_submit").addClass("btn-danger");
					$("#btn_export_submit").removeClass("btn-success");
					$("#modal_exportBarang .modal-title").html("Export Pdf"); // setting header
					$("#modal_exportBarang").modal();
				});

				// pilihan jenis export
				$("#fmJenis").change(function(){
					var value = this.value;
					if(value === ""){ // jika tidak dipilih 
						$('#form_modal_exportBarang').trigger('reset'); // reset form modal
						// semua field disable
						set_allBtn_disable();
					}
					else if(value === "harian"){ // jika harian
						set_allF_clear(); // bersihkan form
						// field bulan disable
						$("#fmBln").prop("disabled", true);
						// field tgl aktif
						$("#fmTgl").prop("disabled", false);
					}
					else if(value === "bulanan"){ // jika bulanan
						set_allF_clear(); // bersihkan form
						// field tgl disable
						$("#fmTgl").prop("disabled", true);
						// field bln aktif
						$("#fmBln").prop("disabled", false);
					}
				});

				// submit form modal export
				$("#form_modal_exportBarang").submit(function(){
					var jenis = $("#fmJenis").val().trim();
					// validasi
					if(jenis === ""){ // jika tidak dipilih
						swal("Pesan", "Jenis Pilihan Export Data Belum Dipilih", "warning");
						return false;
					}
					else if(jenis === "harian"){ 
						if($("#fmTgl").val().trim() === ""){ //jika tgl kosong
							swal("Pesan", "Tanggal Belum Diisi", "warning");
							return false;
						}
						else{ // lakukan ajax
							swal("doing ajax");
						}
					}
					else if(jenis === "bulanan"){
						if($("#fmBln").val().trim() === ""){ // jika bln kosong
							swal("Pesan", "Bulan Belum Diisi", "warning");
							return false;
						}
						else{ // lakukan ajax
							swal("doing ajax");
						}
					}

					return false;
				});

				// fungsi untuk setting disable btn
				function set_allBtn_disable(){
					$("#fmTgl").prop("disabled", true);
					$("#fmBln").prop("disabled", true);
				}

				// fungsi untuk bersihkan field
				function set_allF_clear(){
					$("#fmTgl").val("");
					$("#fmBln").val("");
				}

				// fungsi get report sesuai tgl/bln yg dipilih dgn ajax
				function getReport(){

				}
			});
		</script>
    <!-- -->