$(document).ready(function(){
	var cekEdit = false;

	if(!jQuery.isEmptyObject(urlParams.id)){ // jika ada parameter get
		// edit_barang(urlParams.id);
		cekEdit = true;
	}

	$("#fKd_pengeluaran").prop("readonly", true);

	//setting datepicker
	$(".datepicker").datepicker({
		autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "bottom auto",
        todayBtn: true,
        todayHighlight: true,
	});

	setSelect_jenis();
    $('#fQty').val(0);
    $('#fNominal').val(0);

	if(cekEdit) edit_pengeluaran(urlParams.id);
	else{
		setKdPengeluaran($('#fKd_pengeluaran'));
		$('#fTgl').datepicker('update',getTanggal());
	}

	$("#fTambah_pengeluaran").click(function(){
		add_list();
	});

	$("#form_pengeluaran").submit(function(e){
		e.preventDefault();
		submit_pengeluaran();

		return false;
	});

});

function add_list(){
	var index = indexItem++;
	var ket = $("#fKet").val().toUpperCase();
	var qty = parseInt($("#fQty").val());
	var nominal = parseInt($("#fNominal").val());
	var subTotal = qty*nominal;
	var dataItem = {
		aksi: "tambah", status: "", index: index, id: "",
		ket: ket, qty: qty, nominal: nominal, subTotal: subTotal,
	};

	$.ajax({
		url : base_url+"app/controllers/Pengeluaran.php",
        type : "post",
        dataType : "json",
        data: {
            "data" : dataItem,
            "action" : 'addList',
        },
        success: function(hasil){
            // var baris = -1;
            if(hasil.status){                
                // cek apakah barang sudah ada pada list

                listItem.push(dataItem);
                $('#tabel_item_pengeluaran > tbody:last-child').append(
                    '<tr">'+
                        '<td></td>'+
                        '<td>'+fieldKeterangan(ket, index)+'</td>'+
                        '<td>'+fieldNominal(nominal, index)+'</td>'+
                        '<td>'+fieldQty(qty, index)+'</td>'+
                        '<td>Rp. '+subTotal+',00</td>'+
                        '<td>'+btnAksi(index)+'</td>'+
                    '</tr>'
                );

                // penyesuaian kolom No pada tampilan ketika list ditambah
                numberingList();
                clearDetail();
                
            }else{
                indexItem -= 1;
                // jika ada pesan error
                if(!jQuery.isEmptyObject(hasil.pesanError.ketError))
                    alertify.error(hasil.pesanError.ketError);
                else if(!jQuery.isEmptyObject(hasil.pesanError.qtyError))
                    alertify.error(hasil.pesanError.qtyError);
                else if(!jQuery.isEmptyObject(hasil.pesanError.nominalError))
                    alertify.error(hasil.pesanError.nominalError);
            }

            console.log(listItem);
            console.log(index);      
        },
        error: function (jqXHR, textStatus, errorThrown){ // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            console.log(jqXHR, textStatus, errorThrown);
        }
	})
}

function getDataForm(){
	var dataPengeluaran = {
        id: $("#id").val(),
        kd_pengeluaran: $("#fKd_pengeluaran").val(),
        tgl: $("#fTgl").val(),
        jenis: $("#fJenis").val().trim(),
    };
    
    var data = {
        "action": $("#btnSubmit").val(),
        "dataPengeluaran": dataPengeluaran,
        // "dataListItem": listItem,
    };

    return data;
}

function submit_pengeluaran(){
	var data = getDataForm();
    data.dataLisItem = listItem;

 	console.log(data);
    $.ajax({
        url : base_url+"app/controllers/Pengeluaran.php",
        type : "post",
        dataType : "json",
        data: data,
        success: function(hasil){
            if(hasil.status) document.location=base_url+"index.php?m=pengeluaran&p=list"; // jika berhasil
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
                    setError(hasil.pesanError);
                    setValue(hasil.set_value);
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
}

function edit_pengeluaran(id){
	$.ajax({
		url: base_url+"app/controllers/Pengeluaran.php",
		type: "post",
		dataType: "json",
		data: {
			"id" : id,
			"action" : "getEdit",
		},
		success: function(hasil){
			console.log(hasil);
			// isi form penjualan
			$("#id").val(hasil.data.pengeluaran.id);
			$("#fKd_pengeluaran").val(hasil.data.pengeluaran.kd_pengeluaran);
			$('#fTgl').datepicker('update',hasil.data.pengeluaran.tgl);
			$("#fJenis").val(hasil.data.pengeluaran.jenis);

			$.each(hasil.data.listItem, function(index, item){
				var index = indexItem++;
				// masukkan data dari server ke array listItem
				var dataItem = {
					aksi: "edit", status: "", index: index, id: item.id,
					ket: item.ket, qty: parseInt(item.qty), 
					nominal: parseInt(item.nominal), subTotal: parseInt(item.subtotal),
				};

				listItem.push(dataItem);
				$('#tabel_item_pengeluaran > tbody:last-child').append(
                    '<tr">'+
                        '<td></td>'+
                        '<td>'+fieldKeterangan(item.ket, dataItem.index)+'</td>'+
                        '<td>'+fieldNominal(parseInt(item.nominal), dataItem.index)+'</td>'+
                        '<td>'+fieldQty(parseInt(item.qty), dataItem.index)+'</td>'+
                        '<td>Rp. '+parseInt(item.subtotal)+',00</td>'+
                        '<td>'+btnAksi(dataItem.index)+'</td>'+
                    '</tr>'
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

// function list data pengeluaran
	// fungsi penomeran berurut otomatis
	function numberingList(){
		$('#tabel_item_pengeluaran tbody tr').each(function (index) {
            $(this).children("td:eq(0)").html(index + 1);
        });
        $("#tampilHarga").text("Rp. "+hitungTotal());
	}

	// fungsi cetak field qty di tabel
	function fieldQty(qty, index){
		var field = '<input type="number" min="1" onchange="onChange_qty('+index+',this)" style="width: 5em" class="form-control" value="'+qty+'">';
        return field;
	}

	// fungsi cetak field keterangan di tabel
	function fieldKeterangan(val, index){
		var field = '<input type="text" onchange="onChange_ket('+index+',this)" class="form-control" value="'+val+'">';
        return field;
	}

	// fungsi cetak field nominal di tabel
	function fieldNominal(nominal, index){
		var field = '<input type="number" min="1" onchange="onChange_nominal('+index+',this)" class="form-control" value="'+nominal+'">';
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
		$.each(listItem, function(i, item){
            if(item.index == index){
                item.qty = val.value;
                item.subTotal = (item.nominal*item.qty);
                $(val).parent().parent().children("td:eq(4)").html("Rp. "+item.subTotal+",00"); 
            } 
            // console.log(item);
        });
        numberingList();
	}

	// fungsi onchange keterangan
	function onChange_ket(index, val){
		$.each(listItem, function(i, item){
            if(item.index == index) item.ket = val.value.toUpperCase();
        });
        numberingList();
        console.log(listItem);
	}

	// fungsi onchange nominal
	function onChange_nominal(index, val){
		$.each(listItem, function(i, item){
            if(item.index == index) {
            	item.nominal = val.value;
            	$(val).parent().parent().children("td:eq(4)").html("Rp. "+item.subTotal+",00");
            }
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

	// fungsi hitung total
	function hitungTotal(){
		var total = 0;
        $.each(listItem, function(i, item){
            // selain hapus lakukan perhitungan
            if(item.status !== "hapus") total += item.subTotal;
        });

        return total.toFixed(2);
	}	

	function clearDetail(){
		$('#fKet').val('');
        $("#fQty").val(0);
        $("#fNominal").val(0);
        $("#fKet").focus();
	}

// ========================================

// fungsi set kode penjualan
function setKdPengeluaran(idSelect){
	$.ajax({
        url: base_url+"app/controllers/Pengeluaran.php",
        type: "post",
        dataType: "json",
        data: {
            "action" : "getKdPengeluaran",
        },
        success: function(data){
            var tanggal = getTanggal().replace(/-/g,"");

            // cek apakah ada kode pembelian pada hari ini
            if(!data[0]){
                idSelect.val('PG-'+tanggal+'-1'); 
            }else{
                iterasi = data[0].kd_pengeluaran.split("-");
                count = parseInt(iterasi[2]) + 1;
                idSelect.val('PG-'+tanggal+'-'+count.toString());
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

// fungsi set isi select jenis
function setSelect_jenis(){
	var arrayJenis = [
		{value: "", text: "-- Pilih Jenis Pengeluaran --"},
		{value: "MARKETING", text: "MARKETING"},
		{value: "OPERASIONAL", text: "OPERASIONAL"},
		{value: "GAJI", text: "GAJI"},
		{value: "AKTIVA TETAP", text: "AKTIVA TETAP"},
		{value: "LAINNYA", text: "LAINNYA"},
	];

	$.each(arrayJenis, function(index, item){
		var option = new Option(item.text, item.value);
		$("#fJenis").append(option);
	});
}

// fungsi get tanggal
function getTanggal(){
	var d = new Date();
    var month = '' + (d.getMonth() + 1);
    var day = '' + d.getDate();
    var year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

// fungsi setError
function setError(error){

}

// fungsi setValue
function setValue(value){

}