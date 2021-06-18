@extends('layouts.app')

@section('content')
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
		
		<div class="col-xl-12 order-xl-1">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Profil</h3>
						</div>
					</div>
				</div>

				<div class="card-body">
					<form>
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
										@if($user->penjahit)
										<label class="form-control-label" for="input-last-name">Jenis Kelamin</label>
										<select class="form-control" name="jenis_kelamin">
                      <option value="L" {{ $user->penjahit->jenis_kelamin == 'L' ? 'selected' : '' }}>laki-laki</option>
                      <option value="P" {{ $user->penjahit->jenis_kelamin == 'L' ? '' : 'selected' }}>perempuan</option>
                    </select>
										@endif
										@if($user->konsumen)
										<label class="form-control-label" for="input-last-name">Jenis Kelamin</label>
										<select class="form-control" name="jenis_kelamin">
                      <option value="L" {{ $user->konsumen->jenis_kelamin == 'L' ? 'selected' : '' }}>laki-laki</option>
                      <option value="P" {{ $user->konsumen->jenis_kelamin == 'L' ? '' : 'selected' }}>perempuan</option>
                    </select>
										@endif
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
						<a class="btn btn-neutral float-right" href="{{ route('manage-akun') }}">Back</a>
					</form>
				</div>

			</div>
		</div>
	</div>
	@include('components.footer')
</div>
@endsection