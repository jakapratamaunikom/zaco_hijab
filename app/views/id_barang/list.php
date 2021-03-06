<?php
    Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
?>
    
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
                            <button type="button" id="btn_tambahIdBarang" class="btn btn-default btn-flat"><i class="fa fa-plus"></i> Tambah</button>
                            <!-- export excel -->
                            <button type="button" class="btn btn-success btn-flat" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                            <!-- export pdf -->
                            <button type="button" class="btn btn-danger btn-flat" id="exportPdf"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
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
            <div class="overlay" style="display: none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>
</div>
</section>

<!-- modal tambah data -->
<?php include_once("app/views/id_barang/form.php"); ?>

<!-- modal export -->
<?php include_once("app/views/export/formExport.php"); ?>

<div class="loadingPage"></div>

<!-- js modal export -->
<script type="text/javascript" src="<?= base_url."app/views/export/js/initExport.js"; ?>"></script>
<script type="text/javascript" src="<?= base_url."app/views/id_barang/js/initList.js"; ?>"></script>
<script type="text/javascript" src="<?= base_url."app/views/id_barang/js/initForm.js"; ?>"></script>
