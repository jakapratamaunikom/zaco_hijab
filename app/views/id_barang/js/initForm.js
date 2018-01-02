$(document).ready(function(){
    // btn tambah id barang onclick
    $("#btn_tambahIdBarang").click(function(){
        // reset pesan error
        reset_form();
        // tampilkan modal
        $("#modal_idBarang .modal-title").html("Form Tambah Data Id Barang"); // ganti heade form
        $("#btn_submit_idBarang").prop("value", "Tambah");
        $("#modal_idBarang").modal();
    });

    // submit form modal tambah id barang
    $("#form_modal_idBarang").submit(function(e){
        e.preventDefault();
        submit();
        return false;
    });
});

function submit(){
    var id = $("#id_barang").val().trim();
    var id_barang = $("#id_idBarang").val().trim();
    var nama = $("#nama_idBarang").val().trim();
    var submit = $("#btn_submit_idBarang").val();

    // request action
    $.ajax({
        url: base_url+"app/controllers/Id_barang.php",
        type: "post",
        dataType: "json",
        data: {
            "id" : id,
            "id_barang" : id_barang,
            "nama" : nama,
            "action" : submit,
        },
        beforeSend: function(){
            setLoading();
        },
        success: function(hasil){
            setLoading(false);
            // cek hasil dari ajax
            // cek statusnya
            if(hasil.status){ // jika status true
                reset_form(); 
                $("#modal_idBarang").modal('hide');
                // cek jenis actionya
                if(submit.toLowerCase()==="edit") alertify.success('Data Berhasil Diedit'); // jika edit
                else alertify.success('Data Berhasil Ditambah'); // jika tambah
                $("#tabel_id_barang").DataTable().ajax.reload(); // reload tabel
            }
            else{ // jika status false
                // cek jenis error
                if(hasil.errorDb){ // jika ada error database
                    swal("Pesan Error", "Koneksi Database Error, Silahkan Coba Lagi", "error")
                    reset_form();
                    $("#form_modal_idBarang").modal('hide');
                }
                else{
                    reset_form();
                    // cek apakah duplikat
                    if(hasil.duplikat){ // jika duplikat
                        $("#fmId_barang").parent().find('.help-block').text("Id Barang Sudah Ada, Harap Ganti Dengan Yang Lainnya !");
                        $("#fmId_barang").closest('div').addClass('has-error');
                    }
                    else{
                        // set error
                        if(submit.toLowerCase()==="edit") $("#fmId_barang").prop("disabled", true);
                        setError(hasil.pesanError);
                    }
                    // set value
                    setValue(hasil.set_value);
                }   
            }

            console.log(hasil);
        },
        error: function (jqXHR, textStatus, errorThrown){ // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            $("#modal_idBarang").modal('hide');
            reset_form();
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
}

// fungsi get data edit
function edit_id_barang(id){
    $.ajax({
        url: base_url+"app/controllers/Id_barang.php",
        type: "post",
        dataType: "json",
        data: {
            "id" : id,
            "action" : "getEdit",
        },
        beforeSend: function(){
            setLoading();
        },
        success: function(data){
            setLoading(false);
            // reset modal
            reset_form();
            // tampilkan modal
            $("#modal_idBarang .modal-title").html("Form Edit Data Id Barang");
            $("#id_barang").val(data.id);
            $("#fmId_barang").val(data.id_barang);
            $("#fmNama_idBarang").val(data.nama);
            $("#fmId_barang").prop("disabled", true);
            $("#btn_submit_idBarang").prop("value", "Edit");
            $("#modal_idBarang").modal();
        },
        error: function (jqXHR, textStatus, errorThrown){ // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            $(".overlay").css("display", "none");
            $("#modal_idBarang").modal('hide');
            reset_form();
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
}

// fungsi reset error, value, dll di form
function reset_form(){
    // reset pesan error
    $("#fmId_barang").parent().find('.help-block').text("");
    $("#fmId_barang").closest('div').removeClass('has-error');
    $("#fmNama_idBarang").parent().find('.help-block').text("");
    $("#fmNama_idBarang").closest('div').removeClass('has-error');
    // bersihkan form
    $('#form_modal_idBarang').trigger('reset');
    $("#fmId_barang").prop("disabled", false);
}

// fungsi set error
function setError(error){
    // set error fmId_barang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(error.id_barangError)){
        $("#fmId_barang").parent().find('.help-block').text(error.id_barangError);
        $("#fmId_barang").closest('div').addClass('has-error');
    }
    else{
        $("#fmId_barang").parent().find('.help-block').text("");
        $("#fmId_barang").closest('div').removeClass('has-error');
    }
    
    // set error fmNama_idBarang
    // jika ada pesan error
    if(!jQuery.isEmptyObject(error.namaBarangError)){
        $("#fmNama_idBarang").parent().find('.help-block').text(error.namaBarangError);
        $("#fmNama_idBarang").closest('div').addClass('has-error');
    }
    else{
        $("#fmNama_idBarang").parent().find('.help-block').text("");
        $("#fmNama_idBarang").closest('div').removeClass('has-error');
    }   
}

// fungsi set value
function setValue(value){
    $("#fmId_barang").val(value.id_barang);
    $("#fmNama_idBarang").val(value.namaBarang);
}

function setLoading(block=true){
    if(block === true){
        $('.modal-content').block({
            message: '<h4><img src="'+base_url+'assets/gambar/busy.gif" /> Mohon Menunggu...</h4>',
            css: {
                border: '1px solid #fff'
            }
        });
    }
    else $('.modal-content').unblock();
}