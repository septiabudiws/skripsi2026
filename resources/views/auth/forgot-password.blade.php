<x-auth>
    <div class="card my-5">
        <div class="card-body">
            <div class="text-center"><img
                    src="{{ asset('able') }}/assets/images/authentication/img-auth-fporgot-password.png" alt="images"
                    class="img-fluid mb-3">
                <h4 class="f-w-500 mb-1">Forgot Password</h4>
                <p class="mb-3">Back to <a href="{{ route('login') }}" class="link-primary ms-1">Log
                        in</a></p>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="floatingInput" placeholder="Email Address" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">Send reset email</button>
                </div>
            </form>
        </div>
    </div>
</x-auth>
