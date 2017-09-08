<div class="modal fade" id="modal_idBarang">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <!-- button close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <!-- header modal -->
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form_modal_idBarang" role=form>
                    <input type="hidden" name="id_barang" id="id_barang">
                    <!-- field id barang -->
                    <div class="form-group">
                        <label for="fmId_barang">Id Barang</label>
                        <input type="text" name="fmId_barang" id="fmId_barang" class="form-control" placeholder="Masukkan ID Barang">
                        <span class="help-block small"></span>
                    </div>
                    <!-- field nama -->
                    <div class="form-group">
                        <label for="fmNama_idBarang">Nama</label>
                        <input type="text" name="fmNama_idBarang" id="fmNama_idBarang" class="form-control" placeholder="Masukkan Nama Barang">
                        <span class="help-block small"></span>
                    </div>
            </div>
            <div class="box-footer">
                <input class="btn btn-info pull-right btn-flat" type="submit" id="btn_submit_idBarang" name="action" value="Tambah">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>