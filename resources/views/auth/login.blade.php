<x-auth-layout>
  <x-slot name="title">
    Login
  </x-slot>

  <x-slot name="slot">
    <!-- Success message -->
    @if(Session::has('message'))
    <div class="alert alert-warning">
        {{Session::get('message')}}
    </div>
    @endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form role="form" method="POST" action="{{ route('login') }}">

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
          <x-input class="form-control {{ $errors->has('username') ? 'error' : '' }}" placeholder="Email" type="text" name="username" value="{{ old('username') }}" required autofocus />
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
          <input class="form-control {{ $errors->has('password') ? 'error' : '' }}" placeholder="Password" type="password" name="password" value="{{ old('password') }}" required autocomplete="current-password">
        </div>
      </div>

      <!-- Remember Me -->
      <div class="block mt-4">
				<label for="remember_me" class="inline-flex items-center">
					<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
					<span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
				</label>
			</div>


      <div class="flex items-center justify-end mt-4">
				<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
					{{ __('register') }}
				</a>
			</div>

			@if (Route::has('password.request'))
				<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
					{{ __('Forgot your password?') }}
				</a>
			@endif

      <div class="text-center">
				<x-button class="btn btn-primary my-4">
						{{ __('Log in') }}
				</x-button>
      </div>
    </form>
  </x-slot>
</x-auth-layout>