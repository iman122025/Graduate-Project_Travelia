<?php
$customer = null;
if (Auth::guard('customer')->check()) {
    $customer = Auth::guard('customer')->user();
}
?>

<nav class="navbar navbar-expand-lg navbar-light mt-4">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset("assets/images/logo.png") }}" width="90" alt="الشعار">
        </a>
        <!-- زر القائمة عند تصغير الشاشة -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="تبديل التنقل">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- قائمة الروابط -->
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == '' ? 'active' : '' }}" href="{{ route('site.home') }}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(1) == 'planning' || request()->segment(1) == 'plan' || request()->segment(1) == 'appointment' || request()->segment(1) == 'hotel' ||request()->segment(1) == 'planning-process' || request()->segment(1) == 'plan-ready') ? 'active' : '' }}" href="{{ route('site.planning') }}">التخطيط</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'about-us' ? 'active' : '' }}" href="{{ route('site.aboutus') }}">من نحن</a>
                </li>
                @if ($customer && $customer->id)
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'account' ? 'active' : '' }}" href="{{ route('site.account') }}">حسابي</a>
                </li>
                @endif
            </ul>


            @if ($customer && $customer->id)
                <div class="d-flex">
                    <form action="{{ route('site.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn login-btn px-4">تسجيل الخروج</button>
                    </form>
                </div>
            @else
                <div class="d-flex">
                    <a class="btn login-btn px-4" href="{{ route('site.login') }}">تسجيل دخول</a>
                </div>
            @endif

        </div>
    </div>
</nav>
