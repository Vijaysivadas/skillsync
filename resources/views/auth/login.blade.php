<!-- resources/views/auth/login.blade.php -->

@extends("layouts.auth")

@section("content")
    <div class="row flex-center min-vh-100 py-5">
        <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
            <a class="d-flex flex-center text-decoration-none mb-4" href="{{ url('/') }}">
                <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block">
{{--                    <img src="{{ asset('assets/img/icons/logo.png') }}" alt="phoenix" width="58"/>--}}
                    <h2>Skill Sync</h2>
                </div>
            </a>
            <div class="text-center mb-7">
                <h3 class="text-body-highlight">Sign In</h3>
                <p class="text-body-tertiary">Get access to your account</p>
            </div>

            <!-- Display Success or Error Messages -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3 text-start">
                    <label class="form-label" for="email">Email address</label>
                    <div class="form-icon-container">
                        <input
                            class="form-control form-icon-input @error('email') is-invalid @enderror"
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="name@example.com"
                            required
                        />
                        <span class="fas fa-user text-body fs-9 form-icon"></span>
                    </div>
                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3 text-start">
                    <label class="form-label" for="password">Password</label>
                    <div class="form-icon-container" data-password="data-password">
                        <input
                            class="form-control form-icon-input pe-6 @error('password') is-invalid @enderror"
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Password"
                            data-password-input="data-password-input"
                            required
                        />
                        <span class="fas fa-key text-body fs-9 form-icon"></span>
                        <button
                            type="button"
                            class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary"
                            data-password-toggle="data-password-toggle"
                        >
                            <span class="uil uil-eye show"></span>
                            <span class="uil uil-eye-slash hide"></span>
                        </button>
                    </div>
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- User Type Selection -->
                <div class="mb-4 text-start">
                    <label class="form-label d-block mb-2">Select User Type</label>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input @error('user_type') is-invalid @enderror"
                            type="radio"
                            name="user_type"
                            id="user"
                            value="user"
                            {{ old('user_type') == 'user' ? 'checked' : '' }}
                            required
                        />
                        <label class="form-check-label" for="user">User</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input @error('user_type') is-invalid @enderror"
                            type="radio"
                            name="user_type"
                            id="recruiter"
                            value="recruiter"
                            {{ old('user_type') == 'recruiter' ? 'checked' : '' }}
                            required
                        />
                        <label class="form-check-label" for="recruiter">Recruiter</label>
                    </div>
                    @error('user_type')
                    <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>

                <!-- Register Link -->
                <div class="text-center">
                    <a class="fs-9 fw-bold" href="{{ route('register') }}">Create an account</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButtons = document.querySelectorAll('[data-password-toggle]');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const passwordInput = this.closest('.form-icon-container').querySelector('input[type="password"], input[type="text"]');
                    const eyeShow = this.querySelector('.uil-eye');
                    const eyeHide = this.querySelector('.uil-eye-slash');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeShow.classList.add('hide');
                        eyeHide.classList.remove('hide');
                    } else {
                        passwordInput.type = 'password';
                        eyeShow.classList.remove('hide');
                        eyeHide.classList.add('hide');
                    }
                });
            });
        });
    </script>
@endpush
