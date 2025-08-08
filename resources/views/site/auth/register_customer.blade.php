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
                    <form id="frmNewComplaint" method="POST" action="{{ route('site.register_store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="phone" class="form-label">الاسم كاملا</label>
                            <input type="text" value="{{ old('name') }}" class="form-control text-end" name="name" id="name"  placeholder="أدخل اسمك كاملا" />
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="tel" value="{{ old('phone') }}" class="form-control text-end" name="phone" id="phone"  placeholder="أدخل رقم هاتفك" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" value="{{ old('email') }}" class="form-control text-end" id="email" name="email" autocomplete="username" placeholder="أدخل بريدك الإلكتروني" />
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">العنوان كاملا</label>
                            <input type="text" value="{{ old('address') }}" class="form-control text-end" id="address" name="address" value="old('address')"  autocomplete="address" placeholder="مثال: تل الهوا - غزة - فلسطين" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control text-end" id="password"  name="password"  placeholder="أدخل كلمة المرور" />
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control text-end" name="password_confirmation"  autocomplete="new-password" id="confirmPassword"  placeholder="أعد إدخال كلمة المرور" />
                        </div>
                        <div class="d-grid mb-3">
                            <button id="btnSave" type="submit" class="btn fw-bold text-white text-center" style="background-color:#FF9149E5;">
                                انشاء الحساب
                            </button>
                        </div>
                        <div class="text-center">
                            <p> لديك حساب؟ <a href="{{route('site.login')}}">سجّل دخول الآن</a></p>
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

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

@endsection
<!-- SweetAlert2 CSS -->


<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


{{-- @section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#frmNewComplaint').on('submit', function(e) {
                e.preventDefault();

                if ($('#phone').val().trim() === '' ||
                    $('#email').val().trim() === '' ||
                    $('#password').val().trim() === '' ||
                    $('#confirmPassword').val().trim() === '') {

                    Swal.fire({
                        text: 'يرجى ملء جميع الحقول المطلوبة.',
                        icon: "warning",
                        confirmButtonText: "تم",
                        customClass: {
                            confirmButton: "btn btn-warning"
                        }
                    });
                    return; // يمنع الإرسال
                }


                let formData = $(this).serialize(); // جمع البيانات

                $.ajax({
                    url: "{{ route('site.register_store') }}",
                    method: "POST",
                    dataType: 'json', // <-- مهم جداً
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                text: "تم إنشاء الحساب بنجاح",
                                confirmButtonText: "حسنًا"
                            });

                            $('#frmNewComplaint')[0].reset(); // تفريغ الحقول
                        } else {
                            Swal.fire({
                                icon: "error",
                                text: response.message || "حدث خطأ ما",
                                confirmButtonText: "موافق"
                            });

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                if (errors.email) {
                                    Swal.fire({
                                        icon: 'error',
                                        text: errors.email[0],
                                    });
                                }
                            }
                        }
                    },
                    error: function(xhr) {
                        let message = "حدث خطأ في الاتصال بالخادم.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: "error",
                            text: message,
                            confirmButtonText: "موافق"
                        });
                    }
                });
            });
        });
    </script>


@endsection --}}

