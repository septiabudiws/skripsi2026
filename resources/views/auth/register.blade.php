<x-auth title="Register | Warkop Garasi">
    <div class="card my-5">
        <div class="card-body">
            <div class="text-center"><img src="{{ asset('able') }}/assets/images/authentication/img-auth-register2.png"
                    alt="images" class="img-fluid mb-3">
                <h4 class="f-w-500 mb-1">Register with your email</h4>
                <p class="mb-3">Already have an Account? <a href="{{ route('login') }}" class="link-primary">Log in</a>
                </p>
            </div>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <!-- Input Nama -->
                <div class="mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input Username -->
                <div class="mb-3">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        placeholder="Masukkan Username" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input Email -->
                <div class="mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email Address" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input Password Utama -->
                <div class="mb-3">
                    <div class="input-group">
                        <!-- Tambahkan id="inputPassword" -->
                        <input type="password" name="password" id="inputPassword"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            required>

                        <!-- Tombol mata/teks trigger JS -->
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="togglePassword('inputPassword', 'textIconPassword')">
                            <i id="textIconPassword" class="ph-duotone ph-eye"></i>
                        </button>
                    </div>

                    <!-- Gunakan d-block agar error tidak tertimpa oleh layout input-group -->
                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input Confirm Password -->
                <div class="mb-3">
                    <div class="input-group">
                        <!-- Tambahkan id="inputConfirmPassword" -->
                        <input type="password" name="password_confirmation" id="inputConfirmPassword"
                            class="form-control" placeholder="Confirm Password" required>

                        <button class="btn btn-outline-secondary" type="button"
                            onclick="togglePassword('inputConfirmPassword', 'textIconConfirm')">
                            <i id="textIconConfirm" class="ph-duotone ph-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Create Account</button>
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
