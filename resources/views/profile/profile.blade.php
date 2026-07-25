<x-template>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-5 col-xxl-3">
                <div class="card overflow-hidden">
                    <div class="card-body position-relative">
                        <div class="text-center mt-3">
                            <div class="chat-avtar d-inline-flex mx-auto"><img
                                    class="rounded-circle img-fluid wid-90 img-thumbnail"
                                    src="{{ asset('able') }}/assets/images/user/avatar-1.jpg" alt="User image"></div>
                            <h5 class="mb-0">Moh. Septiabudi W.</h5>
                            <p class="text-muted text-sm">SeptiabudiWS</p>
                            <div class="row g-3 justify-content-center">
                                <div class="col-4 border border-top-0 border-bottom-0 text-center">
                                    <h5 class="mb-0">40</h5><small class="text-muted">Transaksi</small>
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
                        <a class="nav-link list-group-item list-group-item-action" id="user-set-email-tab"
                            data-bs-toggle="pill" href="#user-set-email" role="tab" aria-controls="user-set-email"
                            aria-selected="false"><span class="f-w-500"><i
                                    class="ph-duotone ph-envelope-open m-r-10"></i>Permission</span>
                        </a>
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
                                                <p class="mb-0">Anshan Handgun</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1 text-muted">Bergabung Sejak</p>
                                                <p class="mb-0">15 Maret 2023</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1 text-muted">Username</p>
                                                <p class="mb-0">anshan_handgun</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1 text-muted">Email</p>
                                                <p class="mb-0">anshan.handgun@example.com</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item px-0 pb-0">
                                        <p class="mb-1 text-muted">Status Karyawan</p>
                                        <p class="mb-0">Aktif</p>
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
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        <div class="row mb-0"><label
                                                class="col-form-label col-md-4 col-sm-12 text-md-end">New
                                                Password <span class="text-danger">*</span></label>
                                            <div class="col-md-8 col-sm-12"><input type="password"
                                                    class="form-control"></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item pb-0 px-0">
                                        <div class="row mb-0"><label
                                                class="col-form-label col-md-4 col-sm-12 text-md-end">Confirm
                                                Password <span class="text-danger">*</span></label>
                                            <div class="col-md-8 col-sm-12"><input type="password"
                                                    class="form-control"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-end">
                                <div class="btn btn-outline-secondary me-2">Cancel</div>
                                <div class="btn btn-primary">Change Password</div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user-set-email" role="tabpanel"
                        aria-labelledby="user-set-email-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5>Email Settings</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="mb-3">Setup Email Notification</h6>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">Email Notification</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch" checked=""></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-0">
                                    <div>
                                        <p class="text-muted mb-0">Send Copy To Personal Email</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Activity Related Emails</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="mb-3">When to email?</h6>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">Have new notifications</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch" checked=""></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">You're sent a direct message</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch"></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">Someone adds you as a connection</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch" checked=""></div>
                                </div>
                                <hr class="my-2 border border-secondary-subtle">
                                <h6 class="mb-3">When to escalate emails?</h6>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">Upon new order</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch" checked=""></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">New membership approval</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch"></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-0">
                                    <div>
                                        <p class="text-muted mb-0">Member registration</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch" checked=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Updates from System Notification</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="mb-3">Email you with?</h6>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">News about PCT-themes products and
                                            feature updates</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch" checked=""></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">Tips on getting more out of PCT-themes
                                        </p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch" checked=""></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">Things you missed since you last logged
                                            into PCT-themes</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch"></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <p class="text-muted mb-0">News about products and other services
                                        </p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch"></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-0">
                                    <div>
                                        <p class="text-muted mb-0">Tips and Document business products</p>
                                    </div>
                                    <div class="form-check form-switch p-0"><input
                                            class="m-0 form-check-input h5 position-relative" type="checkbox"
                                            role="switch"></div>
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
                </div>
            </div>
        </div>
    </div><!-- [ sample-page ] end -->
</x-template>
