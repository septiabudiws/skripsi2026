<x-auth>
    <div class="card my-5">
        <div class="card-body">

            <div class="text-center">
                <img src="{{ asset('able') }}/assets/images/authentication/img-auth-login2.png" alt="images" class="img-fluid mb-3">
                <h4 class="f-w-500 mb-1">Login with your email</h4>
                <p class="mb-3">Don't have an Account? <a href="{{ route('register') }}" class="link-primary ms-1">Create Account</a></p>
            </div>

            <!-- FORM DIMULAI DI SINI -->
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- Tambahan: Menampilkan pesan error jika email/password salah -->
                @error('email')
                    <div class="alert alert-danger py-2 small">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <!-- Tambahkan name="email", required, dan value old('email') -->
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <!-- Tambahkan name="password" dan required -->
                    <input type="password" name="password" class="form-control" id="floatingInput1" placeholder="Password" required>
                </div>

                <div class="d-flex mt-1 justify-content-between align-items-center">
                    <!-- Forgot password diabaikan dulu pakai href="#" -->
                    <a href="#">
                        <h6 class="f-w-400 mb-0">Forgot Password?</h6>
                    </a>
                </div>

                <div class="d-grid mt-4">
                    <!-- Ubah type="button" menjadi type="submit" -->
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <!-- FORM SELESAI -->

        </div>
    </div>
</x-auth>
