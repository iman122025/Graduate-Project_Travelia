@extends('site.layouts.main')
<style>
    body {
        background-color: #F8F6F6;
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
    h5{
        color: #60B5FF;
    }
    .search-box {
        padding: 10px;
        border-radius: 5px;
        margin: 20px auto;
        width: fit-content;
        display: flex;
        justify-content: center;
        width: 60%;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        max-width: 1200px;
        margin: 30px auto;
    }
    .submit {

        display: block;
        width: 30%;
        padding: 12px;
        background-color: #ffa45b;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        margin: 40px auto 0; /* وسّط الزر وخفف المسافة العلوية */
    }
    .card {
        background: #D9D9D966;
        overflow: hidden;
        box-shadow: 0 1px 8px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
    }
    .card img {
        width: 100%;
        height: 350px;
        object-fit: cover;
    }
    .card-content {
        padding: 15px;
    }
    .price {
        background: #eee;
        padding: 5px 10px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        left: 10px;
        border-radius: 5px;
    }
    .title {
        color: #007BFF;
        font-weight: bold;
        margin-bottom: 5px;
        text-align: center;
    }
    .desc {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
        text-align: center;

    }
    .stars {
        color: gold;
        margin-bottom: 10px;
        text-align: center;

    }
    .buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 0 15px 15px;
    }

    .buttons .btn-book,
    .buttons button {
        width: 100%;
        background: #ffa76c;
        border: none;
        padding: 12px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
    }

    .buttons button {
        background-color: #d4d4d4;
        color: #000;
    }

    .search-box {
        display: flex;
        justify-content: center;
        margin: 20px auto;
    }

    .search-container {
        position: relative;
        width: 60%;
        max-width: 800px;
        display: flex;
        align-items: center;
    }

    .search-input {
        width: 100%;
        height: 60px;
        border: none;
        border-radius: 10px;
        padding: 0 50px 0 60px; /* padding يمين ويسار */
        background-color: #eaeaea;
        font-weight: bold;
        font-size: 16px;
    }

    .search-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
        font-size: 18px;
        pointer-events: none;
    }
    .btn-book {
        background: #ffa76c;
        border: none;
        padding: 10px;
        color: white !important;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        flex: 1;
        margin: 0 5px;
        display: inline-block;
        font-weight: bold;
    }


    .filter-btn {
        background: white;
        border: 1px solid #ccc;
        height: 60px;
        width: 60px;
        margin-left: 13px;
        border-radius: 10px;
        font-size: 20px;
        color: #60B5FF !important;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    @media (max-width: 700px) {
        .navbar-collapse {
            text-align: center;
        }

        .navbar-collapse .navbar-nav {
            margin: auto;
            display: flex;
            flex-direction: column;
            /* align-items: center; */
        }
    }

    /* تحسين لون أيقونة الهامبرغر */
    .navbar-toggler {
        border-color: #cccccc;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28128,128,128,1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
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

    <div class="custom-shadow border-bottom border-2 my-1 container"></div>

    <div class="search-box">
        <a href="Filter Hotels.html" class="filter-btn">
            <i class="fas fa-sliders-h"></i>
        </a>
        <input type="text" id="searchInput" placeholder="  ابحث عن فندق ...." style="width: 800px; height: 60px; padding: 10px; border: none; border-radius: 5px; background-color: #d7d7d7; font-weight: bold;">
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
    <div class="grid">



        <!-- بطاقة 1 -->
    @foreach ($filteredHotels as $hotel)

        <div class="card">
            <div style="position: relative;">
                <img src="{{ asset('storage/'.$hotel->main_image) }}" alt="فندق" style="width: 100%;">
                <span style="position: absolute; bottom: 20px; right: 0px; background-color:  #FFFFFF; padding: 6px 15px; border-radius: 4px; font-weight: bold;">{{ $hotel->price }} $</span>
            </div>

            <div class="card-content">
                <div class="title">{{ $hotel->name }}، {{ $hotel->city->country }} - {{ $hotel->city->name }}</div>
                <div class="stars">
                    @if ($hotel->star_no == 1)
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    @elseif ($hotel->star_no == 2)
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    @elseif ($hotel->star_no == 3)
                    <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    @elseif ($hotel->star_no == 4)
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    @elseif ($hotel->star_no ==5)
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    @endif

                </div>
                <div class="desc">
                    {{ \Illuminate\Support\Str::limit($hotel->description, 100) }}
                </div>
            </div>
            <div class="buttons">
                <a href="{{route('site.booking', ['id' => $hotel->id])}}" class="btn-book">حجز مباشر الآن</a>
                <a href="{{route('site.hotel', ['id' => $hotel->id])}}" class="btn-book" style="background-color: #d4d4d4; color: #000000 !important;">قراءة المزيد / تخطيط الأيام</a>
            </div>
        </div>
    @endforeach


    </div>
    <div class="d-flex align-items-center justify-content-center">
        <div class="d-flex justify-content-center gap-3 mt-4" style="width: 600px;">
            <!-- زر العودة -->
            <a href="{{route('site.planning')}}"
               class="btn text-dark"
               style="background-color: #D9D9D9; width: 260px; display: flex; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 12px 20px; border-radius: 8px; position: relative; justify-content: center;">
                <span class="fw-bold" style="position: absolute; left: 50%; transform: translateX(-50%);">عودة</span>
                <!-- تم نقل السهم إلى الجهة اليسرى -->
                <span style="font-weight: bold; position: absolute; right: 20px;">&lt;</span>

            </a>

        </div>
    </div>


    <div class="custom-shadow border-bottom border-2 my-5 container"></div>
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
