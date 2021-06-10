@extends('layouts.app')

@section('content')
	@include('components.header')
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<div class="row">
			<div class="col-xl-6">
				<div class="card">
					<div class="card-header border-0">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Pembeli</h3>
							</div>
							<div class="col text-right">
								<a href="#!" class="btn btn-sm btn-primary">See all</a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th scope="col">id_user</th>
									<th scope="col">Nama</th>
									<th scope="col">Gender</th>
									<th scope="col">Kab/Kot</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								@if ($user->konsumen)
								<tr>
									<td>
										{{ $user->id }}
									</td>
									<th scope="row">
										{{ $user->konsumen->nama }}
									</th>
									<td>
									<i class="ni ni-single-02 <?php if($user->konsumen->jenis_kelamin == 'L') echo 'text-info'; else echo 'text-danger'; ?> mr-3"></i>{{ $user->konsumen->jenis_kelamin }}
									</td>
									<td>
									<i class="ni ni-pin-3 text-warning mr-1"></i>{{ $user->konsumen->kota }}
									</td>
									<td>
										<a href="{{ route('konsumen.update', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">Lihat</a>
										<button type="button" data-toggle="modal" data-target="#exampleModal" user-id="{{$user->id}}" konsumen-id="{{$user->konsumen->id}}" class="btn-del btn btn-sm btn-danger">Hapus</a>	
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
								<h3 class="mb-0">Penjahit</h3>
							</div>
							<div class="col text-right">
								<a href="#!" class="btn btn-sm btn-primary">See all</a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th scope="col">id_user</th>
									<th scope="col">Nama</th>
									<th scope="col">Gender</th>
									<th scope="col">Kab/Kot</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								@if ($user->penjahit)
								<tr>
									<td>
										{{ $user->id }}
									</td>
									<th scope="row">
										{{ $user->penjahit->nama }}
									</th>
									<td>
									<i class="ni ni-single-02 <?php if($user->penjahit->jenis_kelamin == 'L') echo 'text-info'; else echo 'text-danger'; ?> mr-3"></i>{{ $user->penjahit->jenis_kelamin }}
									</td>
									<td>
										<i class="ni ni-pin-3 text-warning mr-1"></i>{{ $user->penjahit->kota }}
									</td>
									<td>
										<a href="{{ route('penjahit.update', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">Lihat</a>
										<button type="button" data-toggle="modal" data-target="#exampleModal" user-id="{{$user->id}}" penjahit-id="{{$user->penjahit->id}}" class="btn-del btn btn-sm btn-danger">Hapus</a>	
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
		@include('components.modal')
		@include('components.footer')
	</div>
@endsection

@section('script')
	<script>
		const deleteButtons = document.querySelectorAll('.btn-del');
		deleteButtons.forEach( btn => {
			btn.addEventListener('click', (e) => {
			const id = e.srcElement.getAttribute('user-id');
			const id_penjahit = e.srcElement.getAttribute('penjahit-id');
			const id_konsumen = e.srcElement.getAttribute('konsumen-id');
			console.log(id);
			console.log(id_penjahit);
			console.log(id_konsumen);
			const input = document.getElementById('btn-id');
			const penjahit_input = document.getElementById('penjahit-id');
			const konsumen_input = document.getElementById('konsumen-id');
			input.value = id;
			if(id_penjahit) penjahit_input.value = id_penjahit;
			if(id_konsumen) konsumen_input.value = id_konsumen;
			})
		})
	</script>
@endsection
