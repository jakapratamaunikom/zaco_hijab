<div class="modal fade" id="modal_idWarna">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <!-- button close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <!-- header modal -->
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form_modal_idWarna" role=form>
                    <input type="hidden" name="id_warna" id="id_warna">
                    <!-- field id warna -->
                    <div class="form-group">
                        <label for="fId_warna">Id Warna</label>
                        <input type="text" name="fId_warna" id="fId_warna" class="form-control" placeholder="Masukkan ID Warna">
                        <span class="help-block small"></span>
                    </div>
                    <!-- field nama -->
                    <div class="form-group">
                        <label for="fNama_idWarna">Nama</label>
                        <input type="text" name="fNama_idWarna" id="fNama_idWarna" class="form-control" placeholder="Masukkan Warna">
                        <span class="help-block small"></span>
                    </div>
            </div>
            <div class="box-footer">
                <input class="btn btn-info pull-right" type="submit" id="submit_idWarna" name="action" value="Tambah">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>