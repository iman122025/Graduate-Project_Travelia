@extends('site.layouts.main')
<style>
    body {
        font-family: 'Tajawal', sans-serif;
        background-color: #f8f9fa;
    }
    .section-title {
        color: #60B5FF;
        font-weight: 700;
        font-size: 25px;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    .description {
        margin-top: 15px;
        line-height: 1.8;
        color: #333;
    }
    .stars {
        color: gold;
        font-size: 25px;
        margin-bottom: 10px;
    }
    .btn-custom {
        padding: 10px 20px;
        background-color: #ff884d;
        color: white;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
    }

    .nav-link {
        color: #383838;
    }
    .nav-link.active,
    .nav-link:hover {
        background-color: #60B5FF;
        border-radius: 10px;
        color: white !important;
        font-weight: bold;
    }
    @media (max-width: 991.98px) {
        .navbar-collapse.show {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .navbar-nav {
            width: 100%;
        }

        .navbar-nav .nav-item {
            text-align: center;
        }
    }
    a.btn-custom {
        background-color: #ff884d;
        color: white;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        padding: 10px 20px;
        transition: none;
    }

    /* عند تمرير الماوس */
    a.btn-custom:hover {
        background-color: #ff7631;
        color: white;
    }

    /* عند الضغط لا يتغير */
    a.btn-custom:active,
    a.btn-custom:focus {
        background-color: #ff884d !important;
        color: white !important;
        box-shadow: none !important;
        outline: none !important;
    }

</style>
@section('content')

    <div class="custom-shadow border-bottom border-2 my-4 container"></div>

    <div class="container">
        <div class="row align-items-start">
            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
            <!-- عمود اليمين: زر العودة + تفاصيل الفندق -->
            <div class="col-md-6 d-flex flex-column">
                <!-- زر العودة -->
                <div class="mb-3 d-flex justify-content-start">
                    <a href="{{route('site.plan')}}" class="btn btn-custom">عودة لصفحة الفنادق</a>
                </div>
                <!-- تفاصيل الفندق -->
                <div class="my-5">
                    <h2 class="fw-bold" style="color: #60B5FF;"> {{ $hotel->name }}
                    </h2>
                    <p class="location mb-3 fw-bold">
                        <i class="fas fa-map-marker-alt me-2"></i> {{ $hotel->city->country }} ، {{ $hotel->name }}
                    </p>
                    <p class="price mb-3 fw-bold">{{ $hotel->price }} $</p>
                    <p class="stars mb-3">
                        <i class="fas fa-star fa-xs"></i>
                        <i class="fas fa-star fa-xs"></i>
                        <i class="fas fa-star fa-xs"></i>
                        <i class="fas fa-star fa-xs"></i>
                        <i class="fas fa-star fa-xs"></i>
                    </p>
                    <a href="{{route('site.planning-process', ['id' => $hotel->id])}}" class="btn btn-custom w-100 w-md-auto">خطط الآن</a>
                </div>
            </div>

            <!-- عمود اليسار: صورة الفندق -->
            <div class="col-md-6">
                <img src="{{ asset('storage/'.$hotel->main_image) }}" alt="صورة الفندق" class="img-fluid rounded" style="height: 350px; object-fit: cover; width: 100%;" />
            </div>

        </div>
    </div>

    <div class="container">
        <div class="section-title">مرافق الفندق</div>
        <p class="description px-3 px-md-0">
            {{ $hotel->description }}
        </p>

        <div class="section-title text-center mt-5">معرض الصور</div>
        <div class="gallery row g-3">
            
            @foreach ($hotel->images as $image)
                <div class="col-6 col-md-3">
                    <img src="{{ asset('storage/'.$image->image_path) }}" alt="غرفة الفندق" class="img-fluid rounded" />
                </div>
            @endforeach

        </div>
    </div>
    </div>
    <div class="custom-shadow border-bottom border-2 my-4 container"></div>
@endsection

<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<script>
    document.getElementById("searchInput").addEventListener("input", function () {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll(".card");

        cards.forEach(card => {
            const title = card.querySelector(".title").textContent.toLowerCase();
            const desc = card.querySelector(".desc").textContent.toLowerCase();

            if (title.includes(query) || desc.includes(query)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
</script>
