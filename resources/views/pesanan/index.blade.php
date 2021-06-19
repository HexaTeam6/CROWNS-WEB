@extends('layouts.app')

@section('content')
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
			<div class="col-xl-12">
				<div class="card">
					<div class="card-header border-0">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Pesanan</h3>
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
									<th scope="col">Status</th>
                  <th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($list_pesanan as $pesanan)
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
										{{ $pesanan->status_pesanan == 'S' ? 'Sudah Divalidasi' : 'Belum Divalidasi' }}
									</td>
									<td>
										<a href="#" class="btn btn-sm btn-primary">Lihat</a>
										<button type="button" data-toggle="modal" data-target="#exampleModal" pesanan-id="{{$pesanan->id}}" class="btn-val-pesanan btn btn-sm btn-danger" url="#">Validasi</a>	
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@include('components.modal')
		@include('components.footer')
	</div>
@endsection

@section('script')
	<script>
		const validateButtonspesanan = document.querySelectorAll('.btn-val-pesanan');
		var frm = document.getElementById('myform');
		validateButtonspesanan.forEach( btn => { //handler tombol pesanan
			btn.addEventListener('click', (e) => {
			const id = e.srcElement.getAttribute('pesanan-id');
			const action = e.srcElement.getAttribute('url');
			console.log(id);
			console.log(action);
			const input = document.getElementById('btn-id');
			input.value = id;
			frm.action = action;
			})
		});
	</script>
@endsection
