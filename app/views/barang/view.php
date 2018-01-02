<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
	$id = isset($_GET['id']) ? $_GET['id'] : false;
?>
<!-- isi konten -->
<section class="content-header">
	<h1>Barang</h1>
	<ol class="breadcrumb">
		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
		<li>Data Master</li>
		<li><a href="<?= base_url."index.php?m=barang&p=list" ?>"><i class="active"></i>Barang</a></li>
		<li id="viewBarang"></li>
	</ol>
</section>

<!-- isi -->
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<!-- foto barang -->
	        <div class="box">
	        	<div class="box-body box-profile">
	        		<div class="btn-group">
	        			<button type="button" class="btn btn-success btn-sm btn-flat dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    		<i class="fa fa-picture-o"></i>
                    		<span class="fa fa-caret-down"></span>
                    	</button>
              			<ul class="dropdown-menu" role="menu">
                			<li><a href="javascript:;" id="btn_gantiFoto">Ganti Foto</a></li>
                			<li class="divider"></li>
                			<li><a href="javascript:;" id="btn_hapusFoto">Hapus Foto</a></li>
              			</ul>
	        		</div> 
	        		
	            	<div id="foto">
	            		<a href="javascript:;" data-lightbox="image-1" data-title="My caption"><img class="profile-user-img img-responsive" src="javascript:;" alt="User profile picture"></a>
	            	</div>
	            	<h3 class="profile-username text-center" id="nama_barang"></h3>
					<p class="text-muted text-center" id="kd_barang"></p>
					<ul class="list-group list-group-unbordered">
	                	<li class="list-group-item id-barang">
	                  		<b>Id Barang</b> <a class="pull-right" id="id_barang"></a>
	                	</li>
	                	<li class="list-group-item">
	                  		<b>Id Warna</b> <a class="pull-right" id="id_warna"></a>
	                	</li>
	                	<li class="list-group-item">
	                  		<b>HPP</b> <a class="pull-right" id="hpp"></a>
	                	</li>
	                	<li class="list-group-item">
	                  		<b>Harga Pasar</b> <a class="pull-right" id="harga_pasar"></a>
	                	</li>
	                	<li class="list-group-item">
	                  		<b>Market Place</b> <a class="pull-right" id="market_place"></a>
	                	</li>
	                	<li class="list-group-item">
	                  		<b>Harga IG</b> <a class="pull-right" id="harga_ig"></a>
	                	</li>
	                	<li class="list-group-item">
	                  		<b>Keterangan</b> <p class="text-muted" id="ket"></p>
	                	</li>
	              	</ul>
		            <div class="form-group text-center">
		            	<div class="btn-group">
							<!-- tambah -->
          					<a href="<?= base_url."index.php?m=barang&p=form&id=$id" ?>" class="btn btn-default btn-sm btn-flat" role="button"><i class="fa fa-edit"></i> Edit</a>
          					<!-- export excel -->
          					<button type="button" class="btn btn-success btn-sm btn-flat" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
          					<!-- export pdf -->
          					<button type="button" class="btn btn-danger btn-sm btn-flat" id="exportPdf"><i class="fa fa-file-pdf-o"></i> Export Pdf</button>
	            		</div>
		            </div>
	            </div>
	        </div>
	    </div>
        
        <div class="col-md-9">
        	<div class="box ">
            	<!-- tabel -->
            	<div class="box-body">
	            	<div class="row">
	                	<div class="col-md-12 col-xs-12">
	                    	<table id="tabel_stok" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
	                        	<thead>
	                            	<tr>
		                                <th style="width: 15px">No</th>
		                                <th>Tanggal</th>
		                                <th>Stok Awal</th>
		                                <th>Barang Masuk</th>
		                                <th>Barang Keluar</th>
		                                <th>Stok Akhir</th>
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

<!-- modal ganti foto -->
<div class="modal fade" id="modal_foto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- button close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <!-- header modal -->
                <h4 class="modal-title"></h4>
            </div>
            <form id="form_foto" role="form" enctype="multipart/form-data">
            <div class="modal-body">
                <!-- field jenis -->
                <div class="form-group">
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
            </div>
            <div class="box-footer">
                <button class="btn btn-success btn-flat pull-right" type="submit" id="btn_submit">Ganti</button>
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- modal export -->
<?php include_once("app/views/export/formExport.php"); ?>

<!-- js -->
	<!-- DataTables -->
	<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"; ?>"></script>
	<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"; ?>"></script>
	<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"; ?>"></script>
	<script type="text/javascript" src="<?= base_url."assets/plugins/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"; ?>"></script>
	
	<script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>
	<!-- js modal export -->
    <script type="text/javascript" src="<?= base_url."app/views/export/js/initExport.js"; ?>"></script>
    <?php
    	if(!$id){
			?>
			<script type="text/javascript">document.location=base_url+"index.php?m=barang&p=list";</script>
			<?php
		}
    ?>
    <script type="text/javascript" src="<?= base_url."app/views/barang/js/initView.js" ?>"></script>
<!-- -->