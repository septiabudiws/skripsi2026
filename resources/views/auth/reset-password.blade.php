<x-auth>
    <div class="card my-5">
        <div class="card-body">
            <div class="text-center"><img
                    src="{{ asset('able') }}/assets/images/authentication/img-auth-reset-password.png" alt="images"
                    class="img-fluid mb-3">
                <h4 class="f-w-500 mb-1">Reset password</h4>
                <p class="mb-3">Back to <a href="{{ route('login') }}" class="link-primary ms-1">Log
                        in</a></p>
            </div>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email Address" value="{{ request()->email }}" readonly required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="inputPassword"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            required>
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="togglePassword('inputPassword', 'textIconPassword')">
                            <i id="textIconPassword" class="ph-duotone ph-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="inputConfirmPassword"
                            class="form-control" placeholder="Confirm Password" required>
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="togglePassword('inputConfirmPassword', 'textIconConfirm')">
                            <i id="textIconConfirm" class="ph-duotone ph-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
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
