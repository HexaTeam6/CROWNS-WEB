<x-auth-layout>

  <!-- Success message -->
  @if(Session::has('success'))
  <div class="alert alert-success">
      {{Session::get('success')}}
  </div>
  @endif

  <form role="form" method="POST" action="{{ route('login.post') }}">

    @csrf
    <!-- Error -->
    @if ($errors->has('username'))
    <div class="error">
        <span class="text-danger">{{ $errors->first('username') }}</span>
    </div>
    @endif
    <div class="form-group mb-3">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
        </div>
        <input class="form-control {{ $errors->has('username') ? 'error' : '' }}" placeholder="Email" type="text" name="username" value="{{ old('username') }}" required>
      </div>
    </div>

    <!-- Error -->
    @if ($errors->has('password'))
    <div class="error">
        <span class="text-danger">{{ $errors->first('password') }}</span>
    </div>
    @endif
    <div class="form-group">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
        </div>
        <input class="form-control {{ $errors->has('password') ? 'error' : '' }}" placeholder="Password" type="password" name="password" value="{{ old('password') }}" required>
      </div>
    </div>

    <div class="text-center">
      <input type="submit" name="send" value="Submit" class="btn btn-primary my-4">
    </div>
  </form>
</x-auth-layout>