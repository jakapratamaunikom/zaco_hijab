<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");

    $notif = isset($_SESSION['notif']) ? $_SESSION['notif'] : false;
    unset($_SESSION['notif']);
	
?>

<section class="content-header">
	<h1>Pengeluaran</h1>
	<ol class="breadcrumb">
		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
		<li><a href="<?= base_url."index.php?m=pengeluaran&p=list"?>">Pengeluaran</a></li>
		<li class="active">Data Pengeluaran</li>
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
                            <h3 class="box-title">Data Pengeluaran</h3>
                        </div>
                    </div>
                    <!-- panel button -->
                    <div class="row" style="padding-top: 25px;">
                        <div class="col-md-12 col-xs-12">
                            <div class="btn-group">
                                <!-- tambah -->
                                <a href="<?= base_url."index.php?m=pengeluaran&p=form" ?>" class="btn btn-default btn-flat" role="button"><i class="fa fa-plus"></i> Tambah</a>
                                <!-- export excel -->
                                <button type="button" id="exportExcel" class="btn btn-success btn-flat">
                                	<i class="fa fa-file-excel-o"></i> Export Excel
                                </button>
                                <!-- export pdf -->
                                <button type="button" id="exportPdf" class="btn btn-danger btn-flat">
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
                            <table id="tabel_pengeluaran" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 15px">No</th>
                                        <th>Kode Pengeluaran</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Total</th>
                                        <th>Jenis</th>
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


<!-- modal ekspor data -->
<?php include_once("app/views/export/formExportTgl.php"); ?>
<!-- js -->
<script type="text/javascript" src="<?= base_url."app/views/export/js/initExportTgl.js"; ?>"></script>
<?php 
    if($notif){
        ?>
        <script>var notif = "<?php echo $notif; ?>";</script>
        <?php
    }
    else{
        ?>
        <script>var notif = false;</script>
        <?php
    } 
?>
<script type="text/javascript" src="<?= base_url."app/views/pengeluaran/js/initList.js"; ?>"></script>

    
