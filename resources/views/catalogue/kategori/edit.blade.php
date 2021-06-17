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
							<h3 class="mb-0">Profil</h3>
						</div>
						<a class="btn btn-neutral float-right col-1" href="{{ route('katalog') }}">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('katalog.kategori.update_put', ['id' => $kategori->id]) }}" method="POST">
						@csrf
						@method('PUT')
						<input type="hidden" value="{{ $kategori->id }}">
						<h6 class="heading-small text-muted mb-4">Info Kategori</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">Nama</label>
										<input type="text" id="input-first-name" class="form-control" placeholder="Nama" value="{{ $kategori->nama }}" name="nama">
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4" />
						<input type="submit" class="btn btn-neutral float-right" value="Edit Katalog">
					</form>
				</div>

			</div>
		</div>
	</div>
	@include('components.footer')
</div>
@endsection