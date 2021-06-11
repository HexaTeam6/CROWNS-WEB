<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <form method="POST" class="form-delete" name="form-delete-name" id="myform">
          @csrf
          @method('DELETE')
          <input type="hidden" name="id" id="btn-id">
          <input type="hidden" name="id_penjahit" id="penjahit-id">
          <input type="hidden" name="id_konsumen" id="konsumen-id">
          <button type="submit" class="btn btn-primary">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Modal -->