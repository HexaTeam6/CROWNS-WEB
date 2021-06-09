<x-auth-layout>
  <x-slot name="title">
    Register
  </x-slot>
  <x-slot name="slot">
  <!-- form -->
  <!-- form -->
  <form role="form" method="POST" action="{{ route('register.post') }}">
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
          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
        </div>
        <input class="form-control {{ $errors->has('username') ? 'error' : '' }}" placeholder="Email or Username" name="username" value="{{ old('username') }}" >
      </div>
    </div>
    
    <!-- Error -->
    @if ($errors->has('email'))
    <div class="error">
        <span class="text-danger">{{ $errors->first('email') }}</span>
    </div>
    @endif
    <div class="form-group mb-3">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
        </div>
        <input class="form-control {{ $errors->has('email') ? 'error' : '' }}" placeholder="Email" type="email" name="email" value="{{ old('email') }}" >
      </div>
    </div>

    <!-- Error -->
    @if ($errors->has('nama'))
    <div class="error">
        <span class="text-danger">{{ $errors->first('nama') }}</span>
    </div>
    @endif
    <div class="form-group mb-3">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
        </div>
        <input class="form-control {{ $errors->has('nama') ? 'error' : '' }}" placeholder="Nama" name="nama" value="{{ old('nama') }}" >
      </div>
    </div>

    <div class="form-group">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
        </div>
        <input class="form-control" placeholder="Password" type="password" id="password" name="password"  autocomplete="new-password">
      </div>
    </div>

    <div class="form-group">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
        </div>
        <input class="form-control" placeholder="Confirm Password" type="password" id="password_confirmation" name="password_confirmation"  autocomplete="new-password">
      </div>
    </div>

    <div class="flex items-center justify-end mt-4">
      <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </a>
    </div>

    <div class="text-center">
      <input type="submit" name="send" value="Submit" class="btn btn-primary my-4">
    </div>
  </form>
  <!-- end of form -->
  <!-- end of form -->
  </x-slot>
</x-auth-layout>