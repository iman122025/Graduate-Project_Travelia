@extends('site.layouts.main')
@section('content')

    <div class="custom-shadow border-bottom border-2 my-4 container"></div>

    <!-- القسم الرئيسي -->
    <div class="container my-5 ">


        <div class="row align-items-center ">
            <div class="col-md-6 text-center">
                <img src="{{ asset("assets/images/Rectangle 2.png") }}" width="100%" class="rounded-2 img-fluid  mb-4 mb-md-0">
            </div>
            <div class="col-md-6 text-center">
                <h2 style="color: #60B5FF; font-weight: bold;">حلول رقمية متقدمة لتجربة سفر منظمة</h2>
                <h6>نحن فريق شغوف بالسفر والاستكشاف، نسعى لتوفير دليل <br>سياحي مبسط وموثوق يساعدك في اختيار وجهتك القادمة بثقة.</h6>
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{route('site.planning')}}" class="btn fw-bold text-white rounded-3 px-5" style="background-color:#FF9149E5; height: 40px; width: 280px; border-radius: 20px;">
                        ابدأ التخطيط
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="custom-shadow border-bottom border-2 my-4 container"></div>

    <!-- قسم الأدوات والعملاء -->
    <div class="container">
        <div class="row text-center align-items-center justify-content-center">
            <div class="col-md-4 text-end">
                <img src="{{ asset("assets/images/OpenAI_Logo_1.png") }}" alt="ChatAI Logo" width="60">
                <img src="{{ asset("assets/images/OpenAI_Symbol_1.png") }}" alt="ChatAI Logo" width="20" class="ms-auto">
                <div class="col-md-4 text-end" style="gap: 5px;">
                    <img src="{{ asset("assets/images/Google_maps_logo.png") }}" alt="GoogleMaps Logo" width="70">
                    <img src="{{ asset("assets/images/google-maps.png") }}" alt="GoogleMaps Logo" width="20">
                </div>
                <p>الأدوات المساعدة</p>
            </div>

            <div class="col-md-4">
                <h4 class="fw-bold mt-3" style="color: #60B5FF; display: inline-block;">+1000</h4>
                <p class="mt-1">عملاؤنا</p>
            </div>

            <div class="col-md-4 text-start">
                <!-- المربع الجديد الخاص بالمشاهدات -->
                <div class="user-views-box">
                    <div class="views-info">
                        <p class="views-number my-2">+5k</p>
                    </div>
                    <div>
                        <div class="user-images">
                            <img src="{{ asset("assets/images/michael-dam-mEZ3PoFGs_k-unsplash.jpg") }}" alt="User 1">
                            <img src="{{ asset("assets/images/albert-dera-ILip77SbmOE-unsplash.jpg") }}" alt="User 2">
                            <img src="{{ asset("assets/images/jimmy-fermin-bqe0J0b26RQ-unsplash.jpg") }}" alt="User 3">
                            <img src="{{ asset("assets/images/darshan-patel-QJEVpydulGs-unsplash.jpg") }}" alt="User 4">
                        </div>
                        <div cclass="mt-1">
                            <p style="margin-top: 20px;">المشاهدات  </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-shadow border-bottom border-2 my-4 container"></div>

    <div class="container my-2">
        <div class="row align-items-center">
            <!-- النص في اليمين -->
            <div class="col-md-5 text-end">
                <h4 class="fw-bold" style="color: #60B5FF; font-size: 30px;">نبذة عن الموقع</h4>
                <p>
                    موقعنا هو وجهتك الأولى لاكتشاف أفضل الأماكن السياحية حول العالم! نقدم لك محتوى سياحي مميز يجمع بين المعلومات الموثوقة والتجارب الواقعية، ليساعدك في اختيار الوجهة الأنسب لك سواء كنت تبحث عن الاسترخاء على الشواطئ، أو المغامرة في الجبال، أو استكشاف الثقافات المختلفة.
                    <a href="Whoarewe.html" style="color: #60B5FF;">اقرأ المزيد</a>  </p>
            </div>

            <!-- الصورة في اليسار -->
            <div class="col-md-7 text-start">
                <img src="{{ asset("assets/images/rafiki.png") }}" class="img-fluid" style="max-width: 70%; height: auto;" alt="صورة نبذة عن الموقع">
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h4 class="text-center fw-bold my-4" style="color: #60B5FF;">أماكن شائعة</h4>
        <div class="row g-4">

            @foreach ($cities as $city)
                <div class="col-md-4">
                    <a href="{{ route('site.city_hotels', $city->id) }}" class="text-decoration-none">
                        <div class="position-relative place-wrapper">
                            <img src="{{ asset('storage/'.$city->image) }}" class="img-fluid rounded shadow-sm place-img" alt="المدينة">
                            <div class="place-label">{{ $city->country }} - {{ $city->name }}</div>
                            <div class="place-sub-label">{{ $city->season }}</div>
                        </div>
                    </a>
                </div>
            @endforeach

            {{--  --}}


        </div>
    </div>

    <div id="app" class="container my-5">
        <!-- رسالة التنبيه فوق كل شيء في أعلى الصفحة -->


        <h4 class="text-center fw-bold my-4" style="color: #60B5FF;">أضف ملاحظاتك</h4>
        <div class="row align-items-center">
            <!-- النموذج على الجهة اليسرى -->
            <div class="col-md-7 text-end mt-1">

                 
                <form action="{{ route('site.feedback.store') }}" method="POST">
                    @csrf

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

                    <input type="email" name="email" class="form-control mb-3 py-3 custom-bg" placeholder="بريدك الإلكتروني"  value="{{ old('email') }}">
                    <textarea name="message" class="form-control mb-3 py-3 custom-bg" rows="4" placeholder="ملاحظاتك" >{{ old('message') }}</textarea>
                    <button type="submit" class="btn fw-bold text-white w-100 rounded-4" style="background-color: #FF9149E5;">
                        إرسال
                    </button>
                </form>

            </div>

            <!-- الصورة على الجهة اليمنى -->
            <div class="col-md-5 text-start">
                <img src="{{ asset("assets/images/travel.png") }}" alt="image" class="img-fluid" style="max-width: 90%; height: auto;">
            </div>
        </div>

    </div>


    <div class="custom-shadow border-bottom border-2 my-5 container"></div>
@endsection
