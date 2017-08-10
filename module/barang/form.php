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
    				<!-- isi panel box -->
    				<div class="box-body">
    					<!-- fieldset data barang -->
    					<div class="row">
	    					<form id="form_barang" role="form" enctype="multipart/form-data">
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
	          										<select id="fId_barang" name="fId_barang" class="form-control select2">
			          									<option value="">-- Pilih Id Barang --</option>
			          								</select>
	          									</div>
	          									<div class="col-md-3 col-xs-12">
	          										<button type="button" class="btn btn-default pull-right" id="btn_tambah_idBarang">Tambah Id Barang</button>
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
	          										<select id="fId_warna" name="fId_barang" class="form-control select2">
			          									<option value="">-- Pilih Id Warna --</option>
			          								</select>
	          									</div>
	          									<div class="col-md-3 col-xs-12">
	          										<button type="button" class="btn btn-default pull-right" id="btn_tambah_idWarna">Tambah Id Warna</button>
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
    					</div>	
    				</div>
	    			<div class="box-footer text-right">
	    				<div class="form-group">
	    					<button type="submit" class="btn btn-default btn-lg" id="btn_submit_barang" name="action" value="<?= $btn ?>"><i class="fa fa-plus"></i> <?= ucfirst($btn); ?></button>
							<a href="<?=base_url."index.php?m=barang&p=list" ?>" class="btn btn-default btn-lg"><i class="fa fa-reply"></i>  Batal</a>
	    				</div>
	    				</form>
					</div>		
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
        </script>
		<script type="text/javascript">
			//setting datatable
			$(document).ready(function(){
				$(".select2").select2();

				setSelect("id_barang", $("#fId_barang"));
				setSelect("id_warna", $("#fId_warna"));

				// button tambah id barang onclick
				$("#btn_tambah_idBarang").click(function(){
					// reset pesan error
			        reset_form("#form_modal_idBarang");
			        // tampilkan modal
			        $("#modal_idBarang .modal-title").html("Form Tambah Data Id Barang"); // ganti heade form
			        $("#btn_submit_idBarang").prop("value", "Tambah");
			        $("#modal_idBarang").modal();
				});

				// button tambah id barang onclick
				$("#btn_tambah_idWarna").click(function(){
					// reset pesan error
			        reset_form("#form_modal_idWarna");
			        // tampilkan modal
			        $("#modal_idWarna .modal-title").html("Form Tambah Data Id Warna"); // ganti heade form
			        $("#submit_idWarna").prop("value", "Tambah");
			        $("#modal_idWarna").modal();
				});
			});

			// funsgi set isi select id_barang dan id_warna
			function setSelect(select, idSelect){
				// reset ulang select
				if(select === "id_barang") var text = "-- Pilih Id Barang --";
				else var text = "-- Pilih Id Warna --";

				idSelect.find('option').remove().end().
					append($('<option>',
						{value: "", text:text}));
				$.ajax({
					url: base_url+"module/barang/action.php",
			        type: "post",
			        dataType: "json",
			        data: {
			            "select" : select,
			            "action" : "getSelect",
			        },
			        success: function(data){
			        	$.each(data, function(index, item){
							idSelect.append($("<option>", {
								value: item.id,
								text: item[1]+" - "+item.nama,
							}));					
						});
			        },
			        error: function (jqXHR, textStatus, errorThrown) // error handling
			        {
			            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
			            console.log(jqXHR, textStatus, errorThrown);
			            // location.reload();
			        }
				})
			}

			function reset_form(form){

			    // reset pesan error
			    if(form === "#form_barang"){

			    }
			    else if(form === "#form_modal_idBarang"){
			    	$("#fId_barang").parent().find('.help-block').text("");
				    $("#fId_barang").closest('div').removeClass('has-error');
				    $("#fNama_idBarang").parent().find('.help-block').text("");
				    $("#fNama_idBarang").closest('div').removeClass('has-error');
				  	// $('#form_modal_idBarang').trigger('reset');

			    }
			    else if(form === "#form_modal_idWarna"){
			    	$("#fId_warna").parent().find('.help-block').text("");
				    $("#fId_warna").closest('div').removeClass('has-error');
				    $("#fNama_idWarna").parent().find('.help-block').text("");
				    $("#fNama_idWarna").closest('div').removeClass('has-error');
				    // $("#form_modal_idWarna").trigger('reset');
			    }
				
			    // bersihkan form
			    $(form).trigger('reset');
			}


		</script>
    <!-- -->