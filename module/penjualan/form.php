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
		<script type="text/javascript">
			$(document).ready(function(){
				var cekEdit = false;

				if(!jQuery.isEmptyObject(urlParams.id)){ // jika ada parameter get
					// edit_barang(urlParams.id);
					cekEdit = true;
				}

				console.log(cekEdit);

				//Initialize Select2 Elements
	    		$(".select2").select2();
	    		$("#fKd_penjualan").prop("readonly", true);

	    		//setting datepicker
				$(".datepicker").datepicker({
					autoclose: true,
			        format: "yyyy-mm-dd",
			        todayHighlight: true,
			        orientation: "bottom auto",
			        todayBtn: true,
			        todayHighlight: true,
				});

				 // set field tanggal
				$('#fQty').val(0);
				 // set kd_penjualan
				setSelect($('#fKd_barang'));
				setJenisTransaksi();
				setStatusTransaksi();
				setJenisDiskon();

				if(cekEdit) edit_penjualan(urlParams.id);
				else{
					setKdPenjualan($('#fKd_penjualan'));
					$('#fTgl').datepicker('update',getTanggal());
				}

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
						$("#fJenisDiskon").val("p");
						$("#fJenisDiskon").prop("disabled",false);
						// set diskon jadi 0
						$("#fDiskon").val(0);
						$("#fDiskon").prop("readonly",false);
					}
					else{ // free
						// set jenis diskon jadi persen
						$("#fJenisDiskon").val("p");
						$("#fJenisDiskon").prop("disabled",true);
						// set diskon jadi 100
						$("#fDiskon").val(100);
						$("#fDiskon").prop("readonly",true);
					}
				});

				// on change jenis diskon
				$("#fJenisDiskon").change(function(){
					if(this.value === "r"){
						$("#fDiskon").parent().find('span')[0].innerHTML = 'Rp.';
		    			$("#fDiskon").removeAttr("max");
					}
					else{
						$("#fDiskon").parent().find('span')[0].innerHTML = '%';
		    			$("#fDiskon").prop("max", "100");
					}
					$("#fDiskon").val(0);
				});

				// on click tambah item
				$("#btn_tambahItem").click(function(){
					var index = indexItem++;
					var item_text = $("#fKd_barang option:selected").text().trim();
					var item_val = $("#fKd_barang").val().trim();
					var qty = parseInt($("#fQty").val());
					var jenisDiskon = $("#fJenisDiskon").val().trim();
					var diskon = parseInt($("#fDiskon").val());
					var dataItem = {
						aksi: "tambah", status: "", index: index, id: "",
						nama: item_text, kd_barang: item_val, qty: qty,
						hpp: "", harga: "", jenisDiskon: jenisDiskon,
						diskon: diskon, subTotal: "", ket: "",
					};

					// validasi sebelum push ke array list
					$.ajax({
						url: base_url+"module/penjualan/action.php",
						type: "post",
						dataType: "json",
						data:{
							"data": dataItem,
							"jenis": $("#fJenis").val().trim(),
							"action": "addList",
						},
						success: function(hasil){
							console.log(hasil);
							if(hasil.status){
								// var harga = "";
								if($("#fJenis").val().toLowerCase() == "harga pasar")
									var harga = parseInt(hasil.harga.harga_pasar);
								else if($("#fJenis").val().toLowerCase() == "market place")
									var harga = parseInt(hasil.harga.market_place);
								else if($("#fJenis").val().toLowerCase() == "harga ig")
									var harga = parseInt(hasil.harga.harga_ig);
								else if($("#fJenis").val().toLowerCase() == "reseller")
									var harga = parseInt(hasil.harga.harga_pasar);

								var subTotal = hitungSubtotal(harga,qty,jenisDiskon,diskon);
								dataItem.harga = harga;
								dataItem.hpp = parseInt(hasil.harga.hpp);
								dataItem.subTotal = subTotal;

								listItem.push(dataItem);
								$("#tabel_item_penjualan > tbody:last-child").append(
									"<tr>"+
									"<td></td>"+ // nomor
									"<td>"+item_text+"</td>"+ // item
									"<td>Rp. "+harga+",00</td>"+ // harga
									"<td>"+fieldQty(qty, index)+"</td>"+ // qty
									"<td>"+fieldDiskon(jenisDiskon, diskon, index, $("#fStatus").val())+"</td>"+ // diskon
									"<td>"+fieldKeterangan(index)+"</td>"+ // keterangan
									"<td>Rp. "+subTotal+",00</td>"+
									"<td>"+btnAksi(index)+"</td>"+ // aksi
									"</tr>"
								);
								numberingList();
								clearBarang();
							}
							else{
								// kurangi index
								indexItem -= 1;
								if(!jQuery.isEmptyObject(hasil.pesanError.jenisError))
									alertify.error(hasil.pesanError.jenisError);
								else if(!jQuery.isEmptyObject(hasil.pesanError.kd_barangError))
									alertify.error(hasil.pesanError.kd_barangError);
			                    else if(!jQuery.isEmptyObject(hasil.pesanError.qtyError))
			                    	alertify.error(hasil.pesanError.qtyError);
			                    else if(!jQuery.isEmptyObject(hasil.pesanError.diskonError))
			                        alertify.error(hasil.pesanError.diskonError);
							}

							console.log(listItem);
							console.log(index);

						},
						error: function (jqXHR, textStatus, errorThrown){ // error handling
			                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
			                // clearBarang();
			                console.log(jqXHR, textStatus, errorThrown);
			            }    
					})
				});

				// submit form
				$("#form_penjualan").submit(function(e){
					e.preventDefault();
					var data = getDataForm();
					data.dataLisItem = listItem;

					console.log(data);
					$.ajax({
						url : base_url+"module/penjualan/action.php",
						type : "post",
						dataType : "json",
						data: data,
						success: function(hasil){
							if(hasil.status) document.location=base_url+"index.php?m=penjualan&p=list"; // jika berhasil
							else{
								// cek jenis error
								if(hasil.errorDb){
									swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
								}
								else{
									// cek duplikat
									if(hasil.duplikat){

									}
									// cek list item
									else if(!hasil.cekList){
										swal("Pesan", "List Item Belum Diisi !", "warning");
									}
								}
							}
							console.log(hasil);
							// if(hasil.status) swal("List Item Masih Kosong");
						},
						error: function (jqXHR, textStatus, errorThrown){ // error handling
				            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
				            console.log(jqXHR, textStatus, errorThrown);
				        }
					})

					return false;
				});
			});
	
			// fungsi get data
			function getDataForm(){
				var dataPenjualan = {
					id: $("#id").val(),
					kd_penjualan: $("#fKd_penjualan").val(),
					tgl: $("#fTgl").val(),
					jenis: $("#fJenis").val(),
					status: $("#fStatus").val(),
					nama: $("#fNama").val(),
					no_telp: $("#fno_telepon").val(),
					alamat: $("#fAlamat").val(),
				};
				
				var data = {
					"action": $("#btn_submit_penjualan").val(),
					"dataPenjualan": dataPenjualan,
					// "dataListItem": listItem,
				};

				return data;
			}

			// fungsi submit data
			function submit_penjualan(){

			}

			// fungsi get data edit
			function edit_penjualan(id){

				$.ajax({
					url: base_url+"module/penjualan/action.php",
					type: "post",
					dataType: "json",
					data: {
						"id" : id,
						"action" : "getEdit",
					},
					success: function(data){
						console.log(data);
						var statusTranksaksi = data.penjualan.status;
						// isi form penjualan
						$("#id").val(data.penjualan.id);
						$("#fKd_penjualan").val(data.penjualan.kd_penjualan);
						$('#fTgl').datepicker('update',data.penjualan.tgl);
						$("#fJenis").val(data.penjualan.jenis);
						$("#fStatus").val(data.penjualan.status);
						$("#fNama").val(data.penjualan.nama);
						$("#fno_telepon").val(data.penjualan.telp);
						$("#fAlamat").val(data.penjualan.alamat);

						$.each(data.listItem, function(index, item){
							var index = indexItem++;
							// masukkan data dari server ke array listItem
							var dataItem = {
								aksi: "edit", status: "", index: index, id: item.id, nama: item.nama,
								kd_barang: item.kd_barang, qty: parseInt(item.qty), hpp: parseInt(item.hpp),
								harga: parseInt(item.harga), jenisDiskon: item.jenis_diskon,
								diskon: parseInt(item.diskon), subTotal: parseInt(item.subtotal),
								ket: item.ket,
							};
							listItem.push(dataItem);
							$("#tabel_item_penjualan > tbody:last-child").append(
								"<tr>"+
								"<td></td>"+ // nomor
								"<td>"+item.nama+"</td>"+ // item
								"<td>Rp. "+parseInt(item.harga)+",00</td>"+ // harga
								"<td>"+fieldQty(parseInt(item.qty), dataItem.index)+"</td>"+ // qty
								"<td>"+fieldDiskon(item.jenis_diskon, parseInt(item.diskon), dataItem.index, statusTranksaksi)+"</td>"+ // diskon
								"<td>"+fieldKeterangan(dataItem.index, item.ket)+"</td>"+ // keterangan
								"<td>Rp. "+parseInt(item.subtotal)+",00</td>"+
								"<td>"+btnAksi(dataItem.index)+"</td>"+ // aksi
								"</tr>"
							);
							numberingList();
						});
						console.log(listItem);
					},
					error: function (jqXHR, textStatus, errorThrown) { // error handling
			            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
			            console.log(jqXHR, textStatus, errorThrown);
			        }
				})
			}

			// fungsi penomeran berurut otomatis
			function numberingList(){
				$('#tabel_item_penjualan tbody tr').each(function (index) {
		            $(this).children("td:eq(0)").html(index + 1);
		        });
		        $("#tampilHarga").text("Rp. "+hitungTotal());
			}

			// fungsi cetak field qty di tabel
			function fieldQty(qty, index){
				var field = '<input type="number" min="0" onchange="onChange_qty('+index+',this)" style="width: 5em" class="form-control" value="'+qty+'">';
        		return field;
			}

			// fungsi cetak field keterangan di tabel
			function fieldKeterangan(index, val=false){
				var ket = val===false ? "" : val;
		        var field = '<textarea class="form-control" row="1" onchange="onChange_ket('+index+',this)">'+ket+'</textarea>';
		        return field;
		    }

		    // fungsi cetak field diskon di tabel
		    function fieldDiskon(jenisDiskon, diskon, index, status){
		    	var text = max = span = field = readonly = "";

		    	if(status=="0") readonly = "readonly";

		    	if(jenisDiskon==="p"){
		    		max = "100";
		    		span = "<span class='input-group-addon'>%</span>";
		    	}
		    	else{
		    		max = "999999";
		    		span = "<span class='input-group-addon'>Rp.</span>";
		    	}
		    	text = '<input type="number" min="0" max="'+max+'" class="form-control" onchange="onChange_diskon('+index+',this)" value="'+diskon+'" '+readonly+'>';
		    	field = "<div class='input-group'>"+span+text+"</div>";
		    	
		        return field;
		    }

		    // fungsi cetak btn aksi di tabel
		    function btnAksi(index){
				var btn = '<button type="button" class="btn btn-danger btn-sm bnt-flat" onclick="delList('+index+',this)" title="Hapus dari list">'+
		                        '<i class="fa fa-trash"></button>';
		        return btn;
			}

			// fungsi onchange qty
		    function onChange_qty(index, val){
		    	var diskon = 0;

		    	// ubah nilai qty di array
		    	$.each(listItem, function(i, item){
		    		if(item.index == index){
		    			item.qty = val.value;
		    			// sesuaikan ulang sub total
		    			if(item.jenisDiskon === "p") diskon=(item.harga*item.qty*(item.diskon/100));
		    			else diskon=item.diskon;
		    			item.subTotal = (item.harga*item.qty)-diskon;	
		    		} 
		    		// console.log(item);
		    	});
		    	numberingList();
		    	console.log(listItem);
		    }

		    // fungsi onchange diskon
		    function onChange_diskon(index, val){
		    	var diskon = 0;

		    	// ubah nilai qty di array
		    	$.each(listItem, function(i, item){
		    		if(item.index == index){
		    			item.diskon = val.value;
		    			// sesuaikan ulang sub total
		    			if(item.jenisDiskon === "p") diskon=(item.harga*item.qty*(item.diskon/100));
		    			else diskon=item.diskon;
		    			item.subTotal = (item.harga*item.qty)-diskon;	
		    		} 
		    		// console.log(item);
		    	});
		    	numberingList();
		    	console.log(listItem);
		    }

		    // fungsi onchange ket
		    function onChange_ket(index, val){
		    	// ubah nilai qty di array
		    	$.each(listItem, function(i, item){
		    		if(item.index == index) item.ket = val.value;
		    	});
		    	numberingList();
		    	console.log(listItem);
		    }

		    // fungsi hapus baris di tabel
		    function delList(index, val){
		    	$(val).parent().parent().remove(); // hapus data ditabel
		    	$.each(listItem, function(i, item){
		    		if(item.index == index) item.status = "hapus";
		    	});
		    	numberingList(); // reset ulang nomer
		    	console.log(listItem);
		    }

		    // fungsi hitung sub total dari inputan
		    function hitungSubtotal(harga, qty, jenisDiskon, valueDiskon){
		    	var diskon = 0;
		    	var subTotal = 0;
		    	
    			if(jenisDiskon === "p") diskon=(harga*qty*(valueDiskon/100));
    			else diskon=valueDiskon;
    			subTotal = (harga*qty)-diskon;
	    		
		    	return subTotal;
		    }

		    // fungsi hitung total dari array
		    function hitungTotal(){
		    	var diskon = 0;
		    	var total = 0;
		    	$.each(listItem, function(i, item){
		    		// selain hapus lakukan perhitungan
		    		if(item.status !== "hapus") total += item.subTotal;
		    	});

		    	return total.toFixed(2);
		    }

		    function clearBarang(){
		    	$('#fKd_barang').select2().val('').trigger('change'); // memngembalikan option barang ke default
		        $("#fQty").val(0);
		        $("#fDiskon").val(0);

		        $("#fKd_barang").focus();
		    }

			// fungsi set kode pembelian (bug kode > 10)
		    function setKdPenjualan(idSelect){
		    	
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
		                    idSelect.val('PJ-'+tanggal+'-1'); 
		                }else{
		                    iterasi = data[0].kd_penjualan.split("-");
		                    count = parseInt(iterasi[2]) + 1;
		                    idSelect.val('PJ-'+tanggal+'-'+count.toString());
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
		                // console.log(data);
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

		    // fungsi set status transaksi
		    function setStatusTransaksi(){
		    	var arrayStatus = [
		    		{value: "1", text: "NORMAL"},
		    		{value: "0", text: "FREE"},
		    	];

		    	$.each(arrayStatus, function(index, item){
		    		var option = new Option(item.text, item.value);
		    		$("#fStatus").append(option);
		    	});

		    	$("#fStatus").val("1");
		    }

		    // fungsi set jenis diskon
		    function setJenisDiskon(){
		    	var arrayJenis = [
		    		{value: "r", text: "RUPIAH"},
		    		{value: "p", text: "PERSEN"},
		    	];

		    	$.each(arrayJenis, function(index, item){
		    		var option = new Option(item.text, item.value);
		    		$("#fJenisDiskon").append(option);
		    	});

		    	$("#fJenisDiskon").val("p");
		    	$("#fDiskon").parent().find('span')[0].innerHTML = '%';
		    	$("#fDiskon").prop("max", "100");
		    	$("#fDiskon").val("0");
		    }

		    function setDataPembeli(jenis=true){
		    	if(jenis){
					$("#fNama").val("");
					$("#fno_telepon").val("");
					$("#fAlamat").val("");
					$("#fNama").prop("readonly", false);
					$("#fno_telepon").prop("readonly", false);
					$("#fAlamat").prop("readonly", false);
		    	}
		    	else{
		    		$("#fNama").val("");
		    		$("#fNama").prop("readonly", true);
					$("#fno_telepon").val("");
					$("#fno_telepon").prop("readonly", true);
					$("#fAlamat").val("");
					$("#fAlamat").prop("readonly", true);
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