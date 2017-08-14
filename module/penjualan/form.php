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
                        			<div class="row" id="dataPembeli">
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
            var base_url = "<?php print base_url; ?>";
            var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;
        </script>
		<script type="text/javascript">
			$(document).ready(function(){
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

				$('#fTgl').val(getTanggal); // set field tanggal
				setKdPenjualan($('#fKd_penjualan')); // set kd_penjualan
				setSelect($('#fKd_barang'));
				setJenisTransaksi();
				setStatusTransaksi();

				// onchange jenis transaksi
				$("#fJenis").change(function(){
					if($("#fJenis").val().toLowerCase() == "online"){
						setDataPembeli();
					}
					else setDataPembeli(true);
				});

			});

			// fungsi set kode pembelian (bug kode > 10)
		    function setKdPenjualan(idSelect){
		    	$("#fKd_penjualan").prop("readonly", true);
		        $.ajax({
		            url: base_url+"module/penjualan/action.php",
		            type: "post",
		            dataType: "json",
		            data: {
		                "action" : "getKdPenjualan",
		            },
		            success: function(data){
		                var tanggal = getTanggal().replace(/-/g,"");

		                // cek apakah ada kode pembelian pada hari ini
		                if(!data[0]){
		                    idSelect.val('PB-'+tanggal+'-1'); 
		                }else{
		                    iterasi = data[0].kd_penjualan.split("-");
		                    count = parseInt(iterasi[2]) + 1;
		                    idSelect.val('PB-'+tanggal+'-'+count.toString());
		                }
		            },
		            error: function (jqXHR, textStatus, errorThrown) // error handling
		            {
		                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
		                console.log(jqXHR, textStatus, errorThrown);
		                // location.reload();
		            }
		        })
		    }

		    // funsgi set isi select id_barang dan qty
		    function setSelect(idSelect){
		        // reset ulang select
		        
		        idSelect.find('option')
		            .remove()
		            .end()
		            .append($('<option>',{
		                value: "", 
		                text: "-- Pilih Barang --"
		            }));

		        $.ajax({
		            url: base_url+"module/penjualan/action.php",
		            type: "post",
		            dataType: "json",
		            data: {
		                "action" : "getSelect",
		            },
		            success: function(data){
		            	var disabled = false;
		                $.each(data, function(index, item){
		                	if(parseInt(item.stok) < 0) disabled = true; 
		                	else disabled = false;

		                    idSelect.append($("<option>", {
		                        value: item.id,
		                        text: item.nama+' - STOK: '+item.stok,
		                        disabled: disabled,
		                    }));

		                    // if(parseInt()){

		                    // }                    
		                });
		                console.log(data);
		            },
		            error: function (jqXHR, textStatus, errorThrown) // error handling
		            {
		                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
		                console.log(jqXHR, textStatus, errorThrown);
		                // location.reload();
		            }
		        })
		    } 

		    // fungsi set jenis transaksi
		    function setJenisTransaksi(){
		    	var arrayJenis = ['OFFLINE', 'ONLINE', 'ECER', 'RESELLER'];

		    	$("#fJenis").find('option')
		            .remove()
		            .end()
		            .append($('<option>',{
		                value: "", 
		                text: "-- Pilih Jenis Transaksi --"
		            }));

		    	$.each(arrayJenis, function(index, item){
		    		$("#fJenis").append($("<option>", {
                        value: item,
                        text: item,
                    }));
		    	});

		    	$("#dataPembeli").css("display", "none");
		    }

		    function setDataPembeli(jenis=false){
		    	if(!jenis){
		    		$("#dataPembeli").css("display", "block");
					$("#fNama").val("");
					$("#fno_telepon").val("");
					$("#fAlamat").val("");
					$("#fNama").prop("disabled", false);
					$("#fno_telepon").prop("disabled", false);
					$("#fAlamat").prop("disabled", false);
		    	}
		    	else{
		    		$("#dataPembeli").css("display", "none");
		    		$("#fNama").val("");
		    		$("#fNama").prop("disabled", true);
					$("#fno_telepon").val("");
					$("#fno_telepon").prop("disabled", true);
					$("#fAlamat").val("");
					$("#fAlamat").prop("disabled", true);
		    	} 	
		    }

		    function setStatusTransaksi(){
		    	var arrayJenis = {1 : "NORMAL", 0 : "FREE"};

		    	$("#fStatus").find('option')
		            .remove()
		            .end()
		            .append($('<option>',{
		                value: "", 
		                text: "-- Pilih Jenis Transaksi --"
		            }));

		    	$.each(arrayJenis, function(index, item){
		    		$("#fStatus").append($("<option>", {
                        value: index,
                        text: item,
                    }));
		    	});

		    	$("#fStatus").val("1");
		    }

		    // mendapatkan tanggal hari ini
		    function getTanggal(){

		        var d = new Date();
		        var month = '' + (d.getMonth() + 1);
		        var day = '' + d.getDate();
		        var year = d.getFullYear();

		        if (month.length < 2) month = '0' + month;
		        if (day.length < 2) day = '0' + day;

		        return [year, month, day].join('-');
		    }

		</script>
    <!-- -->