<x-auth title="Login | Warkop Garasi">
    <div class="card my-5">
        <div class="card-body">

            <div class="text-center">
                <img src="{{ asset('able') }}/assets/images/authentication/img-auth-login2.png" alt="images"
                    class="img-fluid mb-3">
                <h4 class="f-w-500 mb-1">Login with your email</h4>
                <p class="mb-3">Don't have an Account? <a href="{{ route('register') }}" class="link-primary ms-1">Create
                        Account</a></p>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                @error('email')
                    <div class="alert alert-danger py-2 small">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                        placeholder="Email Address" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" name="password" id="loginPassword" class="form-control"
                            placeholder="Password" required>

                        <button class="btn btn-outline-secondary" type="button"
                            onclick="togglePassword('loginPassword', 'iconLoginPassword')">
                            <i id="iconLoginPassword" class="ph-duotone ph-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex mt-1 justify-content-between align-items-center">
                    <a href="{{ route('forgot-password') }}">
                        <h6 class="f-w-400 mb-0">Forgot Password?</h6>
                    </a>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword(inputId, iconId) {
            let inputField = document.getElementById(inputId);
            let iconElement = document.getElementById(iconId);

            if (inputField.type === 'password') {
                inputField.type = 'text';
                iconElement.className = 'ph-duotone ph-eye-slash';
            } else {
                inputField.type = 'password';
                iconElement.className = 'ph-duotone ph-eye';
            }
        }
    </script>
</x-auth>
