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
							<h3 class="mb-0">Buat Baju</h3>
						</div>
						<a class="btn btn-neutral float-right col-1" href="{{ route('katalog') }}">Back</a>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('katalog.baju.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label" for="nama">Nama</label>
										<input type="text" id="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}" name="nama">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label" for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                      <option value="L">laki-laki</option>
                      <option value="P">perempuan</option>
                    </select>
									</div>
								</div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="input-last-name">Kategori</label>
                    <select class="form-control" name="id_kategori">
                      @foreach ($list_kategori as $kategori)
                      <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
							</div>
						</div>
						<hr class="my-4" />
						<!-- Address -->
						<h6 class="heading-small text-muted mb-4">Informasi Tambahan</h6>
						
						<div class="pl-lg-4">
							<div class="form-group">
								<label class="form-control-label">Deskripsi</label>
								<textarea rows="4" class="form-control" placeholder="Deskripsi baju" name="deskripsi">{{ old('deskripsi') }}</textarea>
							</div>
						</div>

						<div class="pl-lg-4">
							<div class="form-group">
								<input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}"/>  
								@if ($errors->has('image'))
								<div class="error">
										<span class="text-danger">{{ $errors->first('image') }}</span>
								</div>
								@endif
							</div>
						</div>

						<hr class="my-4" />
						<input type="submit" class="btn btn-neutral float-right" value="Tambahkan Baju">
					</form>
				</div>

			</div>
		</div>
	</div>
	@include('components.footer')
</div>
@endsection