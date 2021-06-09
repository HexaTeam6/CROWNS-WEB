<x-app-layout>	
	<x-slot name="slot">
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
	</x-slot>
	@section('script')
		<script>
			const deleteButtons = document.querySelectorAll('.btn-del');
			deleteButtons.forEach( btn => {
				btn.addEventListener('click', (e) => {
				const id = e.srcElement.getAttribute('user-id');
				const id_penjahit = e.srcElement.getAttribute('penjahit-id');
				console.log(id)
				console.log(id_penjahit)
				const input = document.getElementById('btn-id');
				const penjahit_input = document.getElementById('penjahit-id');
				input.value = id;
				penjahit_input.value = id_penjahit;
				})
			})
			$('#data-table').DataTable({
				"language": {
				"paginate": {
					"previous": "<",
					"next": ">",
				}
				}
			});
		</script>
	@endsection
</x-app-layout>
