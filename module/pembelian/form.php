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
                        				<input type="text" name="fKd_pembelian" id="fKd_pembelian" class="form-control" placeholder="Masukkan Kode Pembelian">
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
                        						<label for="fKd_barang">Item</label>
		                        				<select id="fKd_barang" name="fKd_barang" class="form-control select2" style="width: 100%;">
		                        					<option value="">-- Pilih Item --</option>
                                                    <option value="1">Satu</option>
                                                    <option value="2">dua</option>
                                                    <option value="3">Tiga</option>
		                        				</select>
                        					</div>
                        					<div class="col-md-4">
                        						<label for="fQty">Qty</label>
		                        				<input type="number" id="fQty" name="fQty" class="form-control" min="0">

                        					</div>	
                        				
                        				</div>

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



    // aksi tambah pembelian (tampilan)
    $("#fTambah_pembelian").click(function() {
        var item_text = $("#fKd_barang option:selected").text();
        var item_val = $("#fKd_barang").val();
        if(item_val.length <= 0){
            item_text = "";
        }
        var qty = $("#fQty").val();
        var harga = $("#fHarga").val();

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

                    // '<button type="button" class="btn bg-maroon btn-sm" title="Hapus dari list">'+
                    //     '<i class="fa fa-edit">'+
                    // '</button>'+
                '</td>'+
            '</tr>'
        );

        // penyesuaian kolom No pada tampilan ketika list ditambah
        numberingList();
        afterAddList();
    });

    function afterAddList() {
        $('#fKd_barang').select2().val('').trigger('change'); // masih error (kembalikan posisi select ke drfault)
        $("#fQty").val('');
        $("#fHarga").val('');

        $("#fKd_barang").focus();
    }

    function fieldKeterangan(){
        var field = '<textarea id="ketList" class="form-control row="2"></textarea>';
        return field;
    }

    function fieldQty(qty){
        var field = '<input type="text" id="qtyList" size="2" class="form-control" value="'+qty+'">';
        return field;
    }

    // aksi delete List pengenluaran
    function delList() {
        $('#baris').remove();
        
        data_edit_hapus.push({
            kd_pembelian : $('#fKd_pembelian').val(),
            kd_barang : $('#baris').children("td:eq(1)").children().html()
        });

        // penyesuaian kolom No pada tampilan ketika list dihapus
        numberingList();
    }

    // penyesuaian kolom No pada tampilan ketika list dihapus atau ditambah
    function numberingList() {
        var total = 0;
        var hrg = 0;
        $('#tabel_item_pembelian tbody tr').each(function (index) {
            $(this).children("td:eq(0)").html(index + 1);
            hrg = $(this).children("td:eq(2)").html().substr(4);
            total += parseInt(hrg);
        });
        

        $('#tampilHarga').children().html('Total: Rp. '+total+',00');
    }

    // menampilkan data dari list
    function addPembelian() {

        var data = [];
        
        $('#tabel_item_pembelian tbody tr').each(function (index) {
            //menampilkan isi dari kolom no
            data.push({
                kd_barang : $(this).children("td:eq(1)").children().html(),
                harga : $(this).children("td:eq(2)").html().substr(4),
                qty : $(this).children("td:eq(3)").children().val(),
                ket : $(this).children("td:eq(4)").children().val()

            });
            
        });

        
        
    }


</script>