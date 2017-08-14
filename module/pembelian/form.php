<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");
	
?>

<!-- form -->
<!-- css -->
<!-- Datepicker -->
<link rel="stylesheet" type="text/css" href="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker3.min.css"; ?>"/>
<!-- -->

<!-- header dan breadcrumb -->
<section class="content-header">
    <h1>Pembelian</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
        <li class="active"><a href="<?= base_url."index.php?m=pembelian&p=list"; ?>">Pembelian</a></li>
        <li>Form Data Pembelian</li>
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
                            <h3 class="box-title">Form Data Pembelian</h3>
                        </div>
                    </div>
                </div>
                <!-- isi panel box -->
                <div class="box-body">
                    <div class="row">
                    	<form enctype="multipart/form-data" role="form" id="formPembelian">
                    		<!-- fieldset data pembelian -->
                    		<div class="col-md-6 col-xs-12">
                    			<fieldset>
                        			<legend>Data Pembelian</legend>
                        			<!-- kode pembelian -->
                        			<div class="form-group">
                        				<label for="fKd_pembelian">Kode Pembelian</label>
                        				<input type="text" name="fKd_pembelian" id="fKd_pembelian" class="form-control" placeholder="Masukkan Kode Pembelian" readonly>
                                        <span class="help-block small"></span>  
                        			</div>

                        			<!-- tanggal -->
                        			<div class="form-group">
                        				<label for="fTgl">Tanggal</label>
                        				<input type="text" name="fTgl" id="fTgl" class="form-control datepicker">
                                        <span class="help-block small"></span> <!-- Tampilan Validasi -->
                        			</div>

                        			
                        		</fieldset>


            					<fieldset>
                        			<legend>Data Barang</legend>
                        			<!-- nama -->
                        			<!-- kode barang - qty -->
                        			<div class="form-group">
                        				<div class="row">
                        	
		                        			<div class="col-md-8">
                        						<label for="fKd_barang">Barang</label>
		                        				<select id="fKd_barang" name="fKd_barang" class="form-control select2" style="width: 100%;">
		                        					<option value="">-- Pilih Barang --</option>
		                        				</select>
                        					</div>
                        					<div class="col-md-4">
                        						<label for="fQty">Qty (pcs)</label>
		                        				<input type="number" id="fQty" name="fQty" class="form-control" min="0">

                        					</div>	
                        				
                        				</div>
                                        <span class="help-block small"></span>
                        			</div>


                        			<!-- Harga -->
          							<div class="form-group">
          								<div class="row">
          									<div class="col-md-12 col-xs-12">
          										<label for="fHarga">Harga</label>
          									</div>
          								</div>
          								<div class="row">
          									<div class="col-md-12 col-xs-12">
	          									<div class="input-group">
	          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">
	          											Rp. 
	          										</span>
	          										<input class="form-control" placeholder="Masukkan Harga" id="fHarga" name="fHarga" type="text">
	          										<span class="input-group-addon">,00</span>
	          										<span class="input-group-btn">
			                        					<button type="button" id="fTambah_pembelian" name="fTambah_pembelian" class="btn btn-default">
			                        						<i class="fa fa-plus"></i>
			                        					</button>
			                        				</span>
	          									</div>
	       									</div>
          								</div>
                                        <span class="help-block small"></span>	
          							</div>
                        		</fieldset>	


                    		</div>


                    		<div class="col-md-6 col-xs-12">
                    			
                    			<!-- fieldset list item -->
                    			<div class="row">
                    				<div class="col-md-12 col-xs-12">
                    					<fieldset>
		                        			<legend>List Item</legend>
		                        			<div class="row">
		                        				<div class="col-md-12">
		                        					<table id="tabel_item_pembelian" class="table table-bordered table-hover">
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
                	<button type="button" class="btn btn-default btn-lg" onclick="addPembelian()">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
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

    // variabel untuk menampung data yang terhapus dari list
    var data_edit_hapus = [];

	$(function(){
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
	});

    // inisialisasi tamplian awal
    $('#fTgl').val(getTanggal); // set default tanggal ke hari ini
    setSelect($('#fKd_barang')); // set isi select kd_barang
    setKdPembelian($('#fKd_pembelian')); // set kode pembelian


    // aksi tambah list pembelian (tampilan)
    $("#fTambah_pembelian").click(function() {
        var komponen = [];
        var item_text = $("#fKd_barang option:selected").text();
        var item_val = $("#fKd_barang").val();

        // cek jika value option barang masih default set text kosong
        if(item_val.length <= 0){
            item_text = "";
        }

        var qty = $("#fQty").val().trim();
        var harga = $("#fHarga").val().trim();

        var dataForm = {
            kd_barang : item_val,
            qty : qty,
            harga : harga,
        };

        $.ajax({
            url : base_url+"module/pembelian/action.php",
            type : "post",
            dataType : "json",
            data: {
                "dataForm" : dataForm,
                "action" : 'addList',
            },
            success: function(hasil){
                
                if(hasil.status){
                    // Penambahan baris pada list barang
                    $('#tabel_item_pembelian > tbody:last-child').append(
                        '<tr id="baris">'+
                            '<td></td>'+
                            '<td><div style="display: none;">'+item_val+'</div>'+item_text+'</td>'+
                            '<td>Rp. '+harga+'</td>'+
                            '<td>'+fieldQty(qty)+'</td>'+
                            '<td>'+fieldKeterangan()+'</td>'+
                            '<td>'+
                                '<button type="button" class="btn btn-danger btn-sm" onclick="delList()" title="Hapus dari list">'+
                                    '<i class="fa fa-trash">'+
                                '</button>'+

                            '</td>'+
                        '</tr>'
                    );

                    // penyesuaian kolom No pada tampilan ketika list ditambah
                    numberingList();
                    clearBarang();
                }else{
                    // jika ada pesan error
                    if(!jQuery.isEmptyObject(hasil.pesanError.kd_barangError)){
                        alertify.error(hasil.pesanError.kd_barangError);
                    } else if(!jQuery.isEmptyObject(hasil.pesanError.qtyError)){
                        alertify.error(hasil.pesanError.qtyError);
                    } else if(!jQuery.isEmptyObject(hasil.pesanError.hargaError)){
                        alertify.error(hasil.pesanError.hargaError);
                    }   
                }      
            },
            error: function (jqXHR, textStatus, errorThrown) // error handling
            {
                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
                clearBarang();
                console.log(jqXHR, textStatus, errorThrown);
            }              
        });
    });

    // bersihkan kolom yg data barang
    function clearBarang() {

        $('#fKd_barang').select2().val('').trigger('change'); // memngembalikan option barang ke default
        $("#fQty").val('');
        $("#fHarga").val('');

        $("#fKd_barang").focus();
    }

    function fieldKeterangan(){
        var field = '<textarea id="ketList" class="form-control row="2"></textarea>';
        return field;
    }

    function fieldQty(qty){
        var field = '<input type="number" min="2" id="qtyList" style="width: 5em" class="form-control" value="'+qty+'">';
        return field;
    }

    // aksi delete List pembelian
    function delList() {
        // menghapus baris
        $('#baris').remove();
        
        // menyimpan data ke array saat barang dihapus dari list
        data_edit_hapus.push({
            kd_pembelian : $('#fKd_pembelian').val(),
            kd_barang : $('#baris').children("td:eq(1)").children().html()
        });

        // penyesuaian kolom No pada tampilan ketika list dihapus
        numberingList();
    }

    // penyesuaian kolom No pada tampilan ketika list dihapus atau ditambah
    function numberingList() {
        // variabel untuk menhitung total barang
        var total = 0;
        var hrg = 0;

        $('#tabel_item_pembelian tbody tr').each(function (index) {
            $(this).children("td:eq(0)").html(index + 1);

            // operasi untuk menghitung total
            hrg = $(this).children("td:eq(2)").html().substr(4);
            total += parseInt(hrg);
        });
        
        // menampilkan total
        $('#tampilHarga').children().html('Total: Rp. '+total+',00');
    }

    // 
    function addPembelian() {

        var data = new Array();
        var cek = true;
        var kd_pembelian = $('#fKd_pembelian').val().trim();
        var tgl = $('#fTgl').val().trim();
        
        // menyimpan data ke array ketika data akan ditambah
        $('#tabel_item_pembelian tbody tr').each(function (index) {
            //menampilkan isi dari kolom no
            var kd_barang = $(this).children("td:eq(1)").children().html().trim();
            var harga = $(this).children("td:eq(2)").html().substr(4).trim();
            var qty = $(this).children("td:eq(3)").children().val().trim();
            var ket = $(this).children("td:eq(4)").children().val().trim();

            if((qty=="")||(isNaN(qty))){
                cek = false;
            }else{
                if(ket=="") ket="-";
                data.push({
                    kd_barang : kd_barang,
                    harga : harga,
                    qty : qty,
                    ket : ket,
                });
            }           
            
        });

        
        if(cek){
            var dataPembelian = {
                kd_pembelian : kd_pembelian,
                tgl : tgl,
                listBarang : data,
            }
            getResponseAddPembelian(dataPembelian);
        }else{
            alertify.error('Qty pada list ada yang kosong atau tidak sesuai');
        }
   
          
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
            url: base_url+"module/pembelian/action.php",
            type: "post",
            dataType: "json",
            data: {
                "action" : "getSelect",
            },
            success: function(data){
                $.each(data, function(index, item){
                    idSelect.append($("<option>", {
                        value: item.id,
                        text: item.nama,
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

    // fungsi set kode pembelian (bug kode > 10)
    function setKdPembelian(idSelect){

        $.ajax({
            url: base_url+"module/pembelian/action.php",
            type: "post",
            dataType: "json",
            data: {
                "action" : "getKdPembelian",
            },
            success: function(data){
                var tanggal = getTanggal().replace(/-/g,"");

                // cek apakah ada kode pembelian pada hari ini
                if(!data[0]){
                    idSelect.val('PB-'+tanggal+'-1'); 
                }else{
                    iterasi = data[0].kd_pembelian.split("-");
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


    function getResponseAddPembelian(data){

        $.ajax({
            url : base_url+"module/pembelian/action.php",
            type : "post",
            dataType : "json",
            data: {
                "dataPembelian" : data,
                "action" : 'tambah',
            },
            success: function(hasil){
                if(hasil.status){
                    alertify.success('pembelian & detil sukses')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) // error handling
            {
                swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
                clearBarang();
                console.log(jqXHR, textStatus, errorThrown);
            }              
        });
    }
</script>