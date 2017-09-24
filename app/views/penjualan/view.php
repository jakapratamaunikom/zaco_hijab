<?php
	Defined("BASE_PATH") or die("Dilarang Mengakses File Secara Langsung");

	$id = isset($_GET['id']) ? $_GET['id'] : false;
?>

<!-- List -->
<section class="content-header">
	<h1>Reject</h1>
	<ol class="breadcrumb">
		<li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i>Zaco Hijab</a></li>
		<li><a href="<?= base_url."index.php?m=pengeluaran&p=list"?>">Reject</a></li>
		<li class="active">Lihat Detail Reject</li>
	</ol>
</section>

<section class="invoice">

	<!-- header  -->
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> Faktur Penjualan
				<small class="pull-right" id="lbl_tgl"></small>
			</h2>
		</div>
	<!-- /.col -->
    </div>

    <!-- baris info -->
    <div class="row invoice-info">

      	<!-- Profil Zaco Hijab -->
        <div class="col-sm-4 col-xs-12 invoice-col">
			Penjual: <!-- Informasi Penjual --> 
			<address>
				<strong>Zaco Hijab, Inc.</strong><br>
				Alamat<br><br>
				Telepon: (+62) 81573777945
			</address>
        </div>

        <div class="col-sm-4 col-xs-12 invoice-col">
			Pembeli: <!-- Informasi Pembeli yang klaim Reject --> 
			<address>
				<strong>Nama:&nbsp;</strong><nama id="lbl_nama"></nama> 
				<div id="lbl_alamat"></div>
				<br>
				<strong>Telepon:&nbsp;</strong><tlp id="lbl_telp"></tlp>
			</address>
        </div>

        <!-- /.col -->
        <div class="col-sm-4 col-xs-12 invoice-col">
        	<div class="pull-right">
        		<b><c id="lbl_no_penjualan"></c></b><br>
				<b id="lbl_jenis"></b><br>
				<b>Ongkir <c id="lbl_ongkir"></c></b><br><br>
				<b>No Reject #007612</b><br>
        	</div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- panel button -->
    <div class="row" style="padding-bottom: 25px;">
        <div class="col-md-12 col-xs-12">
            <div class="btn-group">
                <!-- tambah -->
                <a href="#" type="button" class="btn btn-default" role="button">
                	<i class="fa fa-edit"></i> Edit
                </a>

                <!-- export pdf -->
                <button type="button" class="btn btn-danger" id="pdfPengeluaran">
                    <i class="fa fa-file-pdf-o"></i> Export Pdf
                </button>
            </div>
        </div>
    </div>

	<!-- Tabel Data Pengeluaran -->
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table id="tbl_reject" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama</th>
						<th>Harga</th>
						<th>Qty</th>
						<th>Diskon</th>
						<th>Subtotal</th>
						<th>Keterangan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- button bawah -->
	<div class="row">
		<div class="col-xs-12">
			<a href="<?= base_url."index.php?m=reject&p=list" ?>" class="btn btn-default btn-lg pull-right" role=button>
				<i class="fa fa-reply"></i> Kembali
			</a>

		</div>
	</div>

</section>

<!-- untuk mengilangkan garis hitam dibawah -->
<div class="clearfix"></div>


<!-- modal reject -->
<?php include_once("app/views/modals/modal_reject.php"); ?>

<!-- SELECT2 -->
<script src="<?= base_url."assets/plugins/select2/select2.full.min.js"; ?>"></script>

<script type="text/javascript">
    var base_url = "<?php print base_url; ?>";
    var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;
    // var id = "";
    var listItem = [];
    var indexItem = 0;
</script>

<?php
	if(!$id){
		?>
		<script type="text/javascript">document.location=base_url+"index.php?m=penjualan&p=list";</script>
		<?php
	}
?>

<script type="text/javascript">

	$(document).ready(function(){

		$(".select2").select2();
		setStatus();

		if(!jQuery.isEmptyObject(urlParams.id)){ // jika ada parameter get
			var id = urlParams.id;
			getView(id);
		}

		setSelect($('#slc_nama'));
	});

	function getView(id){
		$.ajax({
			url: base_url+"app/controllers/Penjualan.php",
			type: "post",
			dataType: "json",
			data: {
				"id" : id,
				"action" : "getView",
			},
			success: function(data){
				console.log(data);

				if(!data) document.location=base_url+"index.php?m=penjualan&p=list";
				else{
					setValue(data);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) { // error handling
	            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
	            console.log(jqXHR, textStatus, errorThrown);
	        }

		})
	}

	function setValue(data) {
		$('#lbl_tgl').text(data.penjualan.tgl);
		$('#lbl_nama').text(data.penjualan.nama);
		$('#lbl_alamat').text(data.penjualan.alamat);
		$('#lbl_telp').text(data.penjualan.telp);
		$('#lbl_no_penjualan').text(data.penjualan.kd_penjualan);
		$('#lbl_jenis').text(data.penjualan.jenis);
		$('#lbl_ongkir').text(data.penjualan.ongkir);

		$.each(data.detail, function(index, item){
			var index = indexItem++;
			// masukkan data dari server ke array listItem
			// var dataItem = {
			// 	aksi: "edit", 
			// 	status: "", 
			// 	index: index, 
			// 	id: item.id, 
			// 	kd_barang: item.kd_barang, 
			// 	nama: item.nama,
			// 	qty: parseInt(item.qty), 
			// 	hpp: parseInt(item.hpp),
			// 	harga: parseInt(item.harga), 
			// 	jenisDiskon: item.jenis,
			// 	diskon: parseInt(item.diskon), 
			// 	subTotal: parseInt(item.subtotal),
			// 	ket: item.ket,
			// };
			// listItem.push(dataItem);
			$("#tbl_reject > tbody:last-child").append(
				"<tr>"+
				"<td></td>"+ // nomor
				"<td></td>"+ // kd_barang
				"<td>"+item.nama+"</td>"+ // nama barang
				"<td>"+item.harga+"</td>"+ // harga
				"<td>"+item.qty+"</td>"+ // qty
				"<td>"+item.diskon+"</td>"+ // diskon
				"<td>"+item.subtotal+"</td>"+ // subtotal
				"<td>"+item.ket+"</td>"+ // keterangan
				"<td>"+btnAksi()+"</td>"+
				"</tr>"
			);
			numberingList();
		});
		// console.log(listItem)
	}

	function btnAksi(index){

		// var disabled = respon ? '' : 'disabled';
		// var btn = '<button type="button" class="btn btn-danger btn-sm bnt-flat" onclick="delList('+index+',this)" title="Hapus dari list"'+disabled+'>'+
	 //                    '<i class="fa fa-trash"></button>';
	    
		var btn = '<button type="button" class="btn btn-danger btn-sm btn-flat" title="Reject"'+
						' onclick="reject()">'+
	                    'Reject</button>';
	    return btn;
	}

	function reject() {
		$("#modal_reject").modal('show');
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
	        url: base_url+"app/controllers/Penjualan.php",
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
	        error: function (jqXHR, textStatus, errorThrown){ // error handling
	            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
	            console.log(jqXHR, textStatus, errorThrown);
	        }
	    })
	} 

	// fungsi set status transaksi
	function setStatus(){
		var arrayStatus = [
			{value: "", text: "-- Pilih Status --"},
			{value: "1", text: "REJECT"},
			{value: "2", text: "RETURN"},
		];

		$.each(arrayStatus, function(index, item){
			var option = new Option(item.text, item.value);
			$("#slc_status").append(option);
		});

		$("#slc_status").val("");
	}

	// fungsi penomeran berurut otomatis
	function numberingList(){
		$('#tbl_reject tbody tr').each(function (index) {
	        $(this).children("td:eq(0)").html(index + 1);
	    });
	}
</script>