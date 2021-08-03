<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="validasiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="validasiModalLabel">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin memvalidasi pembayaran ini?
        <img class="m-2" alt="unavailable" id="bukti-bayar" style="max-width: 500px;">
        <form method="POST" name="form-validate-name" id="myform">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="btn-id">
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Tutup</button>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <select class="form-control" name="validasi">
                    <option value="4" class="text-success">Terima Validasi</option>
                    <option value="3" class="text-yellow">Tunda Validasi</option>
                    <option value="2" class="text-danger">Tolak Validasi</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary form-control">Validasi</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Modal -->

