<?php
    Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
    // session_start();
    // var_dump($_SESSION['notif']);
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
                                    <button type="button" class="btn btn-success" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                                    <!-- export pdf -->
                                    <button type="button" class="btn btn-danger" id="exportPdf"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
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
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="form_modal_idBarang" role=form>
                        <!-- field id barang -->
                        <div class="form-group">
                            <label for="fId_barang">Id Barang</label>
                            <input type="text" name="fId_barang" id="fId_barang" class="form-control" placeholder="Masukkan ID Barang">
                            <span class="help-block small"></span>
                        </div>
                        <!-- field nama -->
                        <div class="form-group">
                            <label for="fNama_idBarang">Nama</label>
                            <input type="text" name="fNama_idBarang" id="fNama_idBarang" class="form-control" placeholder="Masukkan Nama Barang">
                            <span class="help-block small"></span>
                        </div>
                </div>
                <div class="box-footer">
                    <input class="btn btn-info pull-right" type="submit" id="btn_submit_idBarang" name="action" value="Tambah">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="loadingPage"></div>

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
        <!-- js modal export -->
        <script type="text/javascript" src="<?= base_url."pages/modals/modal_export.js"; ?>"></script>
        <!-- js list -->
        <script type="text/javascript">
            var base_url = "<?php print base_url; ?>";

            $(document).ready(function(){

                // setting datatable
                var tabel_id_barang = $("#tabel_id_barang").DataTable({
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
                        url: base_url+"module/id_barang/action.php",
                        type: 'POST',
                        data: {
                            "action" : "list",
                        }
                    },
                    "columnDefs": [
                        {
                            "targets":[0, 3], // disable order di kolom 1 dan 3
                            "orderable":false,
                        }
                    ],
                });
                // console.log(tabel_id_barang);

                // setting form tambah id barang

                // btn tambah id barang onclick
                $("#btn_tambahIdBarang").click(function(){
                    // reset pesan error
                    $("#fId_barang").parent().find('.help-block').text("");
                    $("#fId_barang").closest('div').removeClass('has-error');
                    $("#fNama_idBarang").parent().find('.help-block').text("");
                    $("#fNama_idBarang").closest('div').removeClass('has-error');

                    // tampilkan modal
                    $("#modal_idBarang .modal-title").html("Form Tambah Data Id Barang"); // ganti heade form
                    $("#btn_submit_idBarang").prop("value", "Tambah");
                    $("#modal_idBarang").modal();
                    $('#form_modal_idBarang').trigger('reset'); // bersihkan form
                });

                // submit form modal tambah id barang
                $("#form_modal_idBarang").submit(function(e){
                    e.preventDefault();

                    var id_barang = $("#fId_barang").val().trim();
                    var nama = $("#fNama_idBarang").val().trim();
                    var submit = $("#btn_submit_idBarang").val();

                    $.ajax({
                        url: base_url+"module/id_barang/action.php",
                        type: "post",
                        dataType: "json",
                        data: {
                            "fId_barang" : id_barang,
                            "fNama_idBarang" : nama,
                            "action" : submit,
                        },
                        success: function(hasil){
                            if(hasil.status){ // jika status true
                                $('#form_modal_idBarang').trigger('reset');
                                $("#form_modal_idBarang").modal('hide');
                                if(submit.toLowerCase()==="edit") alertify.success('Data Berhasil Diedit');
                                else alertify.success('Data Berhasil Ditambah');
                                tabel_id_barang.ajax.reload();
                            }
                            else{ // jika status false
                                // cek jenis error
                                if(hasil.errorDb){
                                    // alert("Koneksi Database Error, Silahkan Coba Lagi");
                                    swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
                                    $('#form_modal_idBarang').trigger('reset');
                                    $("#form_modal_idBarang").modal('hide');
                                }
                                else{
                                    // set error dan value fId_barang
                                    $("#fId_barang").parent().find('.help-block').text("");
                                    if(!jQuery.isEmptyObject(hasil.pesanError.id_barangError)){
                                        $("#fId_barang").parent().find('.help-block').text(hasil.pesanError.id_barangError);
                                        $("#fId_barang").closest('div').addClass('has-error');
                                    }
                                    $("#fId_barang").val(hasil.set_value.id_barang);

                                    // set error dan value fNama_idBarang
                                    $("#fNama_idBarang").parent().find('.help-block').text("");
                                    if(!jQuery.isEmptyObject(hasil.pesanError.namaBarangError)){
                                        $("#fNama_idBarang").parent().find('.help-block').text(hasil.pesanError.namaBarangError);
                                        $("#fNama_idBarang").closest('div').addClass('has-error');
                                    }   
                                    $("#fNama_idBarang").val(hasil.set_value.namaBarang);
                                }   
                            }

                            console.log(hasil);
                        },
                        error: function (jqXHR, textStatus, errorThrown) // error handling
                        {
                            alert("Operasi Gagal");
                            console.log(jqXHR, textStatus, errorThrown);
                        }
                    })

                    return false;
                });

                //===================================================================//
            });

            // fungsi get data edit
            function edit_id_barang(id){
                $.ajax({
                    url: base_url+"module/id_barang/action.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        "id" : id,
                        "action" : "getEdit",
                    },
                    beforeSend: function(){
                        $("body").addClass("loading_gif");
                    },
                    success: function(data){
                        $("body").removeClass("loading_gif");
                        // reset modal
                        $("#fId_barang").parent().find('.help-block').text("");
                        $("#fId_barang").closest('div').removeClass('has-error');
                        $("#fNama_idBarang").parent().find('.help-block').text("");
                        $("#fNama_idBarang").closest('div').removeClass('has-error');

                        // tampilkan modal
                        $("#modal_idBarang .modal-title").html("Form Edit Data Id Barang");
                        $("#fId_barang").val(data.id_barang);
                        // $("#fId_barang").prop("disabled", true);
                        $("#fNama_idBarang").val(data.nama);
                        $("#btn_submit_idBarang").prop("value", "Edit");
                        $("#modal_idBarang").modal();
                        // alert(data.name);
                    },
                    error: function (jqXHR, textStatus, errorThrown) // error handling
                    {
                        alert('Error get data from ajax');
                    }
                })
                // console.log(id);
            }
        </script>
        
    <!-- -->    