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
        Apakah Anda yakin memvalidasi pembayaran ini?
        <img src="{{ asset('gallery/images/foto-61.png') }}" alt="unavailable">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <form method="POST" class="form-validate" name="form-validate-name" id="myform">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="btn-id">
          <button type="submit" class="btn btn-primary">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Modal -->