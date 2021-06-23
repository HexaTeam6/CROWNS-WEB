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
										<label class="form-control-label" for="input-first-name">Biaya Jahit</label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->biaya_jahit }}" name="biaya_jahit">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Material</label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->biaya_material }}" name="biaya_material">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Kirim</label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->biaya_kirim }}" name="biaya_kirim">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Jemput</label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->biaya_jemput }}" name="biaya_jemput">
									</div>
								</div>
							</div>
						</div>

						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Biaya Total</label>
										<input type="text" class="form-control" placeholder="Nama" value="{{ $pembayaran->pesanan->biaya_total }}" name="biaya_total">
									</div>
								</div>
							</div>
						</div>

						<hr class="my-4" />
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Dibuat pada</label>
										<input type="datetime" class="form-control" placeholder="Nama" value="{{ $pembayaran->pesanan->created_at }}" name="created_at">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Diperbarui pada</label>
										<input type="datetime" class="form-control" placeholder="Nama" value="{{ $pembayaran->pesanan->updated_at }}" name="updated_at">
									</div>
								</div>
							</div>
						</div>

						<hr class="my-4" />
						<h6 class="heading-small text-muted mb-4">Bukti Pembayaran</h6>
						@foreach($pembayaran->buktiPembayaran as $bukti)
						<img src="{{ $bukti->foto }}" alt="fail to load: {{ $bukti->foto }}">
						<hr class="my-4" />
						@endforeach
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