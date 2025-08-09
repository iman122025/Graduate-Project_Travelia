@extends('site.layouts.main')
<style>
    body {
        background-color: #F8F6F6;
        font-family: 'Tajawal', sans-serif;
    }

    .nav-link {
        color: #333333;
    }

    .nav-link.active,
    .nav-link:hover {
        background-color: #60B5FF;
        border-radius: 10px;
        color: white;
        font-weight: bold;
    }

    h5 {
        color: #60B5FF;
    }

    .navbar-toggler {
        border: none;
        background: transparent;
        outline: none;
        padding: 0.25rem 0.75rem;
    }

    .navbar-toggler-icon {
        display: inline-block;
        width: 1.5em;
        height: 1.5em;
        vertical-align: middle;
        content: "";
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%280, 0, 0, 0.7%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100% 100%;
    }
    ul {
        padding-right: 0;
        list-style-position: inside; /* يجعل النقطة داخل حدود العنصر */
    }
    .what-we-offer {
        list-style-position: inside;         /* النقطة قريبة من النص */
        padding-right: 0;                    /* بدون فراغ يمين */
        max-width: 400px;                    /* عرض مناسب لكل الأجهزة */
        margin: 0 auto;                      /* وسط الصفحة */
        font-size: 1rem;
        line-height: 2;
        direction: rtl;                      /* تأكيد أن النص من اليمين */
        text-align: center !important;  /* ← هذا السطر يجعل الكلام بالنص */

    }

    .what-we-offer li::marker {
        color: #000;                         /* لون النقطة */
    }

    @media (max-width: 576px) {
        .what-we-offer {
            font-size: 0.95rem;
            line-height: 1.8;
        }
    }
    @media (max-width: 767.98px) {
        .no-bullets-mobile {
            list-style: none;
            padding-left: 0;
            padding-right: 0;
        }
    }

    @media (min-width: 768px) {
        .no-bullets-mobile {
            list-style: disc;
            list-style-position: inside;
        }
    }
    footer ul {
        padding: 0;
    }

    footer ul li {
        margin-bottom: 6px;
    }
</style>
@section('content')

    @php
        $customer = Auth::guard('customer')->user();
    @endphp


    <!-- الملف الشخصي -->
    <div class="text-center mt-5 container col-9">
        <h4 class="fw-bold" style="color:#60B5FF;">الملف الشخصي</h4>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-5 container col-9">
        <h5 class="fw-bold" style="color:#60B5FF;">المعلومات الشخصية</h5>
        <p><i class="fa-solid fa-envelope ms-2"></i> الاسم الشخصي: <span style="color: #6e6e6e;">{{ $customer->name }}</span></p>
        <p><i class="fa-solid fa-envelope ms-2"></i> البريد الإلكتروني: <span style="color: #6e6e6e;">{{ $customer->email }}</span></p>
        <p><i class="fa-solid fa-phone ms-2"></i> رقم الهاتف: <span style="color: #6e6e6e;">{{ $customer->phone }}</span></p>
        <p><i class="fa-solid fa-phone ms-2"></i> العنوان: <span style="color: #6e6e6e;">{{ $customer->address }}</span></p>
    </div>

    <div class="custom-shadow border-bottom border-2 my-5 container"></div>

    <div class="mt-5 container col-9">
    <h5 class="fw-bold" style="color:#60B5FF;">الرحلات السابقة</h5>

    @if($bookings->isEmpty())
        <p>لا يوجد رحلات</p>
    @else
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>الدولة</th>
                    <th>المدينة</th>
                    <th>اسم الفندق</th>
                    <th>تاريخ الحجز</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->hotel->city->country }}</td>
                        <td>{{ $booking->hotel->city->name }}</td>
                        <td>{{ $booking->hotel->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->created_at)->translatedFormat('F Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>




    <div class="custom-shadow border-bottom border-2 my-5 container"></div>

    <!-- الإعدادات -->
    <div class="mt-5 container col-9">
        <h5 class="fw-bold" style="color:#60B5FF;">الإعدادات</h5>
        <p>
            <a href="{{route('profile.edit_info') }}" class="text-decoration-none text-dark">
                <i class="fa-solid fa-user-pen me-2"></i> تعديل المعلومات الشخصية
            </a>
        </p>
        <p>
            <a href="{{route('profile.edit_password') }}" class="text-decoration-none text-dark">
                <i class="fa-solid fa-key me-2"></i> تغيير كلمة المرور
            </a>
        </p>
    </div>

    <div class="custom-shadow border-bottom border-2 my-5 container"></div>

    <!-- تسجيل الخروج -->
    <div class="fw-bold text-center mt-5 container col-9">

        <form action="{{ route('site.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger px-4">تسجيل الخروج</button>
        </form>
    </div>

@endsection
