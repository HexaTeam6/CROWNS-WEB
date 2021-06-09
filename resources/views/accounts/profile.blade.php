<x-app-layout>
	<x-slot name="slot">
		<!-- Header -->
		<div class="header bg-primary pb-6">
			<div class="container-fluid">
				<div class="header-body">
					@include('components.header.link')
				</div>
			</div>
		</div>
		<!-- Success message -->
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
		<!-- Page content -->
		<div class="container-fluid mt--6">
			<div class="row">
				<div class="col-xl-4 order-xl-2">
					<div class="card card-profile">
						<img src="{{ asset('assets/img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
						<div class="row justify-content-center">
							<div class="col-lg-3 order-lg-2">
								<div class="card-profile-image">
									<a href="#">
										<img src="{{ asset('assets/img/theme/team-4.jpg') }}" class="rounded-circle">
									</a>
								</div>
							</div>
						</div>
						<div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
							<div class="d-flex justify-content-between">
								<a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
								<a href="#" class="btn btn-sm btn-default float-right">Message</a>
							</div>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="col">
									<div class="card-profile-stats d-flex justify-content-center">
										<div>
											<span class="heading">22</span>
											<span class="description">Friends</span>
										</div>
										<div>
											<span class="heading">10</span>
											<span class="description">Photos</span>
										</div>
										<div>
											<span class="heading">89</span>
											<span class="description">Comments</span>
										</div>
									</div>
								</div>
							</div>
							<div class="text-center">
								<h5 class="h3">
									Jessica Jones<span class="font-weight-light">, 27</span>
								</h5>
								<div class="h5 font-weight-300">
									<i class="ni location_pin mr-2"></i>Bucharest, Romania
								</div>
								<div class="h5 mt-4">
									<i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
								</div>
								<div>
									<i class="ni education_hat mr-2"></i>University of Computer Science
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xl-8 order-xl-1">
					<div class="card">
						<div class="card-header">
							<div class="row align-items-center">
								<div class="col-8">
									<h3 class="mb-0">Edit profile </h3>
								</div>
							</div>
						</div>

						<div class="card-body">
							<form method="POST" action="{{ route('penjahit.update_put', ['id' => $user->id]) }}">
								@method('PUT')
								@csrf
								<h6 class="heading-small text-muted mb-4">User information</h6>
								<div class="pl-lg-4">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-username">Username</label>
												<input type="text" id="input-username" class="form-control" placeholder="Username" value="{{ $user->username }}" name="username">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-email">Email</label>
												<input type="email" id="input-email" class="form-control" placeholder="jesse@example.com" value="{{ $user->email }}" name="email">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-first-name">Nama Lengkap</label>
												<input type="text" id="input-first-name" class="form-control" placeholder="Nama Lengkap" value="{{ $user->penjahit ? $user->penjahit->nama : $user->konsumen->nama }}" name="nama">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-last-name">Jenis Kelamin</label>
												<input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="{{ $user->penjahit ? $user->penjahit->jenis_kelamin : $user->konsumen->jenis_kelamin }}" name="jenis_kelamin">
											</div>
										</div>
									</div>
								</div>
								<hr class="my-4" />
								<!-- Address -->
								<h6 class="heading-small text-muted mb-4">Informasi Kontak</h6>
								<div class="pl-lg-4">
								
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-city">Nomor Hp</label>
												<input type="text" id="input-city" class="form-control" placeholder="Nomor Hp" value="{{ $user->penjahit ? $user->penjahit->no_hp : $user->konsumen->no_hp }}" name="no_hp">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-country">Tanggal Lahir</label>
												<input type="date" id="input-country" class="form-control" placeholder=">Tanggal Lahir" value="{{ $user->penjahit ? $user->penjahit->tanggal_lahir : $user->konsumen->tanggal_lahir }}" name="tanggal_lahir">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label class="form-control-label" for="input-city">Kota / Kabupaten</label>
												<input type="text" id="input-city" class="form-control" placeholder="Kota / Kabupaten" value="{{ $user->penjahit ? $user->penjahit->kota : $user->konsumen->kota }}" name="kota">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="form-control-label" for="input-country">Kecamatan</label>
												<input type="text" id="input-country" class="form-control" placeholder="Country" value="{{ $user->penjahit ? $user->penjahit->kecamatan : $user->konsumen->kecamatan }}" name="kecamatan">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="form-control-label" for="input-country">Kode Pos</label>
												<input type="number" id="input-postal-code" class="form-control" placeholder="Postal code" value="{{ $user->penjahit ? $user->penjahit->kodepos : $user->konsumen->kodepos }}" name="kodepos">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-control-label" for="input-address">Alamat</label>
												<input id="input-address" class="form-control" placeholder="Home Address" value="{{ $user->penjahit ? $user->penjahit->alamat : $user->konsumen->alamat }}" type="text" name="alamat">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-city">Nomor Rekening</label>
												<input type="text" id="input-city" class="form-control" placeholder="Nomor Rekening" value="{{ $user->penjahit ? $user->penjahit->no_rekening : $user->konsumen->no_rekening }}" name="no_rekening">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-control-label" for="input-country">Bank</label>
												<input type="text" id="input-country" class="form-control" placeholder="Bank" value="{{ $user->penjahit ? $user->penjahit->bank : $user->konsumen->bank }}" name="bank">
											</div>
										</div>
									</div>
								</div>
								<hr class="my-4" />
								<input type="submit" class="btn btn-neutral float-right" value="Edit profile">
							</form>
						</div>

					</div>
				</div>
			</div>
			@include('components.footer')
		</div>
	</x-slot>
</x-app-layout>