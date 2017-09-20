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
  		<h1>Admin</h1>
  		<ol class="breadcrumb">
    		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
    		<li>Admin</li>
    		<li><a href="<?= base_url."index.php?m=admin&p=list" ?>">Data Admin</a></li>
    		<li><i class="active"></i>Form Data Admin</a></li>
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
                                <h3 class="box-title">Form Data Admin</h3>
                            </div>
                        </div>
    				</div>
    				<form id="form_admin" role="form" enctype="multipart/form-data">
    					<input type="hidden" name="id" id="id">
	    				<!-- isi panel box -->
	    				<div class="box-body">
	    					<!-- fieldset data admin -->
	    					<div class="row">
	    						<!-- data admin -->
	    						<div class="col-md-6">
	    							<fieldset>
	          							<legend>Data Admin</legend>
	          							<!-- username -->
	          							<div class="form-group field-username">
	          								<label for="fUsername">Username</label>
	          								<div class="input-group">
								                <span class="input-group-addon">
								                	<i class="fa fa-user"></i>
								                </span>
								                <input type="text" class="form-control" placeholder="Username" id="fUsername" name="fUsername">
              								</div>
              								<span class="help-block small"></span>
	          							</div>
	          							
	          							<!-- password -->
	          							<div class="form-group field-password">
	          								<label for="fPass">Password</label>
	          								<div class="input-group">
								                <span class="input-group-addon">
								                	<i class="fa fa-key"></i>
								                </span>
								                <input type="password" class="form-control" placeholder="Password" id="fPass" name="fPass">
              								</div>
              								<span class="help-block small"></span>
	          							</div>

	          							<!-- confirm password -->
	          							<div class="form-group field-confirm">
	          								<label for="fConf_pass">Confirm Password</label>
	          								<div class="input-group">
								                <span class="input-group-addon">
								                	<i class="fa fa-lock"></i>
								                </span>
								                <input type="password" class="form-control" placeholder="Confirm Password" id="fConf_pass" name="fConf_pass">
              								</div>
              								<span class="help-block small"></span>
	          							</div>

	          							<!-- email -->
	          							<div class="form-group field-email">
	          								<label for="fEmail">Email</label>
	          								<div class="input-group">
								                <span class="input-group-addon">
								                	<i class="fa fa-envelope"></i>
								                </span>
								                <input type="text" class="form-control" placeholder="Email" id="fEmail" name="fEmail">
              								</div>
              								<span class="help-block small"></span>
	          							</div>

	          							<!-- level -->
	                        			<div class="form-group field-level">
	                        				<label for="fLevl">Level</label>
	                        				<select id="fLevel" name="fLevel" class="form-control">
	                        				</select>
	                        				<span class="help-block small"></span>
	                        			</div>
	              					</fieldset>
	    						</div>

	    						<!-- data diri -->
	    						<div class="col-md-6">
	    							<fieldset>
	          							<legend>Data Pribadi</legend>
	          							<!-- nama -->
	          							<div class="form-group field-nama">
      										<label for="fNama">Nama</label>
	          								<input type="text" class="form-control" placeholder="Nama" id="fNama" name="fNama">
	          								<span class="help-block small"></span>	
	          							</div>

	          							<!-- no telp -->
	          							<div class="form-group filed-telp">
	          								<label for="fTelp">No. Telepon</label>
	          								<div class="input-group">
								                <div class="input-group-addon">
								                    <i class="fa fa-phone"></i>
								                </div>
								                <input type="text" class="form-control" data-inputmask='"mask": "9999-9999-9999"' data-mask id="fTelp" name="fTelp">
								                <span class="help-block small"></span>
                							</div>
	          							</div>

	          							<!-- Alamat -->
	          							<div class="form-group field-alamat">
	          								<label for="fAlamat">Alamat</label>
	          								<textarea class="form-control" rows="2" placeholder="Alamat" id="fAlamat" name="fAlamat"></textarea>
	          								<span class="help-block small"></span>
	          							</div>
	          							

	          							<!-- foto -->
						          		<div class="form-group field-foto">
						          			<!-- preview foto -->
						          			<label for="fFoto">Foto</label>
						          			<div class="input-group image-preview">
								                <input type="text" id="fFoto_text" class="form-control image-preview-filename" disabled="disabled">
								                <span class="input-group-btn">
								                    <!-- image-preview-clear button -->
								                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
								                        <span class="glyphicon glyphicon-remove"></span> Hapus
								                    </button>
								                    <!-- image-preview-input -->
								                    <div class="btn btn-danger image-preview-input">
								                        <span class="glyphicon glyphicon-folder-open"></span>
								                        <span class="image-preview-input-title">Pilih Foto</span>
								                        <input type="file" accept="image/png, image/jpeg, image/gif" name="fFoto" id="fFoto" />
								                    </div>
								                </span>
								            </div>
								            <span class="help-block small"></span>
						                </div>
	              					</fieldset>
	    						</div>					
	    					</div>	
	    				</div>

	    				<!-- footer -->
		    			<div class="box-footer text-right">
		    				<div class="form-group">
		    					<button type="submit" class="btn btn-default btn-lg" id="btn_submit_admin" name="action" value="<?= $btn ?>"><i class="fa fa-plus"></i> <?= ucfirst($btn); ?></button>
								<a href="<?=base_url."index.php?m=barang&p=list" ?>" class="btn btn-default btn-lg"><i class="fa fa-reply"></i>  Batal</a>
		    				</div>
						</div>
					</form>		
    			</div>
    		</div>
    	</div>	
	</section>

	<script type="text/javascript">
        var base_url = "<?php print base_url; ?>";
        var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;
	</script>

	<script type="text/javascript">
	$(document).ready(function(){
		setLevel();
		// onchange foto
			$(document).on('click', '#close-preview', function(){ 
			    $('.image-preview').popover('hide');
			    // Hover befor close the preview
			    $('.image-preview').hover(
			        function () {
			           $('.image-preview').popover('show');
			        }, 
			         function () {
			           $('.image-preview').popover('hide');
			        }
			    );    
			});

			// Create the close button
		    var closebtn = $('<button/>', {
		        type:"button",
		        text: 'x',
		        id: 'close-preview',
		        style: 'font-size: initial;',
		    });
		    closebtn.attr("class","close pull-right");
		    // Set the popover default content
		    $('.image-preview').popover({
		        trigger:'manual',
		        html:true,
		        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
		        content: "Tidak Ada Foto",
		        placement:'bottom'
		    });
		    // Clear event
		    $('.image-preview-clear').click(function(){
		        $('.image-preview').attr("data-content","").popover('hide');
		        $('.image-preview-filename').val("");
		        $('.image-preview-clear').hide();
		        $('.image-preview-input input:file').val("");
		        $(".image-preview-input-title").text("Pilih Foto"); 
		    }); 
		    // Create the preview image
		    $("#fFoto").change(function (){
		        var img = $('<img/>', {
		            id: 'dynamic',
		            width:250,
		            height:200
		        });      
		        var file = this.files[0];
		        var reader = new FileReader();
		        // Set preview image into the popover data-content
		        reader.onload = function (e) {
		            $(".image-preview-input-title").text("Ganti");
		            $(".image-preview-clear").show();
		            $("#fFoto_text").val(file.name);            
		            img.attr('src', e.target.result);
		            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
		        }        
		        reader.readAsDataURL(file);
		    });
		// =================================================

		// submit barang
		$("#form_admin").submit(function(e){
			e.preventDefault();
			submitAdmin();

			return false;
		})
	});

	function getDataForm(){
		var data = new FormData();

		data.append('username', $("#fUsername").val().trim()); // data id barang
		data.append('password', $("#fPass").val().trim()); // data id warna
		data.append('confirm', $("#fConf_pass").val().trim()); // data kd barang
		data.append('email', $("#fEmail").val().trim()); // data nama
		data.append('level', $("#fLevel").val().trim());
		data.append('nama', $("#fNama").val().trim());
		data.append('telp', $("#fTelp").val().trim());
		data.append('alamat', $("#fAlamat").val().trim());
		data.append('foto', $("#fFoto")[0].files[0]); // data foto
		data.append('action', $("#btn_submit_admin").val().trim());
		
		return data;
	}

	function submitAdmin(){
		var data = getDataForm();

		$.ajax({
			url : base_url+"app/controllers/Admin.php",
			type : "post",
			dataType : "json",
			data: data,
			contentType: false,
		    cache: false,
			processData: false,
			success: function(hasil){
				if(hasil.status){
					document.location=base_url+"index.php?m=admin&p=list";
				}
				else{
					if(hasil.errorDb){ // jika db error
						swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
	                    reset_form("#form_barang");
					}
					else{
						if(hasil.duplikat){
							swal("Pesan Error", "Username Tidak Tersedia","error");
						}
						else{
							// set error
						}
						// set value

					}	
				}

				console.log(hasil);
			},
			error: function (jqXHR, textStatus, errorThrown){ // error handling
	            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
	            // reset_form("#form_barang");
	            console.log(jqXHR, textStatus, errorThrown);
	        }
		})
	}

	function setLevel(){
		var arrayJenis = [
			{value: "", text: "-- Level Admin --"},
			{value: "ADMIN",text: "ADMIN"},
			{value: "KASIR",text: "KASIR"},
		];
		
		$.each(arrayJenis, function(index, item){
			var option = new Option(item.text, item.value);
			$("#fLevel").append(option);
		});
	}

</script>

