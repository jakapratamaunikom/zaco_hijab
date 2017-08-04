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
    <h1>Pembelian</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
        <li class="active"><a href="<?= base_url."index.php?m=pembelian&p=list"; ?>">Pembelian</a></li>
        <li>Form Data Pembelian</li>
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
                            <h3 class="box-title">Form Data Pembelian</h3>
                        </div>
                    </div>
                </div>
                <!-- isi panel box -->
                <div class="box-body">
                    <div class="row">
                    	<form enctype="multipart/form-data" role="form">
                    		<!-- fieldset data pembelian -->
                    		<div class="col-md-6 col-xs-12">
                    			<fieldset>
                        			<legend>Data Pembelian</legend>
                        			<!-- kode pembelian -->
                        			<div class="form-group">
                        				<label for="fKd_pembelian">Kode Pembelian</label>
                        				<input type="text" name="fKd_pembelian" id="fKd_pembelian" class="form-control" placeholder="Masukkan Kode Pembelian">
                        			</div>

                        			<!-- tanggal -->
                        			<div class="form-group">
                        				<label for="fTgl">Tanggal</label>
                        				<input type="text" name="fTgl" id="fTgl" class="form-control datepicker">
                        			</div>

                        			
                        		</fieldset>


            					<fieldset>
                        			<legend>Data Barang</legend>
                        			<!-- nama -->
                        			<!-- kode barang - qty -->
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
		                        				<input type="number" id="fQty" name="fQty" class="form-control" min="0">

                        					</div>	
                        				
                        				</div>
                        			</div>


                        			<!-- Harga -->
          							<div class="form-group">
          								<div class="row">
          									<div class="col-md-12 col-xs-12">
          										<label for="fHarga">Harga</label>
          									</div>
          								</div>
          								<div class="row">
          									<div class="col-md-12 col-xs-12">
	          									<div class="input-group">
	          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">
	          											Rp. 
	          										</span>
	          										<input class="form-control" placeholder="Masukkan Harga" id="fHarga" name="fHarga" type="text">
	          										<span class="input-group-addon">,00</span>
	          										<span class="input-group-btn">
			                        					<button type="button" id="fTambah_pembelian" name="fTambah_pembelian" class="btn btn-default">
			                        						<i class="fa fa-plus"></i>
			                        					</button>
			                        				</span>
	          									</div>
	       									</div>
          								</div>		
          							</div>
                        		</fieldset>	


                    		</div>
                    		<div class="col-md-6 col-xs-12">
                    			
                    			<!-- fieldset list item -->
                    			<div class="row">
                    				<div class="col-md-12 col-xs-12">
                    					<fieldset>
		                        			<legend>List Item</legend>
		                        			<div class="row">
		                        				<div class="col-md-12">
		                        					<table id="tabel_item_pembelian" class="table table-bordered table-hover">
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