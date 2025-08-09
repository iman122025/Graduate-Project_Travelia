@extends('site.layouts.main')
<style>
    body { background-color: #F8F6F6; font-family: 'Tajawal', sans-serif; }
    .nav-link { color: #333333; }
    .nav-link.active, .nav-link:hover { background-color: #60B5FF; border-radius: 10px; color: white; font-weight: bold; }
    h3 { color: #60B5FF; text-align: center; margin-top: 30px; margin-bottom: 50px; }
    .plan-title { text-align: center; color: #0d6efd; margin: 40px 0 30px; font-weight: bold; }
    .destination-card { border-radius: 10px; overflow: hidden; transition: 0.3s; margin-bottom: 30px; max-width: 350px; margin: auto; height: 500px; }
    .destination-card:hover { transform: translateY(-5px); }
    .destination-img { width: 100%; height: 250px; object-fit: cover; border: 2px solid #000000; border-radius: 10px; }
    .destination-content { padding: 15px 20px; }
    .day-title { color: #60B5FF; font-weight: bold; font-size: 20px; text-align: center; }
    .location-line { display: flex; align-items: center; gap: 5px; margin: 10px 0; }
    .location-text { font-size: 12px; color: #000000; font-weight: bold; }
    .activities { color: #333; font-size: 15px; display: flex; align-items: flex-start; gap: 10px; }
    .activities li { list-style-type: "• "; margin-right: 10px; margin-bottom: 5px; }
    .activities strong { white-space: nowrap; }
    .activities ul { margin: 0; padding: 0; }
    .map-title { text-align: center; color: #60B5FF; font-weight: bold; font-size: 22px; margin-top: 40px; }
    .map { width: 90%; height: 300px; margin: 20px auto; border-radius: 10px; overflow: hidden; }
    .map iframe { width: 100%; height: 100%; border: 0; }
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.7%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    @media(max-width: 768px){ .card img { height: 180px; } }
    @media(max-width: 480px){
        h3 { font-size: 20px; }
        .card img { height: 150px; }
        .card-body h5 { font-size: 16px; }
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
    <h3 class="mb-5">تهانينا خطتك أصبحت جاهزة !:</h3>
    <div class="container">
        <div class="row justify-content-center">
            @if($planDays->count())
                <div class="row">
                    @foreach($planDays as $day)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="destination-card">
                                <img src="{{ asset('storage/'.$day->image) }}" class="destination-img" alt="{{ $day->title }}">
                                <div class="destination-content">
                                    <div class="day-title">اليوم {{ $loop->iteration }} - {{ $day->title }}</div>
                                    <div class="location-line">
                                        <strong>المدينة:</strong>
                                        <span class="location-text"> {{ $day->city->name }} - {{ $day->city->country }}</span>
                                    </div>
                                    <div class="location-line">
                                        <strong>الموقع:</strong>
                                        <span class="location-text">📍 {{ $day->location }}</span>
                                    </div>
                                    <div class="activities">
                                        {{-- <span class="badge bg-primary">{{ $day->tag }}</span> --}}
                                        <strong>الأنشطة:</strong>
                                        {{ $day->activities }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>لا توجد اقتراحات تطابق اختياراتك.</p>
            @endif


        </div> <!-- نهاية row -->
    </div> <!-- نهاية container -->



    <form method="POST" action="{{route('site.plan_booking')}}">
        @csrf

    @foreach($planDays as $day)
        <input type="hidden" name="days_ids[]" value="{{ $day->id }}">
    @endforeach
    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
        <div class="custom-shadow border-bottom border-2 my-1 container"></div>

        <div id="app" class="d-flex justify-content-center gap-3 mt-4">
            <input type="submit" class="btn shadow-sm col-4 text-white" style="background-color: #20B15A;" value="حفظ" >
            <button class="btn shadow-sm col-4 text-white" style="background-color: #FD7271;" >حذف</button>
        </div>
    </form>




    <div class="map-title">المواقع على الخريطة</div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=..." allowfullscreen="" loading="lazy"></iframe>
    </div>

    <div class="custom-shadow border-bottom border-2 my-5 container"></div>


@endsection
