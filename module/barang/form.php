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
	          										<select id="fId_warna" name="fId_barang" class="form-control select2" style="width: 100%;">
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
	          								<label for="fKd_barang">Kode Barang</label>
	          								<input class="form-control" placeholder="Kode Barang" id="fKd_barang" name="fKd_barang">
	          							</div>

	          							<!-- nama barang -->
	          							<div class="form-group">
      										<label for="fNama_barang">Nama</label>
	          								<input class="form-control" placeholder="Masukkan Nama Barang" id="fNama_barang" name="fNama_barang">		
	          							</div>

	          							<!-- foto -->
						          		<div class="form-group">
						          			<div class="row">
						          				<div class="col-sm-2">
						          					<div class="fileUpload btn btn-danger">
								          				<span>Pilih Foto</span>
								          				<input type="file" name="fFoto" id="fFoto" class="upload">
								          			</div>
						          				</div>
							          			<div class="col-sm-10">
	                    							<input type="text" class="form-control" id="fFoto_text" placeholder="Pilih File Foto.." disabled="disabled">
	                  							</div>
						          			</div>
						                </div>

						                <!-- keterangan -->
	          							<div class="form-group">
	          								<label for="fKet">Keterangan</label>
	          								<textarea class="form-control" rows="2" placeholder="Masukkan Keterangan" id="fKetn" name="fKet"></textarea>
	          							</div>
	              					</fieldset>
	    						</div>

	    						<!-- data harga -->
	    						<div class="col-md-6">
	    							<fieldset>
	          							<legend>Data Harga</legend>
	          							<!-- HPP -->
	          							<div class="form-group">
	          								<label for="fHpp">HPP</label>
          									<div class="input-group">
          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
          										<input class="form-control" placeholder="Masukkan HPP" id="fHpp" name="fHpp">
          										<span class="input-group-addon">,00</span>
          									</div>		
	          							</div>

	          							<!-- Harga Pasar -->
	          							<div class="form-group">
	          								<label for="fHarga_pasar">Harga Pasar</label>
      										<div class="input-group">
          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
      											<input class="form-control" placeholder="Masukkan Harga Pasar" id="fHarga_pasar" name="fHarga_pasar">
      											<span class="input-group-addon">,00</span>
      										</div>
	          							</div>

	          							<!-- market place -->
	          							<div class="form-group">
      										<label for="fHarga_market">Harga Market Place</label>
      										<div class="input-group">
          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
      											<input class="form-control" placeholder="Masukkan Harga Market Place" id="fHarga_market" name="fHarga_market">
      											<span class="input-group-addon">,00</span>
      										</div>
	          							</div>

	          							<!-- harga ig -->
	          							<div class="form-group">
	          								<label for="fHarga_ig">Harga IG</label>
      										<div class="input-group">
          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">Rp. </span>
      											<input class="form-control" placeholder="Masukkan Harga IG" id="fHarga_ig" name="fHarga_ig">
      											<span class="input-group-addon">,00</span>
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
        </script>
		<script type="text/javascript">
			//setting datatable
			$(document).ready(function(){
				$(".select2").select2();

				setSelect("id_barang", $("#fId_barang"));
				setSelect("id_warna", $("#fId_warna"));

				// id_barang dan id_warna
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

					// submit form modal tambah id barang
				    $("#form_modal_idBarang").submit(function(e){
				        e.preventDefault();

				        var id = $("#id_barang").val().trim();
				        var id_barang = $("#fmId_barang").val().trim();
				        var nama = $("#fmNama_idBarang").val().trim();
				        var submit = $("#btn_submit_idBarang").val();

				        // request action
				        $.ajax({
				            url: base_url+"module/id_barang/action.php",
				            type: "post",
				            dataType: "json",
				            data: {
				                "id" : id,
				                "fmId_barang" : id_barang,
				                "fmNama_idBarang" : nama,
				                "action" : submit,
				            },
				            success: function(hasil){

				                // cek hasil dari ajax
				                // cek statusnya
				                if(hasil.status){ // jika status true
				                    reset_form("#form_modal_idBarang"); 
				                    $("#modal_idBarang").modal('hide');
				                    // cek jenis actionya
				                    alertify.success('Data Id Barang Berhasil Ditambah'); // jika tambah
				                    setSelect("id_barang", $("#fId_barang")); // reload select
				                }
				                else{ // jika status false
				                    // cek jenis error
				                    if(hasil.errorDb){ // jika ada error database
				                        swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
				                        reset_form("#form_modal_idBarang");
				                        $("#form_modal_idBarang").modal('hide');
				                    }
				                    else{
				                        reset_form("#form_modal_idBarang");
				                        // cek apakah duplikat
				                        if(hasil.duplikat){ // jika duplikat
				                            $("#fmId_barang").parent().find('.help-block').text("Id Barang Sudah Ada, Harap Ganti Dengan Yang Lainnya !");
				                            $("#fmId_barang").closest('div').addClass('has-error');
				                        }
				                        else{
				                            // set error fmId_barang
				                            // jika ada pesan error
				                            if(!jQuery.isEmptyObject(hasil.pesanError.id_barangError)){
				                                $("#fmId_barang").parent().find('.help-block').text(hasil.pesanError.id_barangError);
				                                $("#fmId_barang").closest('div').addClass('has-error');
				                            }
				                            else{
				                                $("#fmId_barang").parent().find('.help-block').text("");
				                                $("#fmId_barang").closest('div').removeClass('has-error');
				                            }
				                            
				                            // set error fmNama_idBarang
				                            // jika ada pesan error
				                            if(!jQuery.isEmptyObject(hasil.pesanError.namaBarangError)){
				                                $("#fmNama_idBarang").parent().find('.help-block').text(hasil.pesanError.namaBarangError);
				                                $("#fmNama_idBarang").closest('div').addClass('has-error');
				                            }
				                            else{
				                                $("#fmNama_idBarang").parent().find('.help-block').text("");
				                                $("#fmNama_idBarang").closest('div').removeClass('has-error');
				                            }   
				                            
				                        }
				                        // set value
				                        $("#fmId_barang").val(hasil.set_value.id_barang);
				                        $("#fmNama_idBarang").val(hasil.set_value.namaBarang);

				                    }   
				                }

				                console.log(hasil);
				            },
				            error: function (jqXHR, textStatus, errorThrown) // error handling
				            {
				                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
				                $("#modal_idBarang").modal('hide');
				                reset_form("#form_modal_idBarang");
				                console.log(jqXHR, textStatus, errorThrown);
				            }
				        })

				        return false;
				    });

					// submit form modal tambah id barang
				    $("#form_modal_idWarna").submit(function(e){
				        e.preventDefault();

				        var id = $("#id_warna").val().trim();
				        var id_warna = $("#fmId_warna").val().trim();
				        var nama = $("#fmNama_idWarna").val().trim();
				        var submit = $("#submit_idWarna").val();

				       // request action
				        $.ajax({
				            url: base_url+"module/id_warna/action.php",
				            type: "post",
				            dataType: "json",
				            data: {
				                "id" : id,
				                "fmId_warna" : id_warna,
				                "fmNama_idWarna" : nama,
				                "action" : submit,
				            },
				            success: function(hasil){

				                // cek hasil dari ajax
				                // cek statusnya
				                if(hasil.status){ // jika status true
				                    reset_form("#form_modal_idWarna");
				                    $("#modal_idWarna").modal('hide');
				                    // cek jenis actionya
				                    alertify.success('Data Id Warna Berhasil Ditambah'); // jika tambah
				                    setSelect("id_warna", $("#fId_warna")); // reload select
				                }
				                else{ // jika status false
				                    // cek jenis error
				                    if(hasil.errorDb){ // jika ada error database
				                        swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
				                        setSelect("id_warna", $("#fId_warna"));
				                        $("#form_modal_idWarna").modal('hide');
				                    }
				                    else{
				                        setSelect("id_warna", $("#fId_warna"));
				                        // cek apakah duplikat
				                        if(hasil.duplikat){ // jika duplikat
				                            $("#fmId_warna").parent().find('.help-block').text("Id Warna Sudah Ada, Harap Ganti Dengan Yang Lainnya !");
				                            $("#fmId_warna").closest('div').addClass('has-error');
				                        }
				                        else{
				                            // set error fId_barang
				                            // jika ada pesan error
				                            if(!jQuery.isEmptyObject(hasil.pesanError.id_warnaError)){
				                                $("#fmId_warna").parent().find('.help-block').text(hasil.pesanError.id_warnaError);
				                                $("#fmId_warna").closest('div').addClass('has-error');
				                            }
				                            else{
				                                $("#fmId_warna").parent().find('.help-block').text("");
				                                $("#fmId_warna").closest('div').removeClass('has-error');
				                            }
				                            
				                            // set error fNama_idBarang
				                            // jika ada pesan error
				                            if(!jQuery.isEmptyObject(hasil.pesanError.namaWarnaError)){
				                                $("#fmNama_idWarna").parent().find('.help-block').text(hasil.pesanError.namaWarnaError);
				                                $("#fmNama_idWarna").closest('div').addClass('has-error');
				                            }
				                            else{
				                                $("#fmNama_idWarna").parent().find('.help-block').text("");
				                                $("#fmNama_idWarna").closest('div').removeClass('has-error');
				                            }   
				                            
				                        }
				                        // set value
				                        $("#fmId_warna").val(hasil.set_value.id_warna);
				                        $("#fmNama_idWarna").val(hasil.set_value.namaWarna);

				                    }   
				                }

				                console.log(hasil);
				            },
				            error: function (jqXHR, textStatus, errorThrown) // error handling
				            {
				                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
				                $("#modal_idWarna").modal('hide');
				                reset_form("#form_modal_idWarna");
				                console.log(jqXHR, textStatus, errorThrown);
				            }
				        })

				        return false;
				    });
				// ================================================== //
					
				// onchange id barang
				$("#fId_barang").change(function(){
					setBarang();
				});
				// onchange id warna
				$("#fId_warna").change(function(){
					setBarang();
				});

				// onchange foto
				$("#fFoto").change(function(){
					$("#fFoto_text").val(this.value);
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

			function setBarang(){
				var text_idBarang = $("#fId_barang :selected").text();
				var text_idWarna = $("#fId_warna :selected").text();
				
				var split_idBarang = text_idBarang.split('-');
				var split_idWarna = text_idWarna.split('-');

				if($("#fId_barang :selected").val() !== "" && $("#fId_warna :selected").val() !== ""){
					// console.log("kosong");
					$("#fKd_barang").val(split_idBarang[0].trim()+"-"+split_idWarna[0].trim());
					$("#fNama_barang").val(split_idBarang[1].trim()+" "+split_idWarna[1].trim());
					console.log("gk kosong");
				}
				// else{
				// 	$("#fKd_barang").val(split_idBarang[0].trim()+"-"+split_idWarna[0].trim());
				// 	console.log("gk kosong");
				// }
			}

			function reset_form(form){

			    // reset pesan error
			    if(form === "#form_barang"){

			    }
			    else if(form === "#form_modal_idBarang"){
			    	$("#fmId_barang").parent().find('.help-block').text("");
				    $("#fmId_barang").closest('div').removeClass('has-error');
				    $("#fmNama_idBarang").parent().find('.help-block').text("");
				    $("#fmNama_idBarang").closest('div').removeClass('has-error');
				  	// $('#form_modal_idBarang').trigger('reset');

			    }
			    else if(form === "#form_modal_idWarna"){
			    	$("#fmId_warna").parent().find('.help-block').text("");
				    $("#fmId_warna").closest('div').removeClass('has-error');
				    $("#fmNama_idWarna").parent().find('.help-block').text("");
				    $("#fmNama_idWarna").closest('div').removeClass('has-error');
				    // $("#form_modal_idWarna").trigger('reset');
			    }
				
			    // bersihkan form
			    $(form).trigger('reset');
			}


		</script>
    <!-- -->