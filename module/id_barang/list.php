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
                        <input type="hidden" name="id" id="id">
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

    <!-- modal export -->
    <?php include_once("pages/modals/modal_export.php"); ?>

    <div class="loadingPage"></div>

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
        </script>
        <script type="text/javascript" src="<?= base_url."module/id_barang/init.js"; ?>"></script>
        
    <!-- -->    