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
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		
		<div class="col-xl-12 order-xl-1">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Edit profile </h3>
						</div>
					</div>
				</div>

				<div class="card-body">
					<form method="POST" action="{{ route('profile.update_put') }}">
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
										<input type="text" id="input-name" class="form-control" placeholder="Nama Lengkap" value="{{ $user->admin->nama }}" name="nama">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Password</label>
										<input type="password" id="input-password" class="form-control" placeholder="Password" name="password">
									</div>
								</div>
							</div>
						</div>								
						<hr class="my-4" />
						<input type="submit" class="btn btn-neutral float-right" value="Edit profile">
						<!-- Success message -->
						@if(Session::has('success'))
						<div class="alert alert-success col-lg-4">
								{{Session::get('success')}}
						</div>
						@endif
					</form>
				</div>

			</div>
		</div>
	</div>
	@include('components.footer')
</div>
@endsection