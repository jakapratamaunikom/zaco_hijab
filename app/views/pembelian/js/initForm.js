$(document).ready(function(){
    var cekEdit = false;

    if(!jQuery.isEmptyObject(urlParams.id)){ // jika ada parameter get
        // edit_barang(urlParams.id);
        cekEdit = true;
    }

	//Initialize Select2 Elements
	$(".select2").select2();
    $("#fKd_pembelian").prop("readonly", true);
    $('#fQty').val(0);
    $('#fHarga').val(0);

	//setting datepicker
	$(".datepicker").datepicker({
		autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "bottom auto",
        todayBtn: true,
        todayHighlight: true,
    });

    setSelect($('#fKd_barang'));

    if(cekEdit) editPembelian(urlParams.id);
    else{
        setKdPembelian($('#fKd_pembelian')); // set kode pembelian
        $('#fTgl').datepicker('update',getTanggal());
    }

    // aksi tambah list pembelian (tampilan)
    $("#fTambah_pembelian").click(function(){
        addPembelian();           
    });

    $("#form_pembelian").submit(function(e){
        e.preventDefault();
        submit_pembelian();

        return false;
    });

});


// cek barang pada list
function validBarang(barangIn){
    var ada = false;
    
    $.each(listItem, function(i, item){
        if(barangIn==item.kd_barang && item.status != "hapus") ada = true;
    });

    return ada;
}

// fungsi tambah pembelian - tambah list
function addPembelian(){
    var index = indexItem++;
    var item_text = $("#fKd_barang").select2('data')[0].text;
    var item_val = $("#fKd_barang").val();
    var qty = parseInt($("#fQty").val());
    var harga = parseInt($("#fHarga").val());
    var subTotal = qty*harga;
    var dataForm = {
        aksi: "tambah", status: "", index: index, id: "",
        nama: item_text, kd_barang: item_val, qty: qty,
        harga: harga, subTotal: subTotal, ket: "",
    };

    $.ajax({
        url : base_url+"app/controllers/Pembelian.php",
        type : "post",
        dataType : "json",
        data: {
            "dataForm" : dataForm,
            "action" : 'addList',
        },
        success: function(hasil){
            // var baris = -1;
            if(hasil.status){
                // Penambahan baris pada list barang 
                // buat <tbody></tbody> sebelum digunakan
                
                // cek apakah barang sudah ada pada list
                if(validBarang(item_val)){
                    alertify.error(item_text+' sudah ada di list');
                    indexItem -= 1;
                }else{
                    listItem.push(dataForm);
                    $('#tabel_item_pembelian > tbody:last-child').append(
                        '<tr">'+
                            '<td></td>'+
                            '<td>'+item_text+'</td>'+
                            '<td>Rp. '+harga+',00</td>'+
                            '<td>'+fieldQty(qty, index)+'</td>'+
                            '<td>'+fieldKeterangan(index)+'</td>'+
                            '<td>Rp. '+subTotal+',00</td>'+
                            '<td>'+btnAksi(index)+'</td>'+
                        '</tr>'
                    );

                    // penyesuaian kolom No pada tampilan ketika list ditambah
                    numberingList();
                    clearBarang();
                }
                
            }else{
                indexItem -= 1;
                // jika ada pesan error
                if(!jQuery.isEmptyObject(hasil.pesanError.kd_barangError))
                    alertify.error(hasil.pesanError.kd_barangError);
                else if(!jQuery.isEmptyObject(hasil.pesanError.qtyError))
                    alertify.error(hasil.pesanError.qtyError);
                else if(!jQuery.isEmptyObject(hasil.pesanError.hargaError))
                    alertify.error(hasil.pesanError.hargaError);
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
}

function getDataForm(){
    var dataPembelian = {
        id: $("#id").val(),
        kd_pembelian: $("#fKd_pembelian").val(),
        tgl: $("#fTgl").val(),
        ket: $("#fKet").val().trim(),
    };
    
    var data = {
        "action": $("#btnSubmit").val(),
        "dataPembelian": dataPembelian,
        // "dataListItem": listItem,
    };

    return data;
}

function submit_pembelian(){
    var data = getDataForm();
    data.dataLisItem = listItem;

    console.log(data);
    $.ajax({
        url : base_url+"app/controllers/Pembelian.php",
        type : "post",
        dataType : "json",
        data: data,
        success: function(hasil){
            if(hasil.status) document.location=base_url+"index.php?m=pembelian&p=list"; // jika berhasil
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

// fungsi aksi edit pembelian
function editPembelian(id){
    $.ajax({
        url: base_url+"app/controllers/Pembelian.php",
        type: "post",
        dataType: "json",
        data: {
            "id" : id,
            "action" : "getEdit",
        },
        success: function(hasil){
            console.log(hasil);
            // isi form pembelian
            $("#id").val(hasil.data.pembelian.id);
            $("#fKd_pembelian").val(hasil.data.pembelian.kd_pembelian);
            $('#fTgl').datepicker('update',hasil.data.pembelian.tgl);
            $("#fKet").val(hasil.data.pembelian.jenis);

            $.each(hasil.data.listItem, function(index, item){
                var index = indexItem++;
                // masukkan data dari server ke array listItem
                var dataItem = {
                    aksi: "edit", status: "", index: index, id: item.id, nama: item.nama,
                    kd_barang: item.kd_barang, qty: parseInt(item.qty),
                    harga: parseInt(item.harga), subTotal: parseInt(item.subtotal),
                    ket: item.ket,
                };
                listItem.push(dataItem);
                $("#tabel_item_pembelian > tbody:last-child").append(
                    "<tr>"+
                    "<td></td>"+ // nomor
                    "<td>"+item.nama+"</td>"+ // item
                    "<td>Rp. "+parseInt(item.harga)+",00</td>"+ // harga
                    "<td>"+fieldQty(parseInt(item.qty), dataItem.index, hasil.respon.qty)+"</td>"+ // qty
                    "<td>"+fieldKeterangan(dataItem.index, item.ket)+"</td>"+ // keterangan
                    "<td>Rp. "+parseInt(item.subtotal)+",00</td>"+
                    "<td>"+btnAksi(dataItem.index, hasil.respon.aksi)+"</td>"+ // aksi
                    "</tr>"
                );
                numberingList();
            });
            getResponse(hasil.respon);
            console.log(listItem);
        },
        error: function (jqXHR, textStatus, errorThrown) { // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
}

// function list data pembelian
    // fungsi protect btn akis dan qty
    function getResponse(respon){
        if(!respon.listItem){
            $('#fKd_barang').prop('disabled',true);
            $('#fQty').prop('readonly',true);
            $('#fHarga').prop('readonly',true);
            $('#fTambah_pembelian').prop('disabled',true);
        }
        if(!respon.qty){
            
        }
        if(!respon.aksi){
            
        }
    }

    // penyesuaian kolom No pada tampilan ketika list dihapus atau ditambah
    function numberingList() {
        $('#tabel_item_pembelian tbody tr').each(function (index) {
            $(this).children("td:eq(0)").html(index + 1);
        });
        $("#tampilHarga").text("Rp. "+hitungTotal());
    }

    // membuat textfield qty pada list
    function fieldQty(qty, index, respon = true){
        var disabled = respon ? '' : 'disabled';
        var field = '<input type="number" min="1" onchange="onChange_qty('+index+',this)" style="width: 5em" class="form-control" value="'+qty+'" '+disabled+'>';
        return field;
    }

    // membuat textfield keterangan pada list
    function fieldKeterangan(index, val=false){
        var ket = val===false ? "" : val;
        var field = '<textarea class="form-control" row="1" onchange="onChange_ket('+index+',this)">'+ket+'</textarea>';
        return field;
    }

    // fungsi cetak btn aksi di tabel
    function btnAksi(index, respon = true){
        var disabled = respon ? '' : 'disabled';
        var btn = '<button type="button" class="btn btn-danger btn-sm bnt-flat" onclick="delList('+index+',this)" title="Hapus dari list" '+disabled+'>'+
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
                item.subTotal = (item.harga*item.qty);
                $(val).parent().parent().children("td:eq(5)").html("Rp. "+item.subTotal+",00"); 
            } 
            // console.log(item);
        });
        numberingList();
        console.log(listItem);
        // console.log($(val).parent().parent().children("td:eq(6)").html("0"));
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

    // dipanggil di fungsi numberingList
    function delList(index, val) {
        $(val).parent().parent().remove(); // hapus data ditabel
        $.each(listItem, function(i, item){
            if(item.index == index) item.status = "hapus";
        });
        numberingList(); // reset ulang nomer
        console.log(listItem);
    }

    // fungsi hitung total dari array
    function hitungTotal(){
        var total = 0;
        $.each(listItem, function(i, item){
            // selain hapus lakukan perhitungan
            if(item.status !== "hapus") total += item.subTotal;
        });

        return total.toFixed(2);
    }

    // bersihkan kolom data barang
    function clearBarang() {
        $('#fKd_barang').select2().val('').trigger('change'); // memngembalikan option barang ke default
        $("#fQty").val(0);
        $("#fHarga").val(0);
        $("#fKd_barang").focus();
    }

// ======================================= 

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
        url: base_url+"app/controllers/Pembelian.php",
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
        error: function (jqXHR, textStatus, errorThrown){ // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            console.log(jqXHR, textStatus, errorThrown);
            // location.reload();
        }
    });
}

// fungsi set kode pembelian
function setKdPembelian(idSelect){

    $.ajax({
        url: base_url+"app/controllers/Pembelian.php",
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

function setError(error){
    // tanggal
    if(!jQuery.isEmptyObject(error.tglError)){
        $(".field-tgl").addClass('has-error');
        $(".field-tgl span.help-block").text(error.tglError);
    }
    else{
        $('.field-tgl').removeClass('has-error');
        $(".field-tgl span.help-block").text('');
    }

    // keterangan
    if(!jQuery.isEmptyObject(error.ketError)){
        $(".field-ket").addClass('has-error');
        $(".field-ket span.help-block").text(error.ketError);
    }   
    else{
        $('.field-ket').removeClass('has-error');
        $(".field-ket span.help-block").text('');
    }
}

function setValue(value){
    $('#fTgl').datepicker('update',value.tgl);
    $('#fKet').val(value.ket);
}