@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			@include('components.header.link')
      
      <!-- message -->
      @if(Session::has('success'))
      <div class="alert alert-success">
          {{Session::get('success')}}
      </div>
      @endif
      @if(Session::has('gagal'))
      <div class="alert alert-danger">
          {{Session::get('gagal')}}
      </div>
      @endif
		</div>
	</div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		
		<div class="col-xl-12 order-xl-1">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-11">
							<h3 class="mb-0">
								Pesanan
								<i class="ni 
									<?php 
										if ($pembayaran->status_pembayaran == '4') echo 'ni-check-bold text-success'; 
										if ($pembayaran->status_pembayaran == '3') echo 'ni-fat-delete text-yellow';
										if ($pembayaran->status_pembayaran == '2') echo 'ni-fat-remove text-danger';
									?>"
								></i>
							</h3>
						</div>
						<a class="btn btn-neutral float-right col-1" href="{{ route('pesanan') }}">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('pesanan.validate.pembayaran', ['id' => $pembayaran->pesanan->id]) }}" method="POST">
						@csrf
						@method('PUT')
						<input type="hidden" value="{{ $pembayaran->pesanan->id }}">
						<h6 class="heading-small text-muted mb-4">Info Detail Pesanan</h6>
						
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Penjahit <i class="ni ni-badge text-primary"></i></label>
										<input type="text" class="form-control" placeholder="Nama" value="
											<?php
												if (!isset($pembayaran->pesanan->penjahit))
												echo 'data user tidak ada';
												else echo $pembayaran->pesanan->penjahit->nama;
											?>
											" name="biaya_jahit">
									</div>
								</div>

								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Konsumen <i class="ni ni-single-02 text-primary"></i></label>
										<input type="text" class="form-control" placeholder="Nama" value="
										<?php
											if (!isset($pembayaran->pesanan->pembeli))
											 echo 'data user tidak ada';
											else echo $pembayaran->pesanan->pembeli->nama;
										?>
										" name="biaya_jahit">
									</div>
								</div>

								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Dibuat pada <i class="ni ni-watch-time text-primary"></i></label>
										<input type="datetime" class="form-control" placeholder="Nama" value="{{ $pembayaran->pesanan->created_at }}" name="created_at">
									</div>
								</div>

								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Diperbarui pada <i class="ni ni-watch-time text-primary"></i></label>
										<input type="datetime" class="form-control" placeholder="Nama" value="{{ $pembayaran->pesanan->updated_at }}" name="updated_at">
									</div>
								</div>
							</div>
						</div>
						
						<div class="pl-lg-4">
							<h6 class="heading-small text-muted mb-1">
								Status Pesanan: 
								<?php 
									if ($pembayaran->pesanan->status_pesanan == '5') echo 'Pesanan selesai'; 
									if ($pembayaran->pesanan->status_pesanan == '4') {
										if ($pembayaran->status_pembayaran == '4') echo 'Sedang dikerjakan penjahit';
										if ($pembayaran->status_pembayaran == '3') echo 'Menunggu konfirmasi pembayaran';
										if ($pembayaran->status_pembayaran == '2') echo 'Pembayaran ditolak';
									}
									if ($pembayaran->pesanan->status_pesanan == '3') {
										if ($pembayaran->status_pembayaran == '2') echo 'Menunggu bukti pembayaran';
										if ($pembayaran->status_pembayaran == '1') echo 'Menunggu harga dari penjahit';
									}
									if ($pembayaran->pesanan->status_pesanan == '2') echo 'Menunggu pengisian data lokasi';
									if ($pembayaran->pesanan->status_pesanan == '1') echo 'Pesanan masih kosong';
								?>
							</h6>
							<h6 class="heading-small mb-4
								<?php 
									if ($pembayaran->status_pembayaran == '4') echo 'text-success'; 
									if ($pembayaran->status_pembayaran == '3') echo 'text-yellow';
									if ($pembayaran->status_pembayaran == '2') echo 'text-danger';
								?>
							">
								Status Pembayaran: 
								<?php 
									if ($pembayaran->status_pembayaran == '4') echo 'diterima'; 
									if ($pembayaran->status_pembayaran == '3') echo 'menunggu dikonfirmasi';
									if ($pembayaran->status_pembayaran == '2') echo 'ditolak';
								?>
							</h6>
						</div>
						<hr class="my-4" />

						<h6 class="heading-small text-muted mb-4">Detail Pembayaran</h6>
						<div class="pl-lg-4">
							<h6 class="form-control-label">Estimasi hari: <?php if($pembayaran->pesanan->tawar) echo $pembayaran->pesanan->tawar->hari_tawar ?> <i class="ni ni-calendar-grid-58 text-info"></i></h6>
						</div>

						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Jahit <i class="ni ni ni-money-coins text-info"></i></label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->biaya_jahit }}" name="biaya_jahit">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Material <i class="ni ni ni-money-coins text-info"></i></label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->biaya_material }}" name="biaya_material">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Kirim <i class="ni ni ni-money-coins text-info"></i></label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->biaya_kirim }}" name="biaya_kirim">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Jemput <i class="ni ni ni-money-coins text-info"></i></label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->biaya_jemput }}" name="biaya_jemput">
									</div>
								</div>
							</div>
						</div>

						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Total (yang harus dikirim) <i class="ni ni ni-money-coins text-info"></i></label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->pesanan->biaya_total }}" name="biaya_total">
									</div>
								</div>
							</div>
						</div>

						<hr class="my-4" />
						<h6 class="heading-small text-muted mb-4">Desain Baju</h6>
						<div class="pl-lg-4">
							<?php
								if($pembayaran->pesanan->baju) {
							?>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<label class="form-control-label" for="input-first-name">Baju</label>
											<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->pesanan->baju->nama }}" name="biaya_total">
										</div>
									</div>
								</div>
								<img src="{{ $pembayaran->pesanan->baju->foto }}" alt="fail to load image" style="max-width: 500px; max-height: 500px;">
									<?php
										}
										else if($pembayaran->pesanan->designKustom) {
									?>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<label class="form-control-label" for="input-first-name">Baju (design kustom)<i class="ni ni-single-02 mr-3"></i></label>
										</div>
									</div>
								</div>
								@foreach($pembayaran->pesanan->designKustom as $baju)
									<img src="{{ $baju->foto }}" alt="fail to load image" style="max-width: 500px; max-height: 500px;">
								@endforeach
							<?php
								}
							?>
						</div>

						<hr class="my-4" />
						<h6 class="heading-small text-muted mb-4">Bukti Pembayaran</h6>
						<div class="pl-lg-4">
							@foreach($pembayaran->buktiPembayaran as $bukti)
							<img src="{{ $bukti->foto }}" alt="fail to load: {{ $bukti->foto }}" style="max-width: 500px; max-height: 500px;">
							@endforeach
						</div>
						<hr class="my-4" />

						<input type="submit" class="btn btn-neutral float-right" value="Validasi">
						<select class="btn float-right pr-5" name="validasi">
							<option value="4" class="text-success">Terima Validasi</option>
							<option value="3" class="text-yellow">Tunda Validasi</option>
							<option value="2" class="text-danger">Tolak Validasi</option>
						</select>
					</form>
				</div>

			</div>
		</div>
	</div>
	@include('components.footer')
</div>
@endsection