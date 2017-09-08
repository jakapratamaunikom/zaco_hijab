<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
?>

<!-- List -->
<section class="content-header">
	<h1>Reject</h1>
	<ol class="breadcrumb">
		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
		<li><a href="<?= base_url."index.php?m=pengeluaran&p=list"?>">Reject</a></li>
		<li class="active">Lihat Detail Reject</li>
	</ol>
</section>

<section class="invoice">

	<!-- header  -->
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> Faktur Reject
				<small class="pull-right">Tanggal: 17/08/1945</small>
			</h2>
		</div>
	<!-- /.col -->
    </div>

    <!-- baris info -->
    <div class="row invoice-info">

      	<!-- Profil Zaco Hijab -->
        <div class="col-sm-4 col-xs-12 invoice-col">
			Penjual: <!-- Informasi Penjual --> 
			<address>
				<strong>Zaco Hijab, Inc.</strong><br>
				Alamat<br><br>
				Telepon: (+62) 81573777945
			</address>
        </div>

        <div class="col-sm-4 col-xs-12 invoice-col">
			Pembeli: <!-- Informasi Pembeli yang klaim Reject --> 
			<address>
				<strong>Nama: ABCDEFGHIJKL.</strong><br>
				Alamat<br><br>
				Telepon: (+62) 8170216057
			</address>
        </div>

        <!-- /.col -->
        <div class="col-sm-4 col-xs-12 invoice-col">
        	<div class="pull-right">
        		<b>No Penjualan #007612</b><br>
				<b>Jenis:</b> 4F3S8J<br>
				<br><br>
				<b>No Reject #007612</b><br>
        	</div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- panel button -->
    <div class="row" style="padding-bottom: 25px;">
        <div class="col-md-12 col-xs-12">
            <div class="btn-group">
                <!-- tambah -->
                <a href="#" type="button" class="btn btn-default" role="button">
                	<i class="fa fa-edit"></i> Edit
                </a>

                <!-- export pdf -->
                <button type="button" class="btn btn-danger" id="pdfPengeluaran">
                    <i class="fa fa-file-pdf-o"></i> Export Pdf
                </button>
            </div>
        </div>
    </div>


	<!-- Tabel Data Pengeluaran -->
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table id="tabel_lihat_reject" class="table table-striped">
				<thead>
					<tr>
						<th></th>
						<th colspan="2"><center>Barang Lama</center> </th>
						<th colspan="2"><center>Barang Ganti</center></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Qty</th>
						<th>Nama Barang</th>
						<th>Qty</th>
						<th>Jumlah</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<td>1</td>
						<td>Dummy</td>
						<td>Dummy</td>
						<td>Dummy</td>
						<td>Dummy</td>
						<td>Dummy</td>
						<td>Dummy</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- button bawah -->
	<div class="row">
		<div class="col-xs-12">
			<a href="<?= base_url."index.php?m=reject&p=list" ?>" class="btn btn-default btn-lg pull-right" role=button>
				<i class="fa fa-reply"></i> Kembali
			</a>

		</div>
	</div>

</section>

<!-- untuk mengilangkan garis hitam dibawah -->
<div class="clearfix"></div>
