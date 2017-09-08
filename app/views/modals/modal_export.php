<!-- modal export -->
<div class="modal fade" id="modal_export">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <!-- button close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <!-- header modal -->
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form_modal_export" role="form" enctype="multipart/form-data">
                    <!-- field jenis -->
                    <div class="form-group">
                        <label for="fmJenis">Jenis</label>
                        <select id="fmJenis" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="harian">Harian</option>
                            <option value="bulanan">Bulanan</option>
                        </select>
                    </div>
                   <!-- tanggal -->
                    <div class="form-group">
                        <label for="fmTgl">Tanggal</label>
                        <input type="text" name="fmTgl" id="fmTgl" class="form-control datepicker">
                    </div>
                    <!-- bulan - tahun -->
                    <div class="form-group">
                        <label for="fmBln">Bulan</label>
                        <input type="text" name="fmBln" id="fmBln" class="form-control datepicker">
                    </div>
            </div>
            <div class="box-footer">
                <button class="btn pull-right btn-flat" type="submit" id="btn_export_submit">Export</button>
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>