@extends('layouts.app')

@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				@include('components.header.link')
				<h6 class="h2 text-white d-inline-block mb-0">Total Pesanan: {{ $list_diterima->count()+$list_belum->count()+$list_ditolak->count() }}</h6>
				@include('pesanan.statistic')
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
			<div class="col-xl-12">
				<div class="card">
					<div class="card-header border-0">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Pesanan<i class="ni ni-fat-delete text-yellow"></i></h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th scope="col">id</th>
                  <th scope="col">Tanggal</th>
									<th scope="col">Jumlah</th>
									<th scope="col">Total</th>
                  <th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($list_belum as $pesanan)
								<tr>
									<td>
										{{ $pesanan->id }}
									</td>
                  <td>
										{{ $pesanan->created_at }}
									</td>
									<td>
										{{ $pesanan->jumlah }}
									</td>
									<td>
										{{ $pesanan->biaya_total }}
									</td>
									<td>
										<a href="{{ route('pesanan.view.pembayaran', ['id' => $pesanan->id]) }}" class="btn btn-sm btn-primary">Lihat</a>
										<button type="button" data-toggle="modal" data-target="#validasiModal" pesanan-id="{{$pesanan->id}}" class="btn-val-pesanan btn btn-sm btn-danger" url="{{ route('pesanan.validate', ['id' => $pesanan->id]) }}" url-image="{{ $pesanan->pembayaran->buktiPembayaran ? $pesanan->pembayaran->buktiPembayaran->first()->foto : 'kosong woy' }}">Validasi</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-6">
				<div class="card">
					<div class="card-header border-0">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Pesanan<i class="ni ni-check-bold text-success"></i></h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th scope="col">id</th>
                  <th scope="col">Tanggal</th>
									<th scope="col">Tgl Validasi</th>
                  <th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($list_diterima as $pesanan)
								@if($pesanan->pembayaran->status_pembayaran == '4')
								<tr>
									<td>
										{{ $pesanan->id }}
									</td>
                  <td>
										{{ $pesanan->created_at }}
									</td>
									<td>
										{{ $pesanan->pembayaran->updated_at }}
									</td>
									<td>
										<a href="{{ route('pesanan.view.pembayaran', ['id' => $pesanan->id]) }}" class="btn btn-sm btn-primary">Lihat</a>
										<button type="button" data-toggle="modal" data-target="#validasiModal" pesanan-id="{{$pesanan->id}}" class="btn-val-pesanan btn btn-sm btn-danger" url="{{ route('pesanan.validate', ['id' => $pesanan->id]) }}" url-image="{{ $pesanan->pembayaran->buktiPembayaran ? $pesanan->pembayaran->buktiPembayaran->first()->foto : 'kosong woy' }}">Validasi</a>
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-xl-6">
				<div class="card">
					<div class="card-header border-0">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Pesanan<i class="ni ni-fat-remove text-danger"></i></h3>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th scope="col">id</th>
                  <th scope="col">Tanggal</th>
									<th scope="col">Tgl Validasi</th>
                  <th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($list_ditolak as $pesanan)
								@if($pesanan->pembayaran->status_pembayaran == '2')
								<tr>
									<td>
										{{ $pesanan->id }}
									</td>
                  <td>
										{{ $pesanan->created_at }}
									</td>
									<td>
										{{ $pesanan->pembayaran->updated_at }}
									</td>
									<td>
										<a href="{{ route('pesanan.view.pembayaran', ['id' => $pesanan->id]) }}" class="btn btn-sm btn-primary">Lihat</a>
										@if($pesanan->pembayaran && 
												$pesanan->pembayaran->buktiPembayaran && 
												$pesanan->pembayaran->buktiPembayaran->first())
											<button type="button" data-toggle="modal" data-target="#validasiModal" pesanan-id="{{$pesanan->id}}" class="btn-val-pesanan btn btn-sm btn-danger" url="{{ route('pesanan.validate', ['id' => $pesanan->id]) }}" url-image="{{ $pesanan->pembayaran->buktiPembayaran ? $pesanan->pembayaran->buktiPembayaran->first()->foto : 'kosong' }}">Validasi</a>
										@else
											<button class="btn-val-pesanan btn btn-sm btn-danger" disabled>bukti kosong</button>
										@endif
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@include('pesanan.modal')
		@include('components.footer')
	</div>
@endsection

@section('script')
	<script>
		const validateButtonspesanan = document.querySelectorAll('.btn-val-pesanan');
		var frm = document.getElementById('myform');
		var show_image = document.getElementById('bukti-bayar');
		validateButtonspesanan.forEach( btn => { //handler tombol pesanan
			btn.addEventListener('click', (e) => {
			const id = e.srcElement.getAttribute('pesanan-id');
			const action = e.srcElement.getAttribute('url');
			const img_src = e.srcElement.getAttribute('url-image');
			const img_alt = img_src;
			console.log(id);
			console.log(img_src);
			const input = document.getElementById('btn-id');
			input.value = id;
			frm.action = action;
			show_image.src = img_src;
			show_image.alt = img_alt;
			})
		});
	</script>
@endsection
