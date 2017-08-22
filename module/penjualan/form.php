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
	                        				</select>
	                        			</div>

	                        			<!-- status transaksi -->
	                        			<div class="form-group">
	                        				<label for="fStatus">Status Transaksi</label>
	                        				<select id="fStatus" name="fStatus" class="form-control">
	                        				</select>
	                        			</div>

	                        			<!-- kode barang - qty - tambah-->
	                        			<div class="form-group">
	                        				<div class="row">
	                        					<div class="col-md-8 col-xs-6">
	                        						<label for="fKd_barang">Item</label>
			                        				<select id="fKd_barang" name="fKd_barang" class="form-control select2" style="width: 100%;">
			                        				</select>
	                        					</div>
	                        					<div class="col-md-4 col-xs-6">
	                        						<label for="fQty">Qty</label>
	                        						<div class="input-group">
				                        				<input type="number" id="fQty" name="fQty" class="form-control" min="0" placeholder="Masukkan Qty">
				                        				<span class="input-group-addon">pcs</span>
			                        				</div>
	                        					</div>
	                        				</div>
	                        			</div>

	                        			<!-- diskon -->
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
				                        				<input type="number" id="fDiskon" name="fDiskon" class="form-control" min="0" placeholder="Masukkan Dsikon">
				                        				<span class="input-group-btn">
				                        					<button class="btn bg-maroon btn-flat"><i class="fa fa-plus"></i></button>
				                        				</span>
			                        				</div>
	                        					</div>
	                        				</div>
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
			                        					<table id="tabel_item_penjualan" class="table table-bordered table-hover">
					                        				<thead>
					                        					<tr>
					                        						<th style="width: 15px">No</th>
					                        						<th>Item</th>
					                        						<th>Harga</th>
					                        						<th>Qty</th>
					                        						<th>Diskon</th>
					                        						<th>Keterangan</th>
					                        						<th>Aksi</th>
					                        					</tr>
					                        				</thead>
					                        				<tbody></tbody>
					                        			</table>
			                        				</div>
			                        				<div class="col-md-12" id="tampilHarga">
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

				var listItem = [];

				$('#fTgl').val(getTanggal); // set field tanggal
				setKdPenjualan($('#fKd_penjualan')); // set kd_penjualan
				setSelect($('#fKd_barang'));
				setJenisTransaksi();
				setJenisDiskon();
				setStatusTransaksi();

				// onchange jenis transaksi
				$("#fJenis").change(function(){
					if(this.value === "") setDataPembeli(false);
					else if((this.value.toLowerCase() != "harga pasar") && (this.value.toLowerCase() != "reseller"))
						setDataPembeli();
					else setDataPembeli(false);
				});

				// on change status transaksi
				$("#fStatus").change(function(){
					if(this.value === "1"){ // normal
						// set jenis diskon jadi persen
						$("#fJenisDiskon").val("persen");
						$("#fJenisDiskon").prop("disabled",false);
						// set diskon jadi 100
						$("#fDiskon").val("");
						$("#fDiskon").prop("readonly",false);
					}
					else{ // free
						// set jenis diskon jadi persen
						$("#fJenisDiskon").val("persen");
						$("#fJenisDiskon").prop("disabled",true);
						// set diskon jadi 100
						$("#fDiskon").val("100");
						$("#fDiskon").prop("readonly",true);
					}
				});

				// on change jenis diskon
				$("#fJenisDiskon").change(function(){
					if(this.value === "r"){
						$("#fDiskon").parent().find('span')[0].innerHTML = 'Rp.';
		    			$("#fDiskon").removeAttr("max");
		    			$("#fDiskon").val("");
					}
					else{
						$("#fDiskon").parent().find('span')[0].innerHTML = '%';
		    			$("#fDiskon").prop("max", "100");
		    			$("#fDiskon").val("");
					}
				});

				// on click tambah list item
				$("#fTambah_barang").click(function(){
					// var komponen = [];
					var item_text = $("#fKd_barang option:selected").text();
					var item_val = $("#fKd_barang").val(); // id barang

					// cek jika value option barang masih default set text kosong
			        if(item_val.length <= 0){
			            item_text = "";
			        }

			        var qty = $("#fQty").val().trim();
			        var diskon = $("#fDiskon").val().trim();
			        // var harga = 10000;

			        var dataItem = {
			        	kd_barang : item_val,
			        	qty : qty,
			        	diskon : diskon,
			        };

			        $.ajax({
			        	url : base_url+"module/penjualan/action.php",
			        	type : "post",
			        	dataType : "json",
			        	data : {
			        		"dataItem" : dataItem,
			        		"action" : 'addList',
			        	},
			        	success: function(hasil){
			        		if(hasil.status){
			        			$("#tabel_item_penjualan > tbody:last-child").append(
						        	'<tr id="baris">'+
			                            '<td></td>'+
			                            '<td><div style="display: none;">'+item_val+'</div>'+item_text+'</td>'+
			                            '<td>Rp. '+hasil.harga.harga_pasar+'</td>'+
			                            '<td>'+fieldQty(qty)+'</td>'+
			                            '<td>'+fieldDiskon(diskon)+'</td>'+
			                            '<td>'+fieldKeterangan()+'</td>'+
			                            '<td>'+
			                                '<button type="button" class="btn btn-danger btn-sm" onclick="delList()" title="Hapus dari list">'+
			                                    '<i class="fa fa-trash">'+
			                                '</button>'+
			                            '</td>'+
			                        '</tr>'
						        );
			        		}
			        		else{
			        			// jika ada pesan error
			                    if(!jQuery.isEmptyObject(hasil.pesanError.kd_barangError)){
			                        alertify.error(hasil.pesanError.kd_barangError);
			                    } else if(!jQuery.isEmptyObject(hasil.pesanError.qtyError)){
			                        alertify.error(hasil.pesanError.qtyError);
			                    } else if(!jQuery.isEmptyObject(hasil.pesanError.diskonError)){
			                        alertify.error(hasil.pesanError.diskonError);
			                    }
			        		}
			        	},
			        	error: function (jqXHR, textStatus, errorThrown) // error handling
			            {
			                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
			                // clearBarang();
			                console.log(jqXHR, textStatus, errorThrown);
			            } 
			        })


			        

			        // listItem.push(dataItem);
			        // console.log(listItem);

			        
			        // numberingList();
				});


			});

			// fungsi nomor di tabel
			// function numberingList(){
			// 	// variabel untuk menhitung total barang
		 //        var total = 0;
		 //        var hrg = 0;
		 //        // var qty =

		 //        $('#tabel_item_penjualan tbody tr').each(function (index) {
		 //            $(this).children("td:eq(0)").html(index + 1);

		 //            // operasi untuk menghitung total
		 //            hrg = $(this).children("td:eq(2)").html().substr(4);
		 //            qty = $(this).children("td:eq(3)").html();
		 //            total += parseFloat(hrg)*parseInt(qty);
		 //        });
		        
		 //        // menampilkan total
		 //        $('#tampilHarga').children().html('Total: Rp. '+total+',00');
			// }

			// fungsi cetak field qty di tabel
			function fieldQty(qty){
				var field = '<input type="number" min="0" id="qtyList" style="width: 5em" class="form-control input-sm" value="'+qty+'">';
        		return field;
			}

			// fungsi cetak field keterangan di tabel
			function fieldKeterangan(){
		        var field = '<textarea id="ketList" class="form-control input-sm" row="2"></textarea>';
		        return field;
		    }

		    function fieldDiskon(diskon){
		    	var field = '<input type="number" min="0" max="100" id="diskonList" style="width: 5em" class="form-control input-sm" value="'+diskon+'">';
		        return field;
		    }

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
		            },error: function (jqXHR, textStatus, errorThrown){ // error handling
		                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
		                console.log(jqXHR, textStatus, errorThrown);
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
		                	if(parseInt(item.stok) <= 0) disabled = true; 
		                	else disabled = false;

		                    idSelect.append($("<option>", {
		                        value: item.id,
		                        text: item.nama+' - STOK: '+item.stok,
		                        disabled: disabled,
		                    }));                 
		                });
		                console.log(data);
		            },
		            error: function (jqXHR, textStatus, errorThrown) // error handling
		            {
		                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
		                console.log(jqXHR, textStatus, errorThrown);
		            }
		        })
		    } 

		    // fungsi set jenis transaksi
		    function setJenisTransaksi(){
		    	var arrayJenis = [
		    		{value: "", text: "-- Pilih Jenis Transaksi --"},
		    		{value: "HARGA PASAR", text: "PASAR"},
		    		{value: "MARKET PLACE", text: "MARKET PLACE"},
		    		{value: "HARGA IG", text: "INSTAGRAM"},
		    		{value: "RESELLER", text: "RESELLER"},
		    	];

		    	$.each(arrayJenis, function(index, item){
		    		var option = new Option(item.text, item.value);
		    		$("#fJenis").append(option);
		    	});

		    	setDataPembeli(false);
		    }

		    // fungsi set jenis diskon
		    function setJenisDiskon(){
		    	var arrayJenis = [
		    		// {value: "", text: "-- Pilih Jenis Diskon --"},
		    		{value: "r", text: "RUPIAH"},
		    		{value: "p", text: "PERSEN"},
		    	];

		    	$.each(arrayJenis, function(index, item){
		    		var option = new Option(item.text, item.value);
		    		$("#fJenisDiskon").append(option);
		    	});

		    	$("#fJenisDiskon").val("persen");
		    	$("#fDiskon").parent().find('span')[0].innerHTML = '%';
		    	$("#fDiskon").prop("max", "100");
		    }

		    // fungsi set status transaksi
		    function setStatusTransaksi(){
		    	var arrayStatus = [
		    		// {value: "", text: "-- Pilih Status Transaksi --"},
		    		{value: "1", text: "NORMAL"},
		    		{value: "0", text: "FREE"},
		    	];

		    	$.each(arrayStatus, function(index, item){
		    		var option = new Option(item.text, item.value);
		    		$("#fStatus").append(option);
		    	});

		    	$("#fStatus").val("1");
		    }

		    function setDataPembeli(jenis=true){
		    	if(jenis){
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