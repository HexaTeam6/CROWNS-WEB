<x-auth-layout>
  <form role="form">
    <div class="form-group mb-3">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
        </div>
        <input class="form-control" placeholder="Email" type="email">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group input-group-merge input-group-alternative">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
        </div>
        <input class="form-control" placeholder="Password" type="password">
      </div>
    </div>
    <div class="custom-control custom-control-alternative custom-checkbox">
      <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
      <label class="custom-control-label" for=" customCheckLogin">
        <span class="text-muted">Remember me</span>
      </label>
    </div>
    <div class="text-center">
      <button type="button" class="btn btn-primary my-4">Sign in</button>
    </div>
  </form>
</x-auth-layout>