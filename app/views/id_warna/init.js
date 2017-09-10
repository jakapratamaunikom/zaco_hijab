$(document).ready(function(){
	
    //setting datatable
    var tabel_id_warna = $("#tabel_id_warna").DataTable({
		"language" : {
            "lengthMenu": "Tampilkan _MENU_ data/page",
            "zeroRecords": "Data Tidak Ada",
            "info": "Menampilkan _START_ s.d _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 s.d 0 dari 0 data",
            "search": "Pencarian:",
            "loadingRecords": "Loading...",
            "processing": "Processing...",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        },
        "lengthMenu": [ 25, 50, 75, 100 ],
        "pageLength": 25,
        order: [],
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url+"app/controllers/Id_warna.php",
            type: 'POST',
            data: {
                "action" : "list",
            }
        },
        "columnDefs": [
            {
                "targets":[0, 3], // disable order di kolom 1 dan 3
                "orderable":false,
            }
        ],
	});

    // setting form tambah id barang
         // btn tambah id barang onclick
        $("#btn_tambahIdWarna").click(function(){
            // reset pesan error
            reset_form();
            // tampilkan modal
            $("#modal_idWarna .modal-title").html("Form Tambah Data Id Warna"); // ganti heade form
            $("#submit_idWarna").prop("value", "Tambah");
            $("#modal_idWarna").modal();
        });

        // submit form modal tambah id barang
        $("#form_modal_idWarna").submit(function(e){
            e.preventDefault();

            var id = $("#id_warna").val().trim();
            var id_warna = $("#fmId_warna").val().trim();
            var nama = $("#fmNama_idWarna").val().trim();
            var submit = $("#submit_idWarna").val();

           // request action
            $.ajax({
                url: base_url+"app/controllers/Id_warna.php",
                type: "post",
                dataType: "json",
                data: {
                    "id" : id,
                    "id_warna" : id_warna,
                    "nama" : nama,
                    "action" : submit,
                },
                success: function(hasil){

                    // cek hasil dari ajax
                    // cek statusnya
                    if(hasil.status){ // jika status true
                        reset_form(); 
                        $("#modal_idWarna").modal('hide');
                        // cek jenis actionya
                        if(submit.toLowerCase()==="edit") alertify.success('Data Berhasil Diedit'); // jika edit
                        else alertify.success('Data Berhasil Ditambah'); // jika tambah
                        tabel_id_warna.ajax.reload(); // reload tabel
                    }
                    else{ // jika status false
                        // cek jenis error
                        if(hasil.errorDb){ // jika ada error database
                            swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
                            reset_form();
                            $("#form_modal_idWarna").modal('hide');
                        }
                        else{
                            reset_form();
                            // cek apakah duplikat
                            if(hasil.duplikat){ // jika duplikat
                                $("#fmId_warna").parent().find('.help-block').text("Id Warna Sudah Ada, Harap Ganti Dengan Yang Lainnya !");
                                $("#fmId_warna").closest('div').addClass('has-error');
                            }
                            else{
                                if(submit.toLowerCase()==="edit") $("#fmId_warna").prop("disabled", true);
                                setError(hasil);
                            }
                            // set value
                            setValue(hasil);
                        }   
                    }

                    console.log(hasil);
                },
                error: function (jqXHR, textStatus, errorThrown) // error handling
                {
                    swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
                    $("#modal_idWarna").modal('hide');
                    reset_form();
                    console.log(jqXHR, textStatus, errorThrown);
                }
            })

            return false;
        });
    //===================================================================//
});

// fungsi get data edit
function edit_id_warna(id){
    $.ajax({
        url: base_url+"app/controllers/Id_warna.php",
        type: "post",
        dataType: "json",
        data: {
            "id" : id,
            "action" : "getEdit",
        },
        beforeSend: function(){
            $(".overlay").css("display", "block"); // tampilkan loading, jikalau saat req. memakan waktu lama
        },
        success: function(data){
            $(".overlay").css("display", "none");
            // reset modal
            reset_form();
            // tampilkan modal
            $("#modal_idWarna .modal-title").html("Form Edit Data Id Warna");
            $("#id_warna").val(data.id);
            $("#fmId_warna").val(data.id_warna);
            $("#fmNama_idWarna").val(data.nama);
            $("#fmId_warna").prop("disabled", true);
            $("#submit_idWarna").prop("value", "Edit");
            $("#modal_idWarna").modal();
        },
        error: function (jqXHR, textStatus, errorThrown) // error handling
        {
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            $(".overlay").css("display", "none");
            $("#modal_idWarna").modal('hide');
            reset_form();
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
}

function reset_form(){
    // reset pesan error
    $("#fmId_warna").parent().find('.help-block').text("");
    $("#fmId_warna").closest('div').removeClass('has-error');
    $("#fmNama_idWarna").parent().find('.help-block').text("");
    $("#fmNama_idWarna").closest('div').removeClass('has-error');
    // bersihkan form
    $('#form_modal_idWarna').trigger('reset');
    $("#fmId_warna").prop("disabled", false);
}

// fungsi set error
function setError(hasil){
    // set error fId_barang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.id_warnaError)){
        $("#fmId_warna").parent().find('.help-block').text(hasil.pesanError.id_warnaError);
        $("#fmId_warna").closest('div').addClass('has-error');
    }
    else{
        $("#fmId_warna").parent().find('.help-block').text("");
        $("#fmId_warna").closest('div').removeClass('has-error');
    }
    
    // set error fNama_idBarang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(hasil.pesanError.namaWarnaError)){
        $("#fmNama_idWarna").parent().find('.help-block').text(hasil.pesanError.namaWarnaError);
        $("#fmNama_idWarna").closest('div').addClass('has-error');
    }
    else{
        $("#fmNama_idWarna").parent().find('.help-block').text("");
        $("#fmNama_idWarna").closest('div').removeClass('has-error');
    }   
}

// fungsi set value
function setValue(hasil){
    $("#fmId_warna").val(hasil.set_value.id_warna);
    $("#fmNama_idWarna").val(hasil.set_value.namaWarna);
}