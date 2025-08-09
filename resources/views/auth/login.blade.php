<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('الإيميل') }}</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-2">
            <label for="password" class="form-label">{{ __('كلمة المرور') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-2" style="display: inline-flex; align-items: center; gap: 0.5rem;">
            <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember" style="margin: 0;">
            <label class="form-check-label" for="remember_me" style="margin: 0; font-size: 0.9rem;">
                {{ __('تذكرني') }}
            </label>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end mt-2">
            <button type="submit"
                class="btn btn-primary btn-sm text-uppercase fw-semibold text-white px-3 py-2 rounded"
                style="font-size: 0.8rem;">
                {{ __('تسجيل دخول') }}
            </button>
        </div>
    </form>
</x-guest-layout>
