<div class="modal fade" id="auth-modal" tabindex="-1" aria-labelledby="auth-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#" id="login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="register">Register</a>
                </li>
            </ul>
            <div id="login-page">
                <form id="login-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auth-modal-label">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="login-email">Email:</label>
                            <input type="text" id="login-email" name="email" class="form-control" placeholder="Input your email">
                        </div>
                        <div class="mb-3">
                            <label for="login-password">Password:</label>
                            <input type="password" id="login-password" name="password" class="form-control" placeholder="Input your password">
                        </div>
                        <a href="#">Lupa Password</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <div class="d-none" id="register-page">
                <form id="register-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auth-modal-label">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="register-email">Email:</label>
                            <input type="text" id="register-email" name="email" class="form-control" placeholder="Input your email">
                        </div>
                        <div class="mb-3">
                            <label for="register-name">Name:</label>
                            <input type="text" id="register-name" name="name" class="form-control" placeholder="Input your name">
                        </div>
                        <div class="mb-3">
                            <label for="register-password">Password:</label>
                            <input type="password" id="register-password" name="password" class="form-control" placeholder="Input your password">
                        </div>
                        <div class="mb-3">
                            <label for="register-confirm-password">Confirm Password:</label>
                            <input type="password" id="register-confirm-password" name="confirm_password" class="form-control" placeholder="Confirm your password">
                            <span class="text-danger fs-6 fw-semibold d-none" id="password-warning">Password tidak sama</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer justify-content-center">
                <button class="btn btn-primary">Login with Google</button>
            </div> --}}
        </div>
    </div>
</div>
