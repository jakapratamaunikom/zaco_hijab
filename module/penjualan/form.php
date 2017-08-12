<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
?>

	<!-- form -->

	<!-- css -->
		<!-- Datepicker -->
		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker3.min.css"; ?>"/>
	<!-- -->

	<!-- header dan breadcrumb -->
    <section class="content-header">
        <h1>Penjualan</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
            <li class="active"><a href="<?= base_url."index.php?m=penjualan&p=list"; ?>">Penjualan</a></li>
            <li>Form Data Penjualan</li>
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
                                <h3 class="box-title">Form Data Penjualan</h3>
                            </div>
                        </div>
                    </div>
                    <!-- isi panel box -->
                    <div class="box-body">
                        <div class="row">
                        	<form enctype="multipart/form-data" role="form">
                        		<!-- fieldset data penjualan -->
                        		<div class="col-md-6 col-xs-12">
                        			<fieldset>
	                        			<legend>Data Penjualan</legend>
	                        			<!-- kode penjualan -->
	                        			<div class="form-group">
	                        				<label for="fKd_penjualan">Kode Penjualan</label>
	                        				<input type="text" name="fKd_penjualan" id="fKd_penjualan" class="form-control" placeholder="Kode Penjualan">
	                        			</div>

	                        			<!-- tanggal -->
	                        			<div class="form-group">
	                        				<label for="fTgl">Tanggal</label>
	                        				<input type="text" name="fTgl" id="fTgl" class="form-control datepicker">
	                        			</div>

	                        			<!-- jenis transaksi -->
	                        			<div class="form-group">
	                        				<label for="fJenis">Jenis Transaksi</label>
	                        				<select id="fJenis" name="fJenis" class="form-control">
	                        					<option value="">-- Pilih Jenis Transaksi --</option>
	                        				</select>
	                        			</div>

	                        			<!-- kode barang - qty - tambah-->
	                        			<div class="form-group">
	                        				<div class="row">
	                        					<div class="col-md-8">
	                        						<label for="fKd_barang">Item</label>
			                        				<select id="fKd_barang" name="fKd_barang" class="form-control select2" style="width: 100%;">
			                        					<option value="">-- Pilih Item --</option>
			                        				</select>
	                        					</div>
	                        					<div class="col-md-4">
	                        						<label for="fQty">Qty</label>
	                        						<div class="input-group">
				                        				<input type="number" id="fQty" name="fQty" class="form-control" min="0">
				                        				<span class="input-group-btn">
				                        					<button type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
				                        				</span>
			                        				</div>
	                        					</div>
	                        				</div>
	                        			</div>

	                        			<!-- diskon -->
	                        			<div class="form-group">
	          								
	          										<label for="fDiskon">Diskon</label>
	          									
	          								
	          								
	          									
		          									<div class="input-group">
		          										<input class="form-control" placeholder="Masukkan Diskon" id="fDiskon" name="fDiskon">
		          										<span class="input-group-addon"> %</span>
		          									</div>
	          									
	          								
	          							</div>

	                        			<!-- status transaksi -->
	                        			<div class="form-group">
	                        				<label for="fStatus">Status Transaksi</label>
	                        				<select id="fStatus" name="fStatus" class="form-control">
	                        					<option value="">-- Pilih Status Transaksi --</option>
	                        				</select>
	                        			</div>

	                        		</fieldset>
                        		</div>
                        		<div class="col-md-6 col-xs-12">
                        			<!-- fieldset data pembeli -->
                        			<div class="row">
                        				<div class="col-md-12 col-xs-12">
                        					<fieldset>
			                        			<legend>Data Pembeli</legend>
			                        			<!-- nama -->
			                        			<div class="form-group">
			                        				<label for="fNama">Nama</label>
			                        				<input type="text" name="fNama" id="fNama" class="form-control" placeholder="Masukkan Nama Pembeli">
			                        			</div>

			                        			<!-- no. telp -->
			                        			<div class="form-group">
			                        				<label for="fno_telepon">No. Telepon</label>
			                        				<input type="text" name="fno_telepon" id="fno_telepon" class="form-control" placeholder="Masukkan No. Telepon">
			                        			</div>

			                        			<!-- alamat -->
			                        			<div class="form-group">
			                        				<label for="fAlamat">Alamat</label>
			                        				<textarea class="form-control" placeholder="Masukkan Alamat Pembeli"></textarea>
			                        			</div>
			                        		</fieldset>	
                        				</div>
                        			</div>
                        			<!-- fieldset list item -->
                        			<div class="row">
                        				<div class="col-md-12 col-xs-12">
                        					<fieldset>
			                        			<legend>List Item</legend>
			                        			<div class="row">
			                        				<div class="col-md-12">
			                        					<table class="table table-bordered table-hover">
					                        				<thead>
					                        					<tr>
					                        						<th style="width: 15px">No</th>
					                        						<th>Item</th>
					                        						<th>Harga</th>
					                        						<th>Qty</th>
					                        						<th>Keterangan</th>
					                        						<th>Aksi</th>
					                        					</tr>
					                        				</thead>
					                        			</table>
			                        				</div>
			                        				<div class="col-md-12">
			                        					<h4 class="text-right">Total: Rp. -,00</h4>
			                        				</div>
			                        			</div>	
			                        		</fieldset>
                        				</div>
                        			</div>
                        		</div>
	                        		
                        	</form>
                        </div>
                    </div>
                    <!-- footer box -->
                    <div class="box-footer text-right">
                    	<button type="button" class="btn btn-default btn-lg"><i class="fa fa-plus"></i> Tambah</button>
                    	<button type="button" class="btn btn-default btn-lg">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- js -->
    	<!-- js datepicker -->
		<script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
		<!-- Select2 -->
		<script src="<?= base_url."assets/plugins/select2/select2.full.min.js"; ?>"></script>
		<script type="text/javascript">
			$(function(){
				//Initialize Select2 Elements
	    		$(".select2").select2();

	    		//setting datepicker
				$(".datepicker").datepicker({
					autoclose: true,
			        format: "yyyy-mm-dd",
			        todayHighlight: true,
			        orientation: "bottom auto",
			        todayBtn: true,
			        todayHighlight: true,
				});
			});
		</script>
    <!-- -->