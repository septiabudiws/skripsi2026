<x-auth>
    <div class="card my-5">
        <div class="card-body">
            <div class="text-center"><img src="{{ asset('able') }}/assets/images/authentication/img-auth-register2.png"
                    alt="images" class="img-fluid mb-3">
                <h4 class="f-w-500 mb-1">Register with your email</h4>
                <p class="mb-3">Already have an Account? <a href="{{ route('login') }}" class="link-primary">Log in</a>
                </p>
            </div>
            <div class="mb-3"><input type="text" class="form-control" placeholder="Masukkan Nama Lengkap"></div>
            <div class="mb-3"><input type="text" class="form-control" placeholder="Masukkan Username"></div>
            <div class="mb-3"><input type="email" class="form-control" placeholder="Email Address"></div>
            <div class="mb-3"><input type="password" class="form-control" placeholder="Password"></div>
            <div class="mb-3"><input type="password" class="form-control" placeholder="Confirm Password"></div>
            <div class="d-flex mt-1 justify-content-between">
                <div class="form-check"><input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                        checked=""> <label class="form-check-label text-muted" for="customCheckc1">I agree to all
                        the Terms & Condition</label>
                </div>
            </div>
            <div class="d-grid mt-4"><button type="button" class="btn btn-primary">Create Account</button>
            </div>
        </div>
    </div>
</x-auth>
