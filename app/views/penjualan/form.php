<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
	$id = isset($_GET['id']) ? $_GET['id'] : false;

	if($id) $btn = "edit";
	else $btn = "tambah";
?>

<!-- form -->

<!-- css -->
	<!-- Datepicker -->
	<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker3.min.css"; ?>"/>
<!-- -->

<!-- header dan breadcrumb -->
<section class="content-header">
    <h1>Form Data Penjualan</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
        <li class="active"><a href="<?= base_url."index.php?m=penjualan&p=list"; ?>">Penjualan</a></li>
        <li>Form Data Penjualan</li>
    </ol>
</section>

<!-- isi konten -->
<section class="content">
	<form enctype="multipart/form-data" role="form" id="form_penjualan">
		<input type="hidden" name="id" id="id">
    	<!-- panel 1 -->
    	<div class="row">
    		<div class="col-md-12">
    			<!-- panel data penjualan -->
	    		<div class="box">
	    			<div class="box-body">
	    				<div class="col-md-6">	    				
	    					<fieldset>
	    						<legend>Data Penjualan</legend>
	    						<!-- kode dan tgl -->
	    						<div class="row">
	    							<div class="col-md-6">
	    								<!-- kode -->
	    								<div class="form-group">
		                    				<label for="fKd_penjualan">Kode Penjualan</label>
		                    				<input type="text" name="fKd_penjualan" id="fKd_penjualan" class="form-control" placeholder="Kode Penjualan">
		                    			</div>		
	    							</div>
	    							<div class="col-md-6">
	    								<!-- tanggal -->
		                    			<div class="form-group">
		                    				<label for="fTgl">Tanggal</label>
		                    				<input type="text" name="fTgl" id="fTgl" class="form-control datepicker">
		                    			</div>
	    							</div>
	    						</div>
	    						<!-- jenis dan status -->
	    						<div class="row">
	    							<div class="col-md-6">
	    								<!-- jenis transaksi -->
		                    			<div class="form-group">
		                    				<label for="fJenis">Jenis Transaksi</label>
		                    				<select id="fJenis" name="fJenis" class="form-control">
		                    				</select>
		                    			</div>
	    							</div>
	    							<div class="col-md-6">
	    								<!-- status transaksi -->
		                    			<div class="form-group">
		                    				<label for="fStatus">Status Transaksi</label>
		                    				<select id="fStatus" name="fStatus" class="form-control">
		                    				</select>
		                    			</div>
	    							</div>
	    						</div>
	    						<div class="form-group">
                    				<label for="fKet">Keterangan</label>
                    				<textarea id="fKet" class="form-control" placeholder="Masukkan Keterangan Penjualan"></textarea>
                    			</div>
	    					</fieldset>
	    				</div>
			    		<!-- panel data pembeli -->
			    		<div class="col-md-6">
	    					<fieldset>
	    						<legend>Data Pembeli</legend>
	    						<!-- nama dan no.telp -->
	    						<div class="row">
	    							<!-- nama -->
	    							<div class="col-md-6">
	    								<div class="form-group">
	                        				<label for="fNama">Nama</label>
	                        				<input type="text" name="fNama" id="fNama" class="form-control" placeholder="Masukkan Nama Pembeli">
	                        			</div>	
	    							</div>
	    							<div class="col-md-6">
	    								<div class="form-group">
	                        				<label for="fno_telepon">No. Telepon</label>
	                        				<input type="text" name="fno_telepon" id="fno_telepon" class="form-control" placeholder="Masukkan No. Telepon">
	                        			</div>
	    							</div>
	    						</div>
	    						<!-- alamat -->
	    						<div class="form-group">
                    				<label for="fAlamat">Alamat</label>
                    				<textarea id="fAlamat" class="form-control" placeholder="Masukkan Alamat Pembeli"></textarea>
                    			</div>
                    			<!-- ongkir -->
                    			<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <label for="fOngkir">Ongkir</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="background-color: #dd4b39; color: white;">
                                                    Rp. 
                                                </span>
                                                <input class="form-control" placeholder="Masukkan Ongkir" id="fOngkir" name="fOngkir" type="number" min="0">
                                                <span class="input-group-addon">,00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block small"></span>  
                                </div>
	    					</fieldset>
			    		</div>
	    			</div>
	    		</div>
    		</div>
    	</div>
    	<!-- panel 2 -->
    	<div class="row">
   			<div class="col-md-12">
   				<div class="box">
   					<div class="box-body">
   						<fieldset>
	   						<div class="row">
	   							<div class="col-md-12">
		   							<legend>List Item</legend>
		   							<!-- kode barang - qty-->
	                    			<div class="form-group">
	                    				<div class="row">
	                    					<div class="col-md-6 col-xs-6">
	                    						<label for="fKd_barang">Item</label>
		                        				<select id="fKd_barang" name="fKd_barang" class="form-control select2" style="width: 100%;">
		                        				</select>
	                    					</div>
	                    					<div class="col-md-6 col-xs-6">
	                    						<label for="fQty">Qty</label>
	                    						<div class="input-group">
			                        				<input type="number" id="fQty" name="fQty" class="form-control" min="0" placeholder="Qty">
			                        				<span class="input-group-addon">pcs</span>
		                        				</div>
	                    					</div>
	                    				</div>
	                    			</div>

	                    			<!-- diskon + tambah -->
	                    			<div class="form-group">
	                    				<div class="row">
	                    					<div class="col-md-6 col-xs-6">
	                    						<label for="fJenisDiskon">Jenis Diskon</label>
		                        				<select id="fJenisDiskon" name="fJenisDiskon" class="form-control">
		                        				</select>
	                    					</div>
	                    					<div class="col-md-6 col-xs-6">
	                    						<label for="fDiskon">Diskon</label>
	                    						<div class="input-group">
	                    							<span class="input-group-addon">Rp.</span>
			                        				<input type="number" id="fDiskon" name="fDiskon" class="form-control" min="0" placeholder="Masukkan Diskon">
			                        				<span class="input-group-btn">
			                        					<button type="button" class="btn bg-maroon btn-flat" id="btn_tambahItem"><i class="fa fa-plus"></i></button>
			                        				</span>
		                        				</div>
	                    					</div>
	                    				</div>
	                    			</div>
	   							</div>
	   						</div>
   							<div class="row">
   								<div class="col-md-12">
   									<div class="table-responsive">
   										<table id="tabel_item_penjualan" class="table table-bordered table-hover">
	                        				<thead>
	                        					<tr>
	                        						<th style="width: 15px">No</th>
	                        						<th>Item</th>
	                        						<th>Harga</th>
	                        						<th>Qty</th>
	                        						<th>Diskon</th>
	                        						<th>Keterangan</th>
	                        						<th>Subtotal</th>
	                        						<th>Aksi</th>
	                        					</tr>
	                        				</thead>
	                        				<tbody></tbody>
	                        			</table>
   									</div>
                        			<h4 id="tampilHarga" class="text-right">Total: Rp. -,00</h4>
   								</div>
   							</div>

   						</fieldset>	
   					</div>
   					<div class="box-footer text-right">
                    	<button type="submit" class="btn btn-default btn-lg btn-flat" id="btn_submit_penjualan" name="action" value="<?= $btn ?>"><i class="fa fa-plus"></i> <?= ucfirst($btn); ?></button>
                    	<button type="button" class="btn btn-default btn-lg btn-flat">Batal</button>
                    </div>
   				</div>
   			</div>
    	</div>
    </form>
</section>

<!-- js -->
	<!-- js datepicker -->
	<script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
	<!-- Select2 -->
	<script src="<?= base_url."assets/plugins/select2/select2.full.min.js"; ?>"></script>
	<script type="text/javascript" src="<?= base_url."assets/plugins/jquery-mask/jquery.mask.min.js"; ?>"></script>
	<script type="text/javascript">
        var base_url = "<?php print base_url; ?>";
        var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;
        var listItem = [];
        var indexItem = 0;
    </script>
	<script type="text/javascript" src="<?= base_url."app/views/penjualan/init_form.js"; ?>"></script>
<!-- -->