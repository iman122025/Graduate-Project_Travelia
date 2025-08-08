@extends('site.layouts.login')

@section('content')
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- العمود الأيسر -->
            <div class="col-md-7 d-flex align-items-center full-height">
                <div class="login-box">
                    <div class="logo-wrapper">
                        <img src="{{asset('assets/images/logo.png')}}" alt="شعار الموقع" />
                    </div>
                    <h2 class="mb-4 text-center fw-bold" style="color:#FF9149E5;">أهلاً بك !</h2>

                    {{-- @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif --}}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- نموذج Vue -->
                    <form method="POST" action="{{ route('site.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input
                                type="email" name="email" id="email"
                                class="form-control"
                                placeholder="أدخل بريدك الإلكتروني"
                                required
                            />

                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="أدخل كلمة المرور"
                                required
                            />
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn fw-bold text-white text-center" style="background-color:#FF9149E5;">
                                تسجيل الدخول
                            </button>
                        </div>
                        <div class="text-center">
                            <p>ليس لديك حساب <a href="{{route('site.register')}}"> تسجيل</a></p>
                        </div>
                        <div class="line-with-text">
                            <span>أو</span>
                        </div>
                    </form>

                    <div class="d-flex justify-content-center align-items-center gap-2 mt-3">
                        <a href="#" target="_blank">
                            <img src="{{asset('assets/images/Google.png')}}" alt="Google" width="40" />
                        </a>
                        <p class="mb-0 fw-bold">تسجيل الدخول بحساب جوجل</p>
                    </div>
                </div>
            </div>

            <!-- العمود الأيمن -->
            <div class="col-md-5 d-none d-md-block p-0">
                <div class="right-image-section h-100">
                    <div class="footer-text">
                        <h6>
                            في <span>ترافليا</span>، نؤمن أن كل رحلة تبدأ بحلم، ونحن هنا لنساعدك في تحقيقه
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
