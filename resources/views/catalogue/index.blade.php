@extends('layouts.app')

@section('content')
	<div class="header bg-primary pb-6">
		<div class="container-fluid">
			<div class="header-body">
				@include('components.header.link')
			</div>
		</div>
	</div>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<div class="row">
			<div class="col-xl-4">
				<div class="card">
					<div class="card-header border-0">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Kategori Katalog</h3>
							</div>
							<div class="col">
								<a href="{{ route('katalog.kategori.create') }}" class="btn btn-sm btn-primary float-right">
									<i class="ni ni-fat-add text-white mr-1"></i>
									buat kategori
								</a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th scope="col">id</th>
									<th scope="col">Nama</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($list_kategori as $kategori)
								<tr>
									<td>
										{{ $kategori->id }}
									</td>
									<td>
										{{ $kategori->nama }}
									</td>
									<td>
										<a href="{{ route('katalog.kategori.view', ['id' => $kategori->id]) }}" class="btn btn-sm btn-primary">Lihat</a>
										<button type="button" data-toggle="modal" data-target="#exampleModal" kategori-id="{{$kategori->id}}" class="btn-del-kategori btn btn-sm btn-danger" url="{{ route('katalog.kategori.delete') }}">Hapus</a>	
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-xl-8">
				<div class="card">
					<div class="card-header border-0">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="mb-0">Baju</h3>
							</div>
							<div class="col">
								<a href="{{ route('katalog.baju.create') }}" class="btn btn-sm btn-primary float-right">
									<i class="ni ni-fat-add text-white mr-1"></i>
									buat baju
								</a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<!-- Projects table -->
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th scope="col">id</th>
									<th scope="col">Nama</th>
									<th scope="col">Kategori</th>
									<th scope="col">Deskripsi</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($list_baju as $baju)
								<tr>
									<td>
										{{ $baju->id }}
									</td>
									<th scope="row">
										{{ $baju->nama }}
									</th>
									<td>
									<i class="ni ni-single-02 <?php if($baju->jenis_kelamin == 'L') echo 'text-info'; else echo 'text-danger'; ?> mr-3"></i>{{ $baju->kategori->nama }}
									</td>
									<td>
										{{ Str::limit($baju->deskripsi, 20) }}
									</td>
									<td>
										<a href="{{ route('katalog.baju.view', ['id' => $baju->id]) }}" class="btn btn-sm btn-primary">Lihat</a>
										<button type="button" data-toggle="modal" data-target="#exampleModal" baju-id="{{$baju->id}}" class="btn-del-baju btn btn-sm btn-danger" url="{{ route('katalog.baju.delete') }}">Hapus</a>	
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
		const deleteButtonsKategori = document.querySelectorAll('.btn-del-kategori');
		const deleteButtonsBaju = document.querySelectorAll('.btn-del-baju');
		var frm = document.getElementById('myform');
		deleteButtonsKategori.forEach( btn => { //handler tombol kategori
			btn.addEventListener('click', (e) => {
			const id = e.srcElement.getAttribute('kategori-id');
			const action = e.srcElement.getAttribute('url');
			console.log(id);
			console.log(action);
			const input = document.getElementById('btn-id');
			input.value = id;
			frm.action = action;
			})
		});
		deleteButtonsBaju.forEach( btn => { //handler tombol baju
			btn.addEventListener('click', (e) => {
			const id = e.srcElement.getAttribute('baju-id');
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
