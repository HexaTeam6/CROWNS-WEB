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
									@if ($user->role == 'pembeli')
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
											<i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
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
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
									@if ($user->role == 'penjahit')
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
											<i class="ni ni-pin-3 text-warning mr-3"></i> {{ $user->penjahit->kota }}
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
			@include('components.footer')
		</div>
	</x-slot>
</x-app-layout>
