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
    <h1>Form Data Pembelian</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url ?>"><i class="fa fa-dashboard"></i> Zaco Hijab</a></li>
        <li class="active"><a href="<?= base_url."index.php?m=pembelian&p=list"; ?>">Pembelian</a></li>
        <li>Form Data Pembelian</li>
    </ol>
</section>

 <!-- isi konten -->
<section class="content">
    <form enctype="multipart/form-data" role="form" id="form_pembelian">
        <input type="hidden" name="id" id="id">
        <!-- panel 1 -->
        <div class="row">
            <div class="col-md-12">
                <!-- panel data pembelian -->
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-6">
                            <fieldset>
                                <legend>Data Pembelian</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- kode pembelian -->
                                        <div class="form-group">
                                            <label for="fKd_pembelian">Kode Pembelian</label>
                                            <input type="text" name="fKd_pembelian" id="fKd_pembelian" class="form-control" placeholder="Masukkan Kode Pembelian" readonly>
                                            <span class="help-block small"></span>  
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- tanggal -->
                                        <div class="form-group">
                                            <label for="fTgl">Tanggal</label>
                                            <input type="text" name="fTgl" id="fTgl" class="form-control datepicker">
                                            <span class="help-block small"></span> <!-- Tampilan Validasi -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fKet">Keterangan</label>
                                    <textarea id="fKet" class="form-control" placeholder="Masukkan Keterangan Pembelian"></textarea>
                                </div>       
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset>
                                <legend>Data Barang</legend>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="fKd_barang">Barang</label>
                                            <select id="fKd_barang" name="fKd_barang" class="form-control select2" style="width: 100%;">
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="fQty">Qty (pcs)</label>
                                            <div class="input-group">
                                                <input type="number" id="fQty" name="fQty" class="form-control" min="0" placeholder="Qty">
                                                <span class="input-group-addon">pcs</span>
                                            </div>
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
                                                <input class="form-control" placeholder="Masukkan Harga" id="fHarga" name="fHarga" type="number" min="0">
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
                            <legend>List Item</legend>
                            <div class="table-responsive">
                               <table id="tabel_item_pembelian" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 15px">No</th>
                                            <th>Item</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Keterangan</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!-- tbody agar bisa ditambah saat button +barang di klik -->
                                    <tbody></tbody>
                                </table>
                            </div>
                            <h4 id="tampilHarga" class="text-right">Total: Rp. -,00</h4>  
                        </fieldset>
                    </div>
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-default btn-lg btn-flat" id="btnSubmit" value="<?= $btn ?>">
                            <i class="fa fa-plus"></i> <?= ucfirst($btn); ?>
                        </button>
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
<script type="text/javascript">
    var listItem = [];
    var indexItem = 0;
</script>
<script type="text/javascript">

    // inisialisasui variabel untuk aksi edit
    //    -> dataHapus, untuk menampung data yang terhapus dari list
    //    -> tglEdit, untuk menampung tanggal pembelian yg diedit
    // var dataHapus = [];
    // var tglEdit = "";

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

        if(cekEdit) getInfoPembelian(urlParams.id);
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
            // if($(this).val()==="tambah"){
            //     addPembelian();
            // }else if($(this).val()==="edit"){
            //     editPembelian();
                
            // }
            submit_pembelian();

            return false;
        });

    });


    // fungsi tambah pembelian - tambah list
    function addPembelian(){

        // inisialisasi
        // data -> untuk menampung list barang
        // cek -> untuk validasi textfield pada listbarang
        // var data = new Array(); 
        // var cek = true;
        // var kd_pembelian = $('#fKd_pembelian').val().trim();
        // var tgl = $('#fTgl').val().trim();
        
        // // menyimpan data ke array ketika data akan ditambah
        // $('#tabel_item_pembelian tbody tr').each(function (index) {
        //     //menampilkan isi dari kolom no
        //     var kd_barang = $(this).children("td:eq(1)").children().html().trim();
        //     var harga = $(this).children("td:eq(2)").html().substr(4).trim();
        //     var qty = $(this).children("td:eq(3)").children().val().trim();
        //     var ket = $(this).children("td:eq(4)").children().val().trim();

        //     if((qty=="")||(isNaN(qty))){
        //         cek = false;
        //     }else{
        //         if(ket=="") ket="-";
        //         data.push({
        //             kd_barang : kd_barang,
        //             harga : harga,
        //             qty : qty,
        //             ket : ket,
        //         });
        //     }           
            
        // });

        
        // if(cek){
        //     var dataPembelian = {
        //         kd_pembelian : kd_pembelian,
        //         tgl : tgl,
        //         listBarang : data,
        //     }

        //     // fungsi ajax untuk action add
        //     if(data.length>0){
        //         getResponseAddPembelian(dataPembelian);
        //     }else{
        //         alertify.error('List Item Kosong');
        //     }
            
        // }else{
        //     alertify.error('Qty pada list ada yang kosong atau tidak sesuai');
        // }

        var index = indexItem++;
        var item_text = $("#fKd_barang").select2('data')[0].text;
        var item_val = $("#fKd_barang").val();
        var qty = parseInt($("#fQty").val());
        var harga = parseInt($("#fHarga").val());
        var subTotal = qty*harga;
        // // cek jika value option barang masih default set text kosong
        // if(item_val.length <= 0){
        //     item_text = "";
        // }
        var dataForm = {
            aksi: "tambah", status: "", index: index, id: "",
            nama: item_text, kd_barang: item_val, qty: qty,
            harga: harga, subTotal: subTotal, ket: "",

            // kd_barang : item_val,
            // qty : qty,
            // harga : harga,
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
                clearBarang();
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
    function editPembelian(){

        // cek apakah tgl dari db sama dengan tanggal sekarang
        //    -> tglEdit, tanggal dari db pembelian
        //    -> getTanggal, tanggal sekarang
        if(tglEdit==getTanggal()){

            alertify.success('success');

            // $.ajax({
            //     url : base_url+"module/pembelian/action.php",
            //     type : "post",
            //     dataType : "json",
            //     data: {
            //         "dataPembelian" : data,
            //         "action" : 'tambah',
            //     },
            //     success: function(hasil){
            //         if(hasil.status){
            //             document.location=base_url+"index.php?m=pembelian&p=list";
            //         }else{
            //             if(hasil.errorDb){ // jika ada error database
            //                 swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error");
            //             }
            //         }
            //     },
            //     error: function (jqXHR, textStatus, errorThrown) // error handling
            //     {
            //         swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            //         clearBarang();
            //         console.log(jqXHR, textStatus, errorThrown);
            //     }              
            // });

        }else{   //jika beda tanggal tidak bisa edit
            alertify.error('Hanya bisa edit pembelian pada hari ini');
        }
    }
    

    // aksi delete List pembelian
    // dipanggil di fungsi numberingList
    function delList(index, val) {
       
        // var ada = false;
        // var barang = $(index).parent().parent().children("td:eq(1)").children().html().trim();

        // // cek apakah kode barang sudah ada pada dataHapus
        // for(var i=0;i<dataHapus.length;i++){
        //     if(dataHapus[i].kd_barang==barang) {
        //         ada = true;
        //     }
        // }

        // // mencatat data yg dihapus untuk keperluan edit
        // // 
        // // jika dalam dataHapus tidak ada kode_barang yg sama -> push/catat
        // if(!ada){
        //     dataHapus.push({
        //         kd_pembelian : $('#fKd_pembelian').val(),
        //         kd_barang : barang,
        //     });
        // }

        // $(index).parent().parent().remove();

        // // console.log(dataHapus);
        // // penyesuaian kolom No pada tampilan ketika list dihapus
        // numberingList();

        $(val).parent().parent().remove(); // hapus data ditabel
        $.each(listItem, function(i, item){
            if(item.index == index) item.status = "hapus";
        });
        numberingList(); // reset ulang nomer
        console.log(listItem);
    }

    // bersihkan kolom data barang
    function clearBarang() {
        $('#fKd_barang').select2().val('').trigger('change'); // memngembalikan option barang ke default
        $("#fQty").val(0);
        $("#fHarga").val(0);
        $("#fKd_barang").focus();
    }

    // membuat textfield keterangan pada list
    function fieldKeterangan(index, val=false){
        var ket = val===false ? "" : val;
        var field = '<textarea class="form-control" row="1" onchange="onChange_ket('+index+',this)">'+ket+'</textarea>';
        return field;
    }

    // membuat textfield qty pada list
    function fieldQty(qty, index){
        var field = '<input type="number" min="1" onchange="onChange_qty('+index+',this)" style="width: 5em" class="form-control" value="'+qty+'">';
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

    // penyesuaian kolom No pada tampilan ketika list dihapus atau ditambah
    function numberingList() {
        // variabel untuk menhitung total barang
        // var total = 0;
        // var hrg = 0;

        // $('#tabel_item_pembelian tbody tr').each(function (index) {
        //     $(this).children("td:eq(0)").html(index + 1);

        //     // membuat tombol hapuslist
        //     var btn = '<button type="button" class="btn btn-danger btn-sm" id="hapusList'+index+'" title="Hapus dari list">'+
        //                     '<i class="fa fa-trash">'+
        //               '</button>';


        //     $(this).children("td:eq(5)").html(btn);

        //     $('#hapusList'+index).click(function(){
        //         // memanggil fungsi delList
        //         delList(this);
        //     });

        //     // operasi untuk menghitung total
        //     hrg = $(this).children("td:eq(2)").html().substr(4);
        //     total += parseInt(hrg);
        // });
        
        // // menampilkan total
        // $('#tampilHarga').children().html('Total: Rp. '+total+',00');

        $('#tabel_item_pembelian tbody tr').each(function (index) {
            $(this).children("td:eq(0)").html(index + 1);
        });
        $("#tampilHarga").text("Rp. "+hitungTotal());
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

    // cek barang pada list
    function validBarang(barangIn){
        var ada = false;
        
        $.each(listItem, function(i, item){
            if(barangIn==item.kd_barang && item.status != "hapus") ada = true;
        });

        // $('#tabel_item_pembelian tbody tr').each(function (index) {

        //     //mendapatkan kd barang dari list
        //     var barangList = $(this).children("td:eq(1)").children().html().trim();

        //     // cek apakah barang yg akan ditambahkan ke list sudah ada di list
        //     if(barangIn==barangList) ada = true;
        // });

        return ada;
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

    // mendapatkan informasi pembelian (edit)
    function getInfoPembelian(id) {
    

        $.ajax({
            url: base_url+"app/controllers/Pembelian.php",
            type: "post",
            dataType: "json",
            data: {
                "id" : id,
                "action" : "getEdit",
            },
            success: function(data){

                // mendapatkan data untukkeperluan aksi edit
                //     -> tglEdit, tgl pembelian dari db 
                //     
                tglEdit = data.info[0][0].tgl;

                // setting textfield dengan data dari tabel pembelian
                $('#fKd_pembelian').val(data.info[0][0].kd_pembelian);
                $('#fTgl').val(data.info[0][0].tgl);

                 

                // mendapatkan list barang dan menampilkannya pada list
                $.each(data.info[1],function(i,val){

                    $('#tabel_item_pembelian > tbody:last-child').append(
                        '<tr id="baris">'+
                            '<td></td>'+
                            '<td><div style="display: none;">'+val.kd_barang+'</div>'+val.nama+'</td>'+
                            '<td>Rp. '+val.subtotal+'</td>'+
                            '<td>'+fieldQty(val.qty)+'</td>'+
                            '<td>'+fieldKeterangan()+'</td>'+
                            '<td></td>'+
                        '</tr>'
                    );

                    // penyesuaian kolom No pada tampilan ketika list ditambah
                    numberingList();
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

    // memmanggil fungsi actionAdd
    // function getResponseAddPembelian(data){
    //     $.ajax({
    //         url : base_url+"app/controllers/Pembelian.php",
    //         type : "post",
    //         dataType : "json",
    //         data: {
    //             "dataPembelian" : data,
    //             "action" : 'tambah',
    //         },
    //         success: function(hasil){
    //             if(hasil.status){
    //                 document.location=base_url+"index.php?m=pengeluaran&p=list";
    //             }else{
    //                 if(hasil.errorDb){ // jika ada error database
    //                     swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error");
    //                 }
    //             }
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) // error handling
    //         {
    //             swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
    //             clearBarang();
    //             console.log(jqXHR, textStatus, errorThrown);
    //         }              
    //     });
    // }
</script>