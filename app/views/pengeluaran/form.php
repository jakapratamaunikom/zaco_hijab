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
    <h1>Pengeluaran</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
        <li class="active"><a href="<?= base_url."index.php?m=pengeluaran&p=list"; ?>">Pengeluaran</a></li>
        <li>Form Data Pengeluaran</li>
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
                            <h3 class="box-title">Form Data Pengeluaran</h3>
                        </div>
                    </div>
                </div>
                <!-- isi panel box -->
                <div class="box-body">
                    <div class="row">
                    	<form enctype="multipart/form-data" role="form">
                    		<!-- fieldset data pengeluaran -->
                    		<div class="col-md-6 col-xs-12">
                    			<!-- Fieldset Data Pengeluaran -->
                    			<fieldset>
                        			<legend>Data Pengeluaran</legend>
                        			<!-- kode pengeluaran -->
                        			<div class="form-group">
                        				<label for="fKd_pengeluaran">Kode Pengeluaran</label>
                        				<input type="text" name="fKd_pengeluaran" id="fKd_pengeluaran" class="form-control" placeholder="Masukkan Kode Pengeluaran">
                        			</div>

                        			<!-- tanggal -->
                        			<div class="form-group">
                        				<label for="fTgl">Tanggal</label>
                        				<input type="text" name="fTgl" id="fTgl" class="form-control datepicker">
                        			</div>

                        			<!-- jenis pengeluaran -->
                        			<div class="form-group">
                        				<label for="fJenis">Jenis Pengeluaran</label>
                        				<select id="fJenis" name="fJenis" class="form-control" style="width: 100%;">
                        					<option value="">-- Pilih Jenis Pengeluaran --</option>
                        				</select>
                        			</div>

                        			<!-- Keterangan -->
                        			<div class="form-group">
                        				<div class="row">
                        					<div class="col-md-8">
                        						<label for="fKet">Keterangan</label>
		                        				<input type="text" name="fKet" id="fKet" class="form-control" placeholder="Masukkan Keterangan">
                        					</div>
                        					<div class="col-md-4">
                        						<label for="fQty">Qty</label>
		                        				<input type="number" id="fQty" name="fQty" class="form-control" min="0">
                        					</div>
                        				</div>
                        			</div>


                        			<!-- Nominal -->
          							<div class="form-group">
          								<div class="row">
          									<div class="col-md-12 col-xs-12">
          										<label for="fNominal">Nominal</label>
          									</div>
          								</div>
          								<div class="row">
          									<div class="col-md-12 col-xs-12">
	          									<div class="input-group">
	          										<span class="input-group-addon" style="background-color: #dd4b39; color: white;">
	          											Rp. 
	          										</span>
	          										<input class="form-control" placeholder="Masukkan Nominal" id="fNominal" name="fNominal" type="text">
	          										<span class="input-group-addon">,00</span>
	          										<span class="input-group-btn">
			                        					<button type="button" id="fTambah_pengeluaran" name="fTambah_pengeluaran" class="btn btn-default">
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
		                        					<table id="tabel_item_pengeluaran" class="table table-bordered table-hover">
				                        				<thead>
				                        					<tr>
				                        						<th style="width: 15px">No</th>
				                        						<th>Keterangan</th>
				                        						<th>Nominal</th>
				                        						<th>Qty</th>
				                        						<th>Aksi</th>
				                        					</tr>
				                        				</thead>
                                                        <tbody></tbody>
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
                	<button type="button" class="btn btn-default btn-lg" onclick="addPengeluaran()"><i class="fa fa-plus"></i> Tambah</button>
                	<button type="button" class="btn btn-default btn-lg">Batal</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- js -->
<!-- js datepicker -->
<script type="text/javascript" src="<?= base_url."assets/plugins/datepicker/bootstrap-datepicker.min.js"; ?>"></script>

<script type="text/javascript">
	$(function(){
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

    // aksi tambah pengeluaran (tampilan)
    $("#fTambah_pengeluaran").click(function() {
        $('#tabel_item_pengeluaran > tbody:last-child').append(
            '<tr id="baris">'+
                '<td></td>'+
                '<td>Dummy</td>'+
                '<td>Dummy</td>'+
                '<td>Dummy</td>'+
                '<td><button type="button" class="btn btn-danger btn-sm" onclick="delList()" title="Hapus dari list"><i class="fa fa-trash"</button></td>'+
            '</tr>'
        );

        // penyesuaian kolom No pada tampilan ketika list ditambah
        numberingList();
    })

    // aksi delete List pengenluaran
    function delList() {
        $('#baris').remove();

        // penyesuaian kolom No pada tampilan ketika list dihapus
        numberingList();
    }

    // penyesuaian kolom No pada tampilan ketika list dihapus atau ditambah
    function numberingList() {
        $('#tabel_item_pengeluaran tbody tr').each(function (index) {
            $(this).children("td:eq(0)").html(index + 1);
        });
    }

    // menampilkan data dari list
    function addPengeluaran() {
        $('#tabel_item_pengeluaran tbody tr').each(function (index) {
            //menampilkan isi dari kolom no
            console.log($(this).children("td:eq(0)").html());
        });
    }

    

    
</script>