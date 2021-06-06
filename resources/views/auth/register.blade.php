<x-auth-layout>
  <x-slot name="slot">
  <!-- form -->
  <!-- form -->
  <form role="form" method="POST" action="#">
    @csrf
    <div class="form-group mb-3">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
        </div>
        <input class="form-control" placeholder="Nama" type="text" id="name" name="name" required autofocus>
      </div>
    </div>
    <div class="form-group mb-3">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
        </div>
        <input class="form-control" placeholder="Email" type="email" id="email" name="email" required autofocus>
      </div>
    </div>
    <div class="form-group">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
        </div>
        <input class="form-control" placeholder="Password" type="password" id="password" name="password" required autocomplete="new-password">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
        </div>
        <input class="form-control" placeholder="Confirm Password" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
      </div>
    </div>

    <div class="flex items-center justify-end mt-4">
      <a class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
        {{ __('Already registered?') }}
      </a>
    </div>

    <div class="text-center">
      <button type="button" class="btn btn-primary mt-4">Create account</button>
    </div>
  </form>
  <!-- end of form -->
  <!-- end of form -->
  </x-slot>
</x-auth-layout>