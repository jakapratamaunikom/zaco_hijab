<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
	$id = isset($_GET['id']) ? $_GET['id'] : false;

	if($id) $btn = "edit";
	else $btn = "tambah";
?>

	<!-- form -->

	<!-- css -->

	<!-- -->

	<!-- isi konten -->
	<section class="content-header">
  		<h1>Barang</h1>
  		<ol class="breadcrumb">
    		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
    		<li>Data Master</li>
    		<li><a href="<?= base_url."index.php?m=barang&p=list" ?>">Barang</a></li>
    		<li><i class="active"></i>Form Data Barang</a></li>
  		</ol>
	</section>

	<!-- isi -->
	<section class="content">
		<div class="row">
    		<div class="col-xs-12">
    			<!-- panel box -->
    			<div class="box">
    				<!-- judul panel box -->
    				<div class="box-header">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <h3 class="box-title">Form Data Barang</h3>
                            </div>
                        </div>
    				</div>
    				<form id="form_barang" role="form" enctype="multipart/form-data">
    					<input type="hidden" name="id" id="id">
	    				<!-- isi panel box -->
	    				<div class="box-body">
	    					<!-- fieldset data barang -->
	    					<div class="row">
	    						<!-- data barang  -->
	    						<div class="col-md-6">
	    							<fieldset>
	          							<legend>Data Barang</legend>
	          							<!-- id barang -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-6 col-xs-12">
	          										<label for="fId_barang">Id Barang</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-9 col-xs-12">
	          										<select id="fId_barang" name="fId_barang" class="form-control select2" style="width: 100%;">
			          									
			          								</select>
			          								<span class="help-block small"></span>
	          									</div>
	          									<div class="col-md-3 col-xs-12">
	          										<button type="button" class="btn btn-default btn-flat pull-right" id="btn_tambah_idBarang">Tambah Id Barang</button>
	          									</div>
	          								</div>		
	          							</div>

	          							<!-- id warna -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-6 col-xs-12">
	          										<label for="fId_warna">Id Warna</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-9 col-xs-12">
	          										<select id="fId_warna" name="fId_warna" class="form-control select2" style="width: 100%;">
			          									
			          								</select>
			          								<span class="help-block small"></span>
	          									</div>
	          									<div class="col-md-3 col-xs-12">
	          										<button type="button" class="btn btn-default btn-flat pull-right" id="btn_tambah_idWarna">Tambah Id Warna</button>
	          									</div>
	          								</div>		
	          							</div>

	          							<!-- kode barang -->
	          							<div class="form-group">
	          								<label for="fKd_barang">Kode Barang</label>
	          								<input type="text" class="form-control" placeholder="Kode Barang" id="fKd_barang" name="fKd_barang" readonly="readonly">
	          								<span class="help-block small"></span>
	          							</div>

	          							<!-- nama barang -->
	          							<div class="form-group">
      										<label for="fNama_barang">Nama</label>
	          								<input type="text" class="form-control" placeholder="Masukkan Nama Barang" id="fNama_barang" name="fNama_barang">
	          								<span class="help-block small"></span>	
	          							</div>

	          							<!-- foto -->
						          		<div class="form-group" id="field_foto">
						          			<!-- preview foto -->
						          			<label for="fFoto">Foto</label>
						          			<div class="input-group image-preview">
								                <input type="text" id="fFoto_text" class="form-control image-preview-filename" disabled="disabled">
								                <span class="input-group-btn">
								                    <!-- image-preview-clear button -->
								                    <button type="button" class="btn btn-default btn-flat image-preview-clear" style="display:none;">
								                        <span class="glyphicon glyphicon-remove"></span> Hapus
								                    </button>
								                    <!-- image-preview-input -->
								                    <div class="btn btn-danger btn-flat image-preview-input">
								                        <span class="glyphicon glyphicon-folder-open"></span>
								                        <span class="image-preview-input-title">Pilih Foto</span>
								                        <input type="file" accept="image/png, image/jpeg, image/gif" name="fFoto" id="fFoto" /> <!-- rename it -->
								                    </div>
								                </span>
								            </div>
								            <span class="help-block small"></span>
						                </div>

						                <!-- keterangan -->
	          							<div class="form-group">
	          								<label for="fKet">Keterangan</label>
	          								<textarea class="form-control" rows="2" placeholder="Masukkan Keterangan" id="fKet" name="fKet"></textarea>
	          								<span class="help-block small"></span>
	          							</div>
	              					</fieldset>
	    						</div>

	    						<!-- data harga -->
	    						<div class="col-md-6">
	    							<div class="row">
	    								<div class="col-sm-12">
	    									<fieldset>
			          							<legend>Data Harga</legend>
			          							<!-- HPP -->
			          							<div class="form-group">
			          								<label for="fHpp">HPP</label>
		          									<div class="input-group">
		          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
		          										<input type="number" min="0" class="form-control" placeholder="Masukkan HPP" id="fHpp" name="fHpp">
		          										<span class="input-group-addon">,00</span>
		          									</div>
		          									<span class="help-block small"></span>		
			          							</div>

			          							<!-- Harga Pasar -->
			          							<div class="form-group">
			          								<label for="fHarga_pasar">Harga Pasar</label>
		      										<div class="input-group">
		          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
		      											<input type="number" min="0" class="form-control" placeholder="Masukkan Harga Pasar" id="fHarga_pasar" name="fHarga_pasar">
		      											<span class="input-group-addon">,00</span>
		      										</div>
		      										<span class="help-block small"></span>
			          							</div>

			          							<!-- market place -->
			          							<div class="form-group">
		      										<label for="fHarga_market">Harga Market Place</label>
		      										<div class="input-group">
		          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
		      											<input type="number" min="0" class="form-control" placeholder="Masukkan Harga Market Place" id="fHarga_market" name="fHarga_market">
		      											<span class="input-group-addon">,00</span>
		      										</div>
		      										<span class="help-block small"></span>
			          							</div>

			          							<!-- harga ig -->
			          							<div class="form-group">
			          								<label for="fHarga_ig">Harga IG</label>
		      										<div class="input-group">
		          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
		      											<input type="number" min="0" class="form-control" placeholder="Masukkan Harga IG" id="fHarga_ig" name="fHarga_ig">
		      											<span class="input-group-addon">,00</span>
		      										</div>
		      										<span class="help-block small"></span>
			          							</div>
			          						</fieldset>
	    								</div>
	    							</div>
	    							<div class="row">
	    								<div class="col-sm-12">
	    									<fieldset>
	    										<legend>Data Stok Awal</legend>
	    										<!-- stok awal -->
	    										<div class="form-group">
	    											<label for="fStokAwal">Stok Awal</label>
		          									<div class="input-group">
		          										<input type="number" min="0" class="form-control" placeholder="Masukkan Stok Awal" id="fStokAwal" name="fStokAwal">
		          										<span class="input-group-addon">pcs</span>
		          									</div>
		          									<span class="help-block small"></span>
	    										</div>
	    									</fieldset>
	    								</div>
	    							</div>
			    							
	    						</div>
	    					</div>	
	    				</div>
		    			<div class="box-footer text-right">
		    				<div class="form-group">
		    					<button type="submit" class="btn btn-default btn-lg btn-flat" id="btn_submit_barang" name="action" value="<?= $btn ?>"><i class="fa fa-plus"></i> <?= ucfirst($btn); ?></button>
								<a href="<?=base_url."index.php?m=barang&p=list" ?>" class="btn btn-default btn-lg btn-flat"><i class="fa fa-reply"></i>  Batal</a>
		    				</div>
						</div>
					</form>		
    			</div>
    		</div>
    	</div>	
	</section>

	<!-- modal tambah data id barang -->
    <?php include("pages/modals/modal_id_barang.php"); ?>

    <!-- modal tambah data id warna -->
    <?php include_once("pages/modals/modal_id_warna.php"); ?>

	<!-- js -->
		<script src="<?= base_url."assets/plugins/select2/select2.full.min.js"; ?>"></script>
		<script type="text/javascript">
            var base_url = "<?php print base_url; ?>";
            var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;
        </script>
		<script type="text/javascript" src="<?= base_url."module/barang/init.js" ?>"></script>
    <!-- -->