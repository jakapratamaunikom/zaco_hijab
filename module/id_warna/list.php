<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
?>

	<!-- List -->
	<!-- List -->
	
<!-- css -->
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css"; ?>"/>
<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css"; ?>"/>
<!-- Datepicker -->
<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker3.min.css"; ?>"/>
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
                                <button type="button" id="btn_tambahIdWarna" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Tambah
                                </button>
                                <!-- export excel -->
                                <button type="button" class="btn btn-success" id="exportExcel">
                                    <i class="fa fa-file-excel-o"></i> Export Excel
                                </button>
                                <!-- export pdf -->
                                <button type="button" class="btn btn-danger" id="exportPdf">
                                    <i class="fa fa-file-pdf-o"></i> Export Pdf
                                </button>
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

<!-- modal tambah data -->
<div class="modal fade" id="modal_idWarna">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <!-- button close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <!-- header modal -->
                <h4 class="modal-title">Form Id Warna</h4>
            </div>
            <div class="modal-body">
                <form id="form_modal_idWarna" role=form>
                    <!-- field id warna -->
                    <div class="form-group">
                        <label for="fId_warna">Id Warna</label>
                        <input type="text" name="fId_warna" id="fId_warna" class="form-control" placeholder="Masukkan ID Warna">
                    </div>
                    <!-- field nama -->
                    <div class="form-group">
                        <label for="fNama_idWarna">Nama</label>
                        <input type="text" name="fNama_idWarna" id="fNama_idWarna" class="form-control" placeholder="Masukkan Warna">
                    </div>
            </div>
            <div class="box-footer">
                <button id="submit_idWarna" type="submit" class="btn btn-info pull-right">Tambah</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- modal ekspor data -->
<?php include_once("pages/modals/modal_export.php"); ?>

<!-- js -->
<!-- DataTables -->
<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"; ?>"></script>
<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"; ?>"></script>
<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"; ?>"></script>
<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"; ?>"></script>

 <!-- js datepicker -->
<script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
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


        // btn tambah id barang onclick
        $("#btn_tambahIdWarna").click(function(){
            // tampilkan modal
            $("#modal_idWarna").modal('show');
            $('#form_modal_idWarna').trigger('reset'); // bersihkan form
        });

        // submit form modal tambah id barang
        $("#form_modal_idWarna").submit(function(){
            var id_barang = $("#fId_warna").val().trim();
            var nama = $("#fNama_idWarna").val().trim();

            // validasi
            if(id_barang === "" || nama === ""){ // jika salah satu field kosong
                swal("Pesan", "Harap Field Id Warna dan Nama Diisi", "warning");
                return false;
            }
            else{
                // cek panjang karakter id barang
                if(id_barang.length > 3){ // jika melebihi ketentuan
                    swal("Pesan", "Id Warna Maksimal Diisi 3 Karakter", "error");
                    return false;
                }
                else{
                    swal("doing ajax");
                }
            }

            return false;
        });

	});
</script>

<!-- js modal export -->
<script type="text/javascript" src="<?= base_url."pages/modals/modal_export.js"; ?>"></script>
<!-- -->