$(function(){
    // setting export

    // setting datepicker fmTgl
    $("#fmTgl").datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "bottom auto",
        todayBtn: true,
        todayHighlight: true,
    });

    // setting datepicker fmBln
    $("#fmBln").datepicker({
        autoclose: true,
        format: "MM yyyy",
        minViewMode: 1,
        orientation: "bottom auto",
    });

    // btn excelBarang onclick
    $("#exportExcel").click(function(){
        set_allBtn_disable(); // disable semua btn modal
        $('#form_modal_export').trigger('reset'); // reset form modal
        // tampilkan modal
        $("#btn_export_submit").addClass("btn-success");
        $("#btn_export_submit").removeClass("btn-danger");
        $("#modal_export .modal-title").html("Export Excel"); // setting header
        $("#modal_export").modal();
    });

    // btn pdfBarang onclick
    $("#exportPdf").click(function(){
        set_allBtn_disable(); // disable semua btn modal
        $('#form_modal_export').trigger('reset'); // reset form modal
        // tampilkan modal
        $("#btn_export_submit").addClass("btn-danger");
        $("#btn_export_submit").removeClass("btn-success");
        $("#modal_export .modal-title").html("Export Pdf"); // setting header
        $("#modal_export").modal();
    });

    // pilihan jenis export
    $("#fmJenis").change(function(){
        var value = this.value;
        if(value === ""){ // jika tidak dipilih 
            $('#form_modal_export').trigger('reset'); // reset form modal
            // semua field disable
            set_allBtn_disable();
        }
        else if(value === "harian"){ // jika harian
            set_allF_clear(); // bersihkan form
            // field bulan disable
            $("#fmBln").prop("disabled", true);
            // field tgl aktif
            $("#fmTgl").prop("disabled", false);
        }
        else if(value === "bulanan"){ // jika bulanan
            set_allF_clear(); // bersihkan form
            // field tgl disable
            $("#fmTgl").prop("disabled", true);
            // field bln aktif
            $("#fmBln").prop("disabled", false);
        }
    });

    // submit form modal export
    $("#form_modal_export").submit(function(){
        var jenis = $("#fmJenis").val().trim();
        // validasi
        if(jenis === ""){ // jika tidak dipilih
            swal("Pesan", "Jenis Pilihan Export Data Belum Dipilih", "warning");
            return false;
        }
        else if(jenis === "harian"){ 
            if($("#fmTgl").val().trim() === ""){ //jika tgl kosong
                swal("Pesan", "Tanggal Belum Diisi", "warning");
                return false;
            }
            else{ // lakukan ajax
                swal("doing ajax");
            }
        }
        else if(jenis === "bulanan"){
            if($("#fmBln").val().trim() === ""){ // jika bln kosong
                swal("Pesan", "Bulan Belum Diisi", "warning");
                return false;
            }
            else{ // lakukan ajax
                swal("doing ajax");
            }
        }

        return false;
    });

    // fungsi untuk setting disable btn
    function set_allBtn_disable(){
        $("#fmTgl").prop("disabled", true);
        $("#fmBln").prop("disabled", true);
    }

    // fungsi untuk bersihkan field
    function set_allF_clear(){
        $("#fmTgl").val("");
        $("#fmBln").val("");
    }

    // fungsi get report sesuai tgl/bln yg dipilih dgn ajax
    function getReport(){

    }
});
    