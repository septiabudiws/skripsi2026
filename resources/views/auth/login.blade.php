<x-auth>
    <div class="card my-5">
        <div class="card-body">
            <div class="text-center"><img src="{{ asset('able') }}/assets/images/authentication/img-auth-login2.png"
                    alt="images" class="img-fluid mb-3">
                <h4 class="f-w-500 mb-1">Login with your email</h4>
                <p class="mb-3">Don't have an Account? <a href="{{ route('register') }}"
                        class="link-primary ms-1">Create
                        Account</a></p>
            </div>
            <div class="mb-3"><input type="email" class="form-control" id="floatingInput"
                    placeholder="Email Address"></div>
            <div class="mb-3"><input type="password" class="form-control" id="floatingInput1" placeholder="Password">
            </div>
            <div class="d-flex mt-1 justify-content-between align-items-center"><a
                    href="{{ asset('able') }}/pages/forgot-password-v1.html">
                    <h6 class="f-w-400 mb-0">Forgot Password?</h6>
                </a>
            </div>
            <div class="d-grid mt-4"><button type="button" class="btn btn-primary">Login</button></div>
        </div>
    </div>
</x-auth>
