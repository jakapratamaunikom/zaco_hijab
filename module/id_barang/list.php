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

    <!-- header dan breadcrumb -->
    <section class="content-header">
        <h1>Id Barang</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
            <li>Data Master</li>
            <li class="active"><a href="<?= base_url."index.php?m=id_barang&p=list"; ?>">Id Barang</a></li>
            <li>Data Id Barang</li>
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
                                <h3 class="box-title">Data Id Barang</h3>
                            </div>
                        </div>
                        <!-- panel button -->
                        <div class="row" style="padding-top: 25px;">
                            <div class="col-md-12 col-xs-12">
                                <div class="btn-group">
                                    <!-- tambah -->
                                    <button type="button" id="btn_tambahIdBarang" class="btn btn-default"><i class="fa fa-plus"></i> Tambah</button>
                                    <!-- export excel -->
                                    <button type="button" class="btn btn-success" id="excelBarang"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                                    <!-- export pdf -->
                                    <button type="button" class="btn btn-danger" id="pdfBarang"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- isi panel box -->
                    <div class="box-body">
                        <!-- tabel -->
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <table id="tabel_id_barang" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 15px">No</th>
                                            <th>Id Barang</th>
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
    <div class="modal fade" id="modal_idBarang">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- button close -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <!-- header modal -->
                    <h4 class="modal-title">Form Id Barang</h4>
                </div>
                <div class="modal-body">
                    <form id="form_modal_idBarang" role=form>
                        <!-- field id barang -->
                        <div class="form-group">
                            <label for="fId_barang">Id Barang</label>
                            <input type="text" name="fId_barang" id="fId_barang" class="form-control" placeholder="Masukkan ID Barang">
                        </div>
                        <!-- field nama -->
                        <div class="form-group">
                            <label for="fNama_idBarang">Nama</label>
                            <input type="text" name="fNama_idBarang" id="fNama_idBarang" class="form-control" placeholder="Masukkan Nama Barang">
                        </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-info pull-right" type="submit" id="btn_submit_idBarang">Tambah</button>
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
        <!-- js datepicker -->
        <script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
        <script type="text/javascript">
            // setting datatable
            $(document).ready(function(){
                // setting datatable
                $("#tabel_id_barang").DataTable({
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

                // setting form tambah id barang

                // btn tambah id barang onclick
                $("#btn_tambahIdBarang").click(function(){
                    // tampilkan modal
                    $("#modal_idBarang").modal('show');
                    $('#form_modal_idBarang').trigger('reset'); // bersihkan form
                });

                // submit form modal tambah id barang
                $("#form_modal_idBarang").submit(function(){
                    var id_barang = $("#fId_barang").val().trim();
                    var nama = $("#fNama_idBarang").val().trim();

                    // validasi
                    if(id_barang === "" || nama === ""){ // jika salah satu field kosong
                        swal("Pesan", "Harap Field Id Barang dan Nama Diisi", "warning");
                        return false;
                    }
                    else{
                        // cek panjang karakter id barang
                        if(id_barang.length > 4){ // jika melebihi ketentuan
                            swal("Pesan", "Id Barang Maksimal Diisi 4 Karakter", "error");
                            return false;
                        }
                        else{
                            swal("doing ajax");
                        }
                    }

                    return false;
                });

                //===================================================================//

                // setting export

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
                    $('#form_modal_export').trigger('reset'); // reset form modal
                    // tampilkan modal
                    $("#btn_export_submit").addClass("btn-success");
                    $("#btn_export_submit").removeClass("btn-danger");
                    $("#modal_export .modal-title").html("Export Excel"); // setting header
                    $("#modal_export").modal();
                });

                // btn pdfBarang onclick
                $("#pdfBarang").click(function(){
                    set_allBtn_disable(); // disable semua btn modal
                    $('#form_modal_export').trigger('reset'); // reset form modal
                    // tampilkan modal
                    $("#btn_export_submit").addClass("btn-danger");
                    $("#btn_export_submit").removeClass("btn-success");
                    $("#modal_export .modal-title").html("Export Pdf"); // setting header
                    $("#modal_export").modal();
                });

                // pilihan jenis export
                $("#fmJenis").change(function(){
                    var value = this.value;
                    if(value === ""){ // jika tidak dipilih 
                        $('#form_modal_export').trigger('reset'); // reset form modal
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
                $("#form_modal_export").submit(function(){
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