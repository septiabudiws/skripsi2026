<x-template title="Profile | Warkop Garasi">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-5 col-xxl-3">
                <div class="card overflow-hidden">
                    <div class="card-body position-relative">
                        <div class="text-center mt-3">
                            <div class="chat-avtar d-inline-flex mx-auto"><img
                                    class="rounded-circle img-fluid wid-90 img-thumbnail"
                                    src="{{ asset('able') }}/assets/images/user/avatar-1.jpg" alt="User image"></div>
                            <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                            <p class="text-muted text-sm">{{ Auth::user()->username }}</p>
                            <div class="row g-3 justify-content-center">
                                <div class="col-4 border border-top-0 border-bottom-0 text-center">
                                    <h5 class="mb-0">{{ \App\Models\TransaksiModel::where('user_id', auth()->user()->id)->count() }}</h5><small class="text-muted">Transaksi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav flex-column nav-pills list-group list-group-flush account-pills mb-0"
                        id="user-set-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link list-group-item list-group-item-action active" id="user-set-profile-tab"
                            data-bs-toggle="pill" href="#user-set-profile" role="tab"
                            aria-controls="user-set-profile" aria-selected="true"><span class="f-w-500"><i
                                    class="ph-duotone ph-user-circle m-r-10"></i>Profile
                                Overview</span>
                        </a>
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-passwort-tab"
                            data-bs-toggle="pill" href="#user-set-passwort" role="tab"
                            aria-controls="user-set-passwort" aria-selected="false"><span class="f-w-500"><i
                                    class="ph-duotone ph-key m-r-10"></i>Change
                                Password</span>
                        </a>
                        @role('admin')
                            <a class="nav-link list-group-item list-group-item-action" id="user-set-email-tab"
                                data-bs-toggle="pill" href="#user-set-email" role="tab" aria-controls="user-set-email"
                                aria-selected="false"><span class="f-w-500"><i
                                        class="ph-duotone ph-envelope-open m-r-10"></i>Permission</span>
                            </a>
                        @endrole
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-xxl-9">
                <div class="tab-content" id="user-set-tabContent">
                    <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel"
                        aria-labelledby="user-set-profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5>Personal Details</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 pt-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1 text-muted">Nama Lengkap</p>
                                                <p class="mb-0">{{ Auth::user()->name }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1 text-muted">Bergabung Sejak</p>
                                                <p class="mb-0">{{ Auth::user()->created_at->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1 text-muted">Username</p>
                                                <p class="mb-0">{{ Auth::user()->username }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1 text-muted">Email</p>
                                                <p class="mb-0">{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 pb-0">
                                        <p class="mb-1 text-muted">Status Karyawan</p>
                                        <p class="mb-0">{{ ucfirst(Auth::user()->status) }}</p>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user-set-passwort" role="tabpanel"
                        aria-labelledby="user-set-passwort-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5>Change Password</h5>
                            </div>
                            <form action="{{ route('profile.change-password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <div class="row mb-0 align-items-center">
                                                <label class="col-form-label col-md-4 col-sm-12 text-md-end">New
                                                    Password <span class="text-danger">*</span></label>
                                                <div class="col-md-8 col-sm-12">
                                                    <div class="input-group">
                                                        <input type="password" name="password" id="profileNewPassword"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            required>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            onclick="togglePassword('profileNewPassword', 'iconProfileNew')">
                                                            <i id="iconProfileNew" class="ph-duotone ph-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('password')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item pb-0 px-0">
                                            <div class="row mb-0 align-items-center">
                                                <label class="col-form-label col-md-4 col-sm-12 text-md-end">Confirm
                                                    Password <span class="text-danger">*</span></label>
                                                <div class="col-md-8 col-sm-12">
                                                    <div class="input-group">
                                                        <input type="password" name="password_confirmation"
                                                            id="profileConfirmPassword" class="form-control" required>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            onclick="togglePassword('profileConfirmPassword', 'iconProfileConfirm')">
                                                            <i id="iconProfileConfirm" class="ph-duotone ph-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body text-end">
                                    <button type="button" class="btn btn-outline-secondary me-2">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @role('admin')
                        <div class="tab-pane fade" id="user-set-email" role="tabpanel"
                            aria-labelledby="user-set-email-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Hak Akses</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Akses Kategori</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch"
                                                {{ Auth::user()->hasPermissionTo('akses_kategori') ? 'checked' : '' }}
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-0">
                                        <div>
                                            <p class="text-muted mb-0">Akses Menu</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch"
                                                {{ Auth::user()->hasPermissionTo('akses_menu') ? 'checked' : '' }}
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-0">
                                        <div>
                                            <p class="text-muted mb-0">Akses Kriteria</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch"
                                                {{ Auth::user()->hasPermissionTo('akses_kriteria') ? 'checked' : '' }}
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-0">
                                        <div>
                                            <p class="text-muted mb-0">Akses Pembayaran</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch"
                                                {{ Auth::user()->hasPermissionTo('akses_metode_pembayaran') ? 'checked' : '' }}
                                                disabled></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body text-end btn-page">
                                    <div class="btn btn-outline-secondary">Cancel</div>
                                    <div class="btn btn-primary">Update Profile</div>
                                </div>
                            </div>
                        </div>
                    @endrole
                </div>
            </div>
        </div>
    </div><!-- [ sample-page ] end -->
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
</x-template>
