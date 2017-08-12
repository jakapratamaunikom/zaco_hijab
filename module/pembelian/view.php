<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
?>

<!-- List -->
<section class="content-header">
	<h1>Pembelian</h1>
	<ol class="breadcrumb">
		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
		<li><a href="<?= base_url."index.php?m=Pembelian&p=list"?>">Pembelian</a></li>
		<li class="active">Lihat Data Pembelian</li>
	</ol>
</section>

<section class="invoice">

	<!-- header  -->
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> Zaco Hijab
				<small class="pull-right">Tanggal: 17/08/1945</small>
			</h2>
		</div>
	<!-- /.col -->
    </div>

    <!-- baris info -->
    <div class="row invoice-info">

      	<!-- Profil Zaco Hijab -->
        <div class="col-sm-6 col-xs-12 invoice-col">
			Detail Pembelian <!-- Jenis Info/Faktur --> 
			<address>
				<strong>Zaco Hijab, Inc.</strong><br>
				Alamat<br><br>
				Telepon: (+62) 81573777945
			</address>
        </div>

        <!-- /.col -->
        <div class="col-sm-6 col-xs-12 invoice-col">
        	<div class="pull-right">
        		<b>No Pembelian #007612</b><br>
				<b>Jenis:</b> 4F3S8J<br>
				<br><br>
				<b>Total: Rp.</b> xxx.xxx,00,-
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
                <button type="button" class="btn btn-danger" id="pdfPembelian">
                    <i class="fa fa-file-pdf-o"></i> Export Pdf
                </button>
            </div>
        </div>
    </div>


	<!-- Tabel Data Pengeluaran -->
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table id="tabel_lihat_pembelian" class="table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Harga</th>
						<th>Qty</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<td>1</td>
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
			<a href="<?= base_url."index.php?m=pembelian&p=list" ?>" class="btn btn-default btn-lg pull-right" role=button>
				<i class="fa fa-reply"></i> Kembali
			</a>

		</div>
	</div>

</section>

<!-- untuk mengilangkan garis hitam dibawah -->
<div class="clearfix"></div>

