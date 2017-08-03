<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
?>

	<!-- form -->

	<!-- css -->
		<!-- DataTables -->
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css"; ?>"/>
  		<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css"; ?>"/>
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
    				<!-- isi panel box -->
    				<div class="box-body">
    					<!-- fieldset data barang -->
    					<div class="row">
	    					<form>
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
	          										<select id="fId_barang" name="fId_barang" class="form-control">
			          									<option value="">-- Pilih Id Barang --</option>
			          								</select>
	          									</div>
	          									<div class="col-md-3 col-xs-12">
	          										<button type="button" class="btn btn-default pull-right">Tambah Id Barang</button>
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
	          										<select id="fId_warna" name="fId_barang" class="form-control">
			          									<option value="">-- Pilih Id Warna --</option>
			          								</select>
	          									</div>
	          									<div class="col-md-3 col-xs-12">
	          										<button type="button" class="btn btn-default pull-right">Tambah Id Warna</button>
	          									</div>
	          								</div>		
	          							</div>

	          							<!-- kode barang -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<label for="fKd_barang">Kode Barang</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<input class="form-control" placeholder="Kode Barang" id="fKd_barang" name="fKd_barang">
	          									</div>
	          								</div>		
	          							</div>

	          							<!-- nama barang -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<label for="fNama_barang">Nama</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<input class="form-control" placeholder="Masukkan Nama Barang" id="fNama_barang" name="fNama_barang">
	          									</div>
	          								</div>		
	          							</div>

	          							<!-- foto -->
						          		<div class="form-group">
						          			<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<label for="fFoto">Foto</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
								                	<div class="input-group">
								                		<div class="input-group-btn">
								                			<button type="button" class="btn btn-danger" id="fFoto" name="fFoto">Pilih Foto</button>
								                		</div>
								                		<input class="form-control" type="text">
								                	</div>	
								                </div>
						                	</div>
						                </div>

						                <!-- keterangan -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<label for="fKet">Keterangan</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<textarea class="form-control" rows="2" placeholder="Masukkan Keterangan" id="fKetn" name="fKet"></textarea>
	          									</div>
	          								</div>		
	          							</div>
	              					</fieldset>
	    						</div>

	    						<!-- data harga -->
	    						<div class="col-md-6">
	    							<fieldset>
	          							<legend>Data Harga</legend>
	          							<!-- HPP -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<label for="fHpp">HPP</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
		          									<div class="input-group">
		          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
		          										<input class="form-control" placeholder="Masukkan HPP" id="fHpp" name="fHpp">
		          										<span class="input-group-addon">,00</span>
		          									</div>
	          									</div>
	          								</div>		
	          							</div>

	          							<!-- Harga Pasar -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<label for="fHarga_pasar">Harga Pasar</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<div class="input-group">
		          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
	          											<input class="form-control" placeholder="Masukkan Harga Pasar" id="fHarga_pasar" name="fHarga_pasar">
	          											<span class="input-group-addon">,00</span>
	          										</div>
	          									</div>
	          								</div>		
	          							</div>

	          							<!-- market place -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<label for="fHarga_market">Harga Market Place</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<div class="input-group">
		          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
	          											<input class="form-control" placeholder="Masukkan Harga Market Place" id="fHarga_market" name="fHarga_market">
	          											<span class="input-group-addon">,00</span>
	          										</div>
	          									</div>
	          								</div>		
	          							</div>

	          							<!-- harga ig -->
	          							<div class="form-group">
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<label for="fHarga_ig">Harga IG</label>
	          									</div>
	          								</div>
	          								<div class="row">
	          									<div class="col-md-12 col-xs-12">
	          										<div class="input-group">
		          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
	          											<input class="form-control" placeholder="Masukkan Harga IG" id="fHarga_ig" name="fHarga_ig">
	          											<span class="input-group-addon">,00</span>
	          										</div>
	          									</div>
	          								</div>		
	          							</div>
	          						</fieldset>
	    						</div>
	    					</form>
    					</div>	
    				</div>
	    			<div class="box-footer text-right">
						<button type="submit" class="btn btn-default btn-lg"><i class="fa fa-plus"></i>  Tambah</button>
						<a href="<?=base_url."index.php?m=barang&p=list" ?>" class="btn btn-default btn-lg"><i class="fa fa-reply"></i>  Batal</button>
					</div>		
    			</div>
    		</div>
    	</div>	
	</section>

	

	<!-- js -->
    	<!-- DataTables -->
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"; ?>"></script>
		<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"; ?>"></script>
		<script type="text/javascript">
			//setting datatable
			$(function(){
				$("#tabel_barang").DataTable({
					"language" : {
						"lengthMenu": "Tampilkan _MENU_ data/page",
			            "zeroRecords": "Data Tidak Ada",
			            "info": "Page _PAGE_ dari _PAGES_",
			            "infoEmpty": "Data Kosong",
			            "search": "Pencarian:",
			            "paginate": {
					        "first": "Pertama",
					        "last": "Terakhir",
					        "next": "Selanjutnya",
					        "previous": "Sebelumnya"
					    }
					}
				});
			});
		</script>
    <!-- -->